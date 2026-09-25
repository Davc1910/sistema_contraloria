<?php

namespace App\Http\Controllers;

use App\Models\TipoSolicitud;
use App\Models\Solicitud;
use App\Models\Articulo;
use App\Models\Personas;
use App\Models\Oficinas;
use App\Models\ArticuloSolicitud;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;

class TipoSolicitudController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-tipo_solicitud|crear-tipo_solicitud|editar-ptoyecto|', ['only' => ['index']]);
        $this->middleware('permission:crear-tipo_solicitud', ['only' => ['create','store']]);
        $this->middleware('permission:editar-tipo_solicitud', ['only' => ['edit','update']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todas las solicitudes y cargar relaciones
        $solicitudes = Solicitud::with('persona', 'articulos')->get();

        // Iterar sobre cada solicitud para verificar si está planificada
            $solicitudes->each(function ($solicitud) {
                // Buscar en la tabla TipoSolicitud si existe una tipo de solicitud para esta solicitud
                $solicitud->yaSolicitada = TipoSolicitud::where('id_solicitud', $solicitud->id)->exists();
            });

        // $recaudos = Recaudos::all();

        return view('tipo_solicitud.index', compact('solicitudes'));
    }

    public function getSolicitudDetalles($id)
    {
        $solicitud = Solicitud::with([
            'persona.oficina',
            'articulo.articuloEspecifico',
            'articulos.articuloEspecifico'
        ])->findOrFail($id);

        $articulos = $solicitud->articulos()->with('articuloEspecifico')->get();

        if ($articulos->isEmpty() && $solicitud->articulo) {
            $articulos = collect([$solicitud->articulo]);
        }

        $detalleArticulos = $articulos->map(function ($articulo) {
            $tipo = $articulo->tipo_biene;
            $especifico = $articulo->articuloEspecifico;

            if ($tipo === 'Mobiliario' && $especifico) {
                return [
                    'id' => $articulo->id,
                    'tipo_biene' => $tipo,
                    'tipo_mobiliario' => $especifico->tipo_mobiliario ?? 'N/A',
                    'altura' => $especifico->altura ?? 'N/A',
                    'anchura' => $especifico->anchura ?? 'N/A',
                    'serial' => $especifico->serial ?? 'N/A',
                    'descripcion' => trim(
                        ($especifico->tipo_mobiliario ?? 'N/A') . ' ' .
                        ($especifico->serial ?? '') . ' ' .
                        ($especifico->altura ?? '') . ' ' .
                        ($especifico->anchura ?? '')
                    ),
                ];
            }

            if ($tipo === 'Equipo' && $especifico) {
                $periferico = $especifico->perifericos && $especifico->perifericos->tipo_periferico
                    ? $especifico->perifericos->tipo_periferico->tipo
                    : 'Ninguno';

                return [
                    'id' => $articulo->id,
                    'tipo_biene' => $tipo,
                    'cpu' => $especifico->cpu ?? 'N/A',
                    'ram' => $especifico->ram ?? 'N/A',
                    'disco_duro' => $especifico->disco_duro ?? 'N/A',
                    'sistema_operativo' => $especifico->sistema_operativo ?? 'N/A',
                    'serial' => $especifico->serial ?? 'N/A',
                    'periferico' => $periferico,
                    'descripcion' => trim(
                        ($especifico->cpu ?? '') . ' ' .
                        ($especifico->ram ?? '') . ' ' .
                        ($especifico->disco_duro ?? '') . ' ' .
                        ($especifico->sistema_operativo ?? '') . ' ' .
                        ($especifico->serial ?? '') . ' ' .
                        $periferico
                    ),
                ];
            }

            return [
                'id' => $articulo->id,
                'tipo_biene' => $tipo,
                'descripcion' => 'Sin detalles disponibles',
            ];
        })->values();

        return response()->json([
            'solicitud' => [
                'id' => $solicitud->id,
                'descripcion' => $solicitud->descripcion,
                'fecha' => $solicitud->fecha,
                'persona' => $solicitud->persona ? $solicitud->persona->nombre . ' ' . $solicitud->persona->apellido : null,
                'cedula' => $solicitud->persona ? $solicitud->persona->cedula : null,
                'oficina' => $solicitud->persona && $solicitud->persona->oficina ? $solicitud->persona->oficina->nombre_oficina : null,
            ],
            'tipo' => $detalleArticulos->count() > 1 ? 'compuesta' : 'simple',
            'articulos' => $detalleArticulos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $solicitud = Solicitud::with(['persona', 'articulos'])->findOrFail($id);
        $articulos = Articulo::with('articuloEspecifico')->get();
        return view('tipo_solicitud.create', compact('solicitud', 'articulos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $tipo_solicitud = new TipoSolicitud();

        $tipo_solicitud->id_solicitud = $request->input('id_solicitud');
        $tipo_solicitud->estatus = $request->input('estatus');

        if ($tipo_solicitud->estatus == "Aprobado") {

            if ($tipo_solicitud->estatus_resp = '') {
                $tipo_solicitud->estatus_resp = 'Pendiente';
            }else{
                $tipo_solicitud->estatus_resp = $request->input('estatus_resp');
            }
        } else {
            $tipo_solicitud->estatus_resp = 'Negado';
        }

        $tipo_solicitud->fecha = $request->input('fecha');
        $tipo_solicitud->descripcion = $request->input('descripcion');
        $tipo_solicitud->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
           return redirect()->route('valoracion_tecnica.index')->with('success', '✅ El Tipo Solicitud ha sido Guardada exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    public function actualizarEstatusTipoSolicitud(Request $request, $id)
    {
        $tipo_solicitud = TipoSolicitud::find($id);

        if ($tipo_solicitud) {
            $tipo_solicitud->estatus_resp = $request->input('estatus_resp');
            $tipo_solicitud->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Tipo de Solicitud no encontrada']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incorporar  $incorporar
     * @return \Illuminate\Http\Response
     */
    public function show(Incorporar $incorporar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incorporar  $incorporar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo_solicitud = TipoSolicitud::findOrFail($id);
        $solicitud = Solicitud::find($id);
        $fecha = date('d/m/Y', strtotime($tipo_solicitud->fecha));
        $estatus = $tipo_solicitud->estatus;
        $estatus_resp = $tipo_solicitud->estatus_resp;

        return view('tipo_solicitud.edit' , compact('tipo_solicitud', 'solicitud', 'estatus', 'estatus_resp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incorporar  $incorporar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $tipo_solicitud= TipoSolicitud::findOrFail($id);

        $tipo_solicitud->id_solicitud = $request->input('id_solicitud');
        $tipo_solicitud->estatus = $request->input('estatus');

        if ($tipo_solicitud->estatus == "Aprobado") {

            if ($tipo_solicitud->estatus_resp = '') {
                $tipo_solicitud->estatus_resp = 'Pendiente';
            }else{
                $tipo_solicitud->estatus_resp = $request->input('estatus_resp');
            }

        } else {
            $tipo_solicitud->estatus_resp = 'Negado';
        }

        $tipo_solicitud->fecha = $request->input('fecha');
        $tipo_solicitud->descripcion = $request->input('descripcion');
        $tipo_solicitud->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
           return redirect()->route('valoracion_tecnica.index')->with('success', '✅ El Tipo Solicitud ha sido Actualizado exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incorporar  $incorporar
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
