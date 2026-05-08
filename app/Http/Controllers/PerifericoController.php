<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perifericos;
use App\Models\Marcas;
use App\Models\Modelos;
use App\Models\TipoPerifericos;
use App\Http\Controllers\BitacoraController;
use Illuminate\Database\QueryException;
use Barryvdh\DomPDF\Facade\Pdf;

class PerifericoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-periferico|crear-periferico|editar-periferico|borrar-periferico', ['only' => ['index']]);
        $this->middleware('permission:crear-periferico', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-periferico', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-periferico', ['only' => ['destroy']]);
    }

    public function index()
    {
        $perifericos = Perifericos::with('marca')->get();
        $perifericos = Perifericos::with('modelo')->get();
        $perifericos = Perifericos::with('tipo_periferico')->get();
        return view('periferico.index', compact('perifericos'));
    }

    public function create()
    {
        $marcas = Marcas::all();
        $modelos = Modelos::all();
        $tipo_perifericos = TipoPerifericos::all();
        return view('periferico.create', compact('marcas', 'modelos', 'tipo_perifericos'));
    }

    public function store(Request $request)
    {
        /* $request->validate([
            'cedula_voce' => 'required|unique:consejo_comunals,cedula_voce',
        ], [
            'cedula_voce.unique' => 'Esta cédula ya existe.',
        ]); */

        $periferico = new Perifericos();
        $periferico->id_tipo = $request->input('id_tipo');
        $periferico->id_marca = $request->input('id_marca');
        $periferico->id_modelo = $request->input('id_modelo');
        $periferico->serial = $request->input('serial');

        $periferico->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('periferico.index')->with('success', '✅ El periférico ha sido guardado exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    public function edit($id)
    {
        $periferico = Perifericos::find($id);
        $marcas = Marcas::all();
        $modelos = Modelos::all();
        $tipo_perifericos = TipoPerifericos::all();
        return view('periferico.edit', compact('periferico', 'marcas', 'modelos', 'tipo_perifericos'));
    }

    public function update(Request $request, $id)
    {
        $periferico = Perifericos::find($id);

        $periferico->id_tipo = $request->input('id_tipo');
        $periferico->id_marca = $request->input('id_marca');
        $periferico->id_modelo = $request->input('id_modelo');
        $periferico->serial = $request->input('serial');

        $periferico->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect ('periferico')->with('success', '✅ El periférico ha sido Actualizado exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    public function destroy($id)
    {
        Perifericos::find($id)->delete();
        $bitacora = new BitacoraController();
        $bitacora->update();
        return redirect()->route('periferico.index')->with('eliminar', 'ok');
    }
}
