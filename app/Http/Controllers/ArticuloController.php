<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Equipo;
use App\Models\Marcas;
use App\Models\Modelos;
use App\Models\Mobiliarios;
use App\Models\Perifericos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
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
        $articulos = Articulo::with(['marca', 'modelo', 'articuloEspecifico'])->get();
        return view('articulo.index', compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $marcas = Marcas::all();
        $modelos = Modelos::all();
        $perifericos = Perifericos::all();
        // return view('articulo.create', compact('marcas', 'modelos'));
        return view('articulo.create', compact('marcas', 'modelos', 'perifericos'), ['previous_url' => url()->previous()]); // Al cargar esta vista se le envia la url anterior a la vista solicitante/create.blade.php.
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // Validar el artículo común y el camino de herencia a seguir
        // $request->validate([
        //     'id_marca'      => 'required|exists:marcas,id',
        //     'id_modelo'     => 'required|exists:modelos,id',
        //     'tipo' => 'required|in:equipo,mobiliario',
        // ]);
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
        $articulo->id_marca = $request->id_marca;
        $articulo->id_modelo = $request->id_modelo;
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
            $articuloMobiliario->altura = $request->altura;
            $articuloMobiliario->anchura = $request->anchura;
            $articuloMobiliario->serial = $request->serial;

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
            $articuloEquipo->cpu = $request->cpu;
            $articuloEquipo->ram = $request->ram;
            $articuloEquipo->disco_duro = $request->disco_duro;
            $articuloEquipo->sistema_operativo = $request->sistema_operativo;
            $articuloEquipo->serial = $request->serial;
            $articuloEquipo->id_periferico = $request->id_periferico;

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

    public function modal(Request $marca)
    {
        $articulo = Articulo::with('marca')->get(); // Cargar la relación con "marca"
        $articulo = Articulo::with('modelo')->get(); // Cargar la relación con "modelo"
        $marcas = request()->except('_token');
        Marcas::create($marcas);

        $modelos = request()->except('_token');
        Modelos::create($modelos);

        return redirect()->back();

        // $sqlBD = DB::table('marcas')->get();
        // $sqlBD->save($marcas);

        // $sqlBD = DB::table('marcas');
        // $sqlBD::insert($datosModal);

        // return view('equipo.create', compact('marcas','modelos')); // Pasar los cargos a la vista "form.blade.php"
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
    public function edit(Articulo $articulo)
    {
        //
        $articulo = articulo::with('articuloEspecifico')->find($id);
        $marcas = Marcas::all();
        $modelos = Modelos::all();
        $perifericos = Perifericos::all();
        return view('articulo.edit',compact('articulo', 'marcas', 'modelos', 'perifericos'));
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
        //
        
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
    }
}
