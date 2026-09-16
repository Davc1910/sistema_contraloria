<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Personas;
use App\Models\Articulo;
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
        $articulos = Articulo::all();
        return view('solicitud.create', compact('personas','articulos'));
    }

    public function store(Request $request)
    {

        $solicitudes = new Solicitud();
        $solicitudes->id_persona = $request->input('id_persona');
        $solicitudes->id_articulo = $request->input('id_articulo');
        $solicitudes->fecha = $request->input('fecha');
        $solicitudes->descripcion = $request->input('descripcion');

        $solicitudes->save();

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
        $solicitud = Solicitud::find($id);
        $personas = Personas::all();
        $articulos = Articulos::all();
        return view('solicitud.edit', compact('solicitud','personas','articulos'));
    }

    public function update(Request $request, $id)
    {

        $solicitud = Solicitud::findOrFail($id);
        $solicitud->id_persona = $request->input('id_persona');
        $solicitud->id_articulo = $request->input('id_articulo');
        $solicitud->fecha = $request->input('fecha');
        $solicitud->descripcion = $request->input('descripcion');

        $solicitud->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect('incorporar')->with('success', '✅ La solicitud ha sido Actualizada exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }


}
