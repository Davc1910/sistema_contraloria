<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Personas;
use App\Models\Articulo;
use App\Models\ArticuloSolicitud;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class SolicitudController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-solicitud|crear-solicitud|editar-solicitud|', ['only' => ['index']]);
        $this->middleware('permission:crear-solicitud', ['only' => ['create','store']]);
        $this->middleware('permission:editar-solicitud', ['only' => ['edit','update']]);

    }

    public function create()
    {
        $personas = Personas::all();
        $articulos = Articulo::with('articuloEspecifico')->get();
        $articulosSeleccionados = ArticuloSolicitud::all();
        return view('solicitud.create', compact('personas','articulos', 'articulosSeleccionados'));
    }

    public function store(Request $request)
    {

        $articulosSeleccionados = $request->input('articulos', []); //[cite: 2]

        // Si seleccionó solicitud Simple, guardamos ese ID en el array de artículos
        if ($request->filled('id_articulo') && empty($articulosSeleccionados)) { //[cite: 2]
            $articulosSeleccionados = [$request->input('id_articulo')]; //[cite: 2]
        }

        // 1. Guardar la solicitud
        $solicitudes = new Solicitud();
        $solicitudes->id_persona = $request->input('id_persona'); //[cite: 2]

        // Si es simple guarda id_articulo, si es compuesta asigna null o el primer ID de la lista
        $solicitudes->id_articulo = $request->input('id_articulo') ?? ($articulosSeleccionados[0] ?? null); //[cite: 2]

        $solicitudes->fecha = $request->input('fecha'); //[cite: 2]
        $solicitudes->descripcion = $request->input('descripcion'); //[cite: 2]
        $solicitudes->save(); //[cite: 2]

        // 2. Crear registros en la tabla puente para los artículos de la solicitud
        foreach ($articulosSeleccionados as $articuloId) { //[cite: 2]
            $puente = new ArticuloSolicitud(); //[cite: 2]
            $puente->id_articulo = $articuloId; //[cite: 2]
            $puente->id_solicitud = $solicitudes->id; //[cite: 2]
            $puente->save(); //[cite: 2]
        }

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
           return redirect()->route('tipo_solicitud.index')->with('success', '✅ La solicitud ha sido Guardada exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    public function edit($id)
    {
       $solicitud = Solicitud::with('articulos')->findOrFail($id);
        $personas = Personas::all();
        $articulos = Articulo::all();

        // Obtener los IDs de los articulos seleccionados de la tabla puente articulos_solicituds
        $articulosSeleccionados = ArticuloSolicitud::where('id_solicitud', $id)->pluck('id_articulo')->toArray();

        return view('solicitud.edit', compact('solicitud','personas','articulos', 'articulosSeleccionados'));
    }

    public function update(Request $request, $id)
    {

        $solicitud = Solicitud::find($id);
        $solicitud->id_persona = $request->input('id_persona');
        $solicitud->id_articulo = $request->input('id_articulo');
        $solicitud->fecha = $request->input('fecha');
        $solicitud->descripcion = $request->input('descripcion');

        // Guardar los cambios en la solicitud
        $solicitud->save();

        // Actualizar la tabla puente articulos_solicituds
        $articulosSeleccionados = $request->input('articulos', []);
        ArticuloSolicitud::where('id_solicitud', $id)->delete(); // Eliminar registros anteriores
        foreach ($articulosSeleccionados as $articuloId) {
            $puente = new ArticuloSolicitud();
            $puente->id_articulo = $articuloId;
            $puente->id_solicitud = $solicitud->id;
            $puente->save();
        }

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect('tipo_solicitud')->with('success', '✅ La solicitud ha sido Actualizada exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }


}
