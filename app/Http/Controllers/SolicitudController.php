<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asignaciones;
use App\Models\Personas;
use App\Models\Mobiliarios;
use App\Models\Perifericos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class AsignacionesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-asignacion|crear-asignacion|editar-asignacion|', ['only' => ['index']]);
        $this->middleware('permission:crear-asignacion', ['only' => ['create','store']]);
        $this->middleware('permission:editar-asignacion', ['only' => ['edit','update']]);

    }

    public function create()
    {
        $personas = Personas::all();
        $mobiliarios = Mobiliarios::all();
        $perifericos = Perifericos::all();
        return view('asignacion.create', compact('personas','mobiliarios', 'perifericos'));
    }

    public function store(Request $request)
    {

        $asignaciones = new Asignaciones();
        $asignaciones->id_persona = $request->input('id_persona');
        $asignaciones->id_mobiliario = $request->input('id_mobiliario');
        $asignaciones->id_periferico = $request->input('id_periferico');
        $asignaciones->fecha = $request->input('fecha');

        $asignaciones->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
           return redirect()->route('incorporar.index')->with('success', '✅ La asignación ha sido Guardada exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    public function edit($id)
    {
        $asignacion = Asignaciones::find($id);
        $personas = Personas::all();
        $mobiliarios = Mobiliarios::all();
        $perifericos = Perifericos::all();
        return view('asignacion.edit', compact('asignacion','personas','mobiliarios', 'perifericos'));
    }

    public function update(Request $request, $id)
    {

        $asignacion = Asignaciones::findOrFail($id);
        $asignacion->id_persona = $request->input('id_persona');
        $asignacion->id_mobiliario = $request->input('id_mobiliario');
        $asignacion->id_periferico = $request->input('id_periferico');
        $asignacion->fecha = $request->input('fecha');

        $asignacion->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect('incorporar')->with('success', '✅ La asignación ha sido Actualizada exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }


}
