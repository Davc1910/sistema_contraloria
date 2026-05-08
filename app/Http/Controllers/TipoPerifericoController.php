<?php

namespace App\Http\Controllers;

use App\Models\TipoPerifericos;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class TipoPerifericoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-tipo_periferico|crear-tipo_periferico|editar-tipo_periferico|borrar-tipo_periferico', ['only' => ['index']]);
        $this->middleware('permission:crear-tipo_periferico', ['only' => ['create','store']]);
        $this->middleware('permission:editar-tipo_periferico', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-tipo_periferico', ['only' => ['destroy']]);
    }

    public function index()
    {
        $tipos_perifericos = TipoPerifericos::all();
        return view('tipo_periferico.index', compact('tipos_perifericos'));
    }

    public function create()
    {
        return view('tipo_periferico.create');
    }

    public function store(Request $request)
    {

        $tipos_perifericos = new TipoPerifericos();
        $tipos_perifericos->tipo = $request->input('tipo');

        $tipos_perifericos->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('tipo_periferico.index')->with('success', '✅ El tipo de periférico ha sido guardado exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }

    }

    public function edit($id)
    {
        $tipo_periferico = TipoPerifericos::find($id);
        return view('tipo_periferico.edit', compact('tipo_periferico'));
    }

    public function update(Request $request, $id)
    {
        $tipo_periferico = TipoPerifericos::find($id);
        $tipo_periferico->tipo = $request->input('tipo');

        $tipo_periferico->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect ('tipo_periferico')->with('success', '✅ El tipo de periférico ha sido Actualizado exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    public function destroy($id)
    {
       TipoPerifericos::find($id)->delete();
        $bitacora = new BitacoraController();
        $bitacora->update();
        return redirect()->route('tipo_periferico.index')->with('eliminar', 'ok');
    }
}
