<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Equipo;
use App\Models\Mobiliarios;
use App\Models\Perifericos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;

class ArticuloController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-articulo|crear-articulo|editar-articulo|borrar-articulo', ['only' => ['index']]);
        $this->middleware('permission:crear-articulo', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-articulo', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-articulo', ['only' => ['destroy']]);
    }

    public function index()
    {
        // Usamos Eager Loading para evitar el problema de consultas N+1
        $articulos = Articulo::with(['articuloEspecifico'])->get();
        return view('articulo.index', compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $perifericos = Perifericos::all();

        $mobiliariosRegistrados = Articulo::where('tipo_biene', 'Mobiliario')->count();
        $equiposRegistrados = Articulo::where('tipo_biene', 'Equipo')->count();

        $codigo_mobiliario = '2-01-02-' . str_pad($mobiliariosRegistrados + 1, 4, '0', STR_PAD_LEFT);
        $codigo_equipo = '2-01-04-' . str_pad($equiposRegistrados + 1, 4, '0', STR_PAD_LEFT);

        return view('articulo.create', compact(
            'perifericos',
            'codigo_mobiliario',
            'codigo_equipo'
        ), ['previous_url' => url()->previous()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
            'serial' => 'unique:mobiliarios,serial',
            'serial' => 'unique:equipos,serial',
            ],
            [
            'serial.unique' => 'Está Serial de Mobiliario ya existe en la base de datos.',
            'serial.unique' => 'Este Serial de Equipo ya existe en la base de datos.'
            ]
        );

        // Crea un nuevo objeto Articulo
        $articulo = new Articulo;

        // Asigna los valores del formulario de solicitud a las propiedades del objeto Articulo
        // dd($request->id_marca, $request->id_modelo);
        $articulo->tipo_biene = $request->tipo_biene;

        // Guarda el objeto Articulo en la base de datos
        $articulo->save();

        // Verifica si el tipo_biene de Articulo es 'Mobiliario'
        if ($request->tipo_biene == 'Mobiliario') {

            // Crea un nuevo objeto Mobiliario
            $articuloMobiliario = new Mobiliarios;

            // Asigna el ID del objeto Articulo al articulo_id del objeto Mobiliario
            $articuloMobiliario->articulo_id = $articulo->id;
            $articuloMobiliario->id = $articulo->id;

            // Asigna los valores del formulario de solicitud a las propiedades del objeto articuloMobiliario
            $articuloMobiliario->tipo_mobiliario = $request->tipo_mobiliario;
            $articuloMobiliario->codigo_mobiliario = $request->codigo_mobiliario;
            $articuloMobiliario->altura = $request->altura;
            $articuloMobiliario->anchura = $request->anchura;
            $articuloMobiliario->serial = $request->serial;
            $articuloMobiliario->descripcion_mobiliario = $request->descripcion_mobiliario;

            // Guarda el objeto PersonaNatural en la base de datos
            $articuloMobiliario->save();

            // Asocia el objeto equipo_articuloMobiliario con el objeto articulo
            $articulo->articuloEspecifico()->associate($articuloMobiliario);

            // Guarda el objeto articulo en la base de datos
            $articulo->save();

            $bitacora = new BitacoraController;
            $bitacora->update();

        }
         // Verifica si el tipo_biene de solicitante es 'Jurídico'
        else if ($request->tipo_biene == 'Equipo') {

            // Crea un nuevo objeto PersonaJuridica
            $articuloEquipo = new Equipo;

            // Asigna el ID del objeto articulo al articulo_id del objeto Equipo
            $articuloEquipo->articulo_id = $articulo->id;

            // Asigna los valores del formulario de solicitud a las propiedades del objeto articuloEquipo
            $articuloEquipo->codigo_equipo = $request->codigo_equipo;
            $articuloEquipo->cpu = $request->cpu;
            $articuloEquipo->ram = $request->ram;
            $articuloEquipo->disco_duro = $request->disco_duro;
            $articuloEquipo->sistema_operativo = $request->sistema_operativo;
            $articuloEquipo->serial = $request->serial;
            $articuloEquipo->id_periferico = $request->id_periferico;
            $articuloEquipo->descripcion_equipo = $request->descripcion_equipo;

            // Guarda el objeto articuloEquipo en la base de datos
            $articuloEquipo->save();

            // Asocia el objeto articuloEquipo con el objeto Articulo
            $articulo->articuloEspecifico()->associate($articuloEquipo);

            // Guarda el objeto articulo en la base de datos
            $articulo->save();

            $bitacora = new BitacoraController;
            $bitacora->update();

        }

        try {

            return redirect($request->input('previous_url'));

            } catch (QueryException $exception) {
                $errorMessage = 'Error: Está cedula ya existe en la base de datos.';
                return redirect()->back()->withErrors($errorMessage);
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo = Articulo::with('articuloEspecifico')->findOrFail($id);
        $especifico = $articulo->articuloEspecifico;

        $codigo_mobiliario = $especifico->codigo_mobiliario ?? null;
        $tipo_mobiliario = $especifico->tipo_mobiliario ?? null;
        $altura = $especifico->altura ?? null;
        $anchura = $especifico->anchura ?? null;
        $serial = $especifico->serial ?? null;
        $descripcion_mobiliario = $especifico->descripcion_mobiliario ?? null;

        $codigo_equipo = $especifico->codigo_equipo ?? null;
        $cpu = $especifico->cpu ?? null;
        $ram = $especifico->ram ?? null;
        $disco_duro = $especifico->disco_duro ?? null;
        $sistema_operativo = $especifico->sistema_operativo ?? null;
        $id_periferico = $especifico->id_periferico ?? null;
        $descripcion_equipo = $especifico->descripcion_equipo ?? null;

        $perifericos = Perifericos::all();

        return view('articulo.edit', compact(
            'articulo',
            'perifericos',
            'codigo_mobiliario',
            'tipo_mobiliario',
            'altura',
            'anchura',
            'serial',
            'descripcion_mobiliario',
            'codigo_equipo',
            'cpu',
            'ram',
            'disco_duro',
            'sistema_operativo',
            'id_periferico',
            'descripcion_equipo'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $articulo = Articulo::with('articuloEspecifico')->findOrFail($id);
        $articuloEspecifico = $articulo->articuloEspecifico;

        $articulo->tipo_biene = $request->tipo_biene;
        $articulo->save();

        if ($request->tipo_biene == 'Mobiliario') {
            $mobiliario = $articuloEspecifico instanceof Mobiliarios ? $articuloEspecifico : new Mobiliarios();
            $mobiliario->articulo_id = $articulo->id;
            $mobiliario->codigo_mobiliario = $request->codigo_mobiliario;
            $mobiliario->tipo_mobiliario = $request->tipo_mobiliario;
            $mobiliario->altura = $request->altura;
            $mobiliario->anchura = $request->anchura;
            $mobiliario->serial = $request->serial;
            $mobiliario->descripcion_mobiliario = $request->descripcion_mobiliario;
            $mobiliario->save();

            $articulo->articuloEspecifico()->associate($mobiliario);
            $articulo->save();
        } elseif ($request->tipo_biene == 'Equipo') {
            $equipo = $articuloEspecifico instanceof Equipo ? $articuloEspecifico : new Equipo();
            $equipo->articulo_id = $articulo->id;
            $equipo->codigo_equipo = $request->codigo_equipo;
            $equipo->cpu = $request->cpu;
            $equipo->ram = $request->ram;
            $equipo->disco_duro = $request->disco_duro;
            $equipo->sistema_operativo = $request->sistema_operativo;
            $equipo->serial = $request->serial;
            $equipo->id_periferico = $request->id_periferico;
            $equipo->descripcion_equipo = $request->descripcion_equipo;
            $equipo->save();

            $articulo->articuloEspecifico()->associate($equipo);
            $articulo->save();
        }

        try {
            return redirect()->route('articulo.index')->with('success', '✅ El artículo ha sido actualizado exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articulo $articulo)
    {
        //
        try {
            // Busca el Solicitante con el ID proporcionado en la base de datos
            $articulo = Articulo::find($id);

            if ($articulo) {
                // Verifica si hay alguna solicitud asociada al articulo
                $solicitudes = Solicitud::where('id_articulo', $id)->count();

                if ($solicitudes === 0) {

                    if ($articulo->articuloEspecifico !== null) {
                        $articulo->articuloEspecifico->delete();
                    }
                    $articulo->delete();
                    $bitacora = new BitacoraController;
                    $bitacora->update();
                    return redirect('articulo')->with('eliminar', 'ok');
                } else {
                    // Si hay solicitudes de recaudos, muestra un mensaje de advertencia
                    $errorMessage = 'Advertencia: El articulo está asociado a una solicitud. No se puede eliminar.';
                    return redirect()->back()->withErrors($errorMessage);
                }
            } else {
                // El articulo no existe, muestra un mensaje de error
                $errorMessage = 'Error: No se encontró el articulo con el ID proporcionado.';
                return redirect()->back()->withErrors($errorMessage);
            }
        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar el articulo debido a que tiene otros registros.';
            return redirect()->back()->withErrors($errorMessage);
        }

    }
}
