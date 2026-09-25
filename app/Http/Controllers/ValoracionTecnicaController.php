<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipoSolicitud;
use App\Models\ValoracionTecnicas;
use Illuminate\Database\QueryException;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class ValoracionTecnicaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-valoracion_tecnica|crear-valoracion_tecnica|editar-valoracion_tecnica|borrar-valoracion_tecnica', ['only' => ['index']]);
        $this->middleware('permission:crear-valoracion_tecnica', ['only' => ['create','store']]);
        $this->middleware('permission:editar-valoracion_tecnica', ['only' => ['edit','update']]);


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_solicitudes = TipoSolicitud::all();

        $tipo_solicitudes->each(function ($tipo_solicitud) {
            $tipo_solicitud->yaValoralizada = ValoracionTecnicas::where('id_tipo_solicitud', $tipo_solicitud->id)->exists();
        });

        return view('valoracion_tecnica.index', compact('tipo_solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $tipo_solicitud = TipoSolicitud::findOrFail($id);

        return view('valoracion_tecnica.create', compact('tipo_solicitud'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            // Crear una nueva Valoracion Tecnica
            $valoracion_tecnicas = new ValoracionTecnicas();
            $valoracion_tecnicas->id_tipo_solicitud = $request->input('id_tipo_solicitud');
            $valoracion_tecnicas->desincorporar = $request->input('desincorporar');
            $valoracion_tecnicas->descripcion = $request->input('descripcion');
            $valoracion_tecnicas->fecha = $request->input('fecha');

            $valoracion_tecnicas->save();

            // Registrar en la bitácora
            $bitacora = new BitacoraController();
            $bitacora->update();

         try {
            return redirect('control_tecnica')->with('success', '✅ La Valoración Tecnica ha sido Guardada exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: .';
            return redirect()->back()->withErrors($errorMessage);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $valoracion_tecnica = ValoracionTecnicas::findOrFail($id);
        $fecha = date('d/m/Y', strtotime($valoracion_tecnica->fecha));
        return view('valoracion_tecnica.edit', compact('valoracion_tecnica','fecha'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $valoracion_tecnica = ValoracionTecnicas::findOrFail($id);
            $valoracion_tecnica ->id_tipo_solicitud = $request->input('id_tipo_solicitud');
            $valoracion_tecnica->desincorporar = $request->input('desincorporar');
            $valoracion_tecnica ->descripcion = $request->input('descripcion');
            $valoracion_tecnica ->fecha = $request->input('fecha');

            $valoracion_tecnica->save();

            // Registrar en la bitácora
            $bitacora = new BitacoraController();
            $bitacora->update();
        try {
            return redirect('control_tecnica')->with('success', '✅ La Valoración Técnica ha sido Actualizado exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: .';
            return redirect()->back()->withErrors($errorMessage);
        }
    }

}

