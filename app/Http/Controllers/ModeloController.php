<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modelos;
use Illuminate\Database\QueryException;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class ModeloController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-modelo|crear-modelo|editar-modelo|borrar-modelo', ['only' => ['index']]);
        $this->middleware('permission:crear-modelo', ['only' => ['create','store']]);
        $this->middleware('permission:editar-modelo', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-modelo', ['only' => ['destroy']]);
    }

    public function index()
    {
        $modelos = Modelos::all();
        return view('modelo.index', compact('modelos'));
    }

    public function create()
    {
        return view('modelo.create');
    }

    public function store(Request $request)
    {

        $modelos = new Modelos();

        $modelos->nombre_modelo = $request->input('nombre_modelo');

        $modelos->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {

            return redirect()->route('modelo.index')->with('success', '✅ El modelo ha sido Guardado exitosamente.');

            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }

    }

    public function edit($id)
    {
        $modelo = Modelos::find($id);
        return view('modelo.edit',compact('modelo'));
    }

    public function update(Request $request, $id)
    {

        $modelo = Modelos::find($id);

        $modelo->nombre_modelo = $request->input('nombre_modelo');

        $modelo->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {

            return redirect ('modelo')->with('success', '✅ El modelo ha sido Actualizado exitosamente.');

            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        Modelos::find($id)->delete();
        $bitacora = new BitacoraController;
        $bitacora->update();
        return redirect()->route('modelo.index')->with('eliminar', 'ok');
    }
}
