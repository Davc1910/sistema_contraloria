<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marcas;
use Illuminate\Database\QueryException;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;


class MarcaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-marca|crear-marca|editar-marca|borrar-marca', ['only' => ['index']]);
        $this->middleware('permission:crear-marca', ['only' => ['create','store']]);
        $this->middleware('permission:editar-marca', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-marca', ['only' => ['destroy']]);
    }

    public function index()
    {
        $marcas = Marcas::all();
        return view('marca.index', compact('marcas'));
    }

    public function create()
    {
        return view('marca.create');
    }


    public function store(Request $request)
    {

        $marcas = new Marcas();
        $marcas->nombre_marca = $request->input('nombre_marca');

        $marcas->save();

        //$bitacora = new BitacoraController();
        //$bitacora->update();

        try {

            return redirect()->route('marca.index')->with('success', '✅ La marca ha sido Guardada exitosamente.');

            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }

    }

    public function edit($id)
    {
        $marca =  Marcas::find($id);
        return view('marca.edit', compact('marca'));
    }

    public function update(Request $request, $id)
    {

        // Obtener La Comuna por ID
        $marca =  Marcas::find($id);

        // Actualizar los campos segun los del formulario
        $marca->nombre_marca = $request->input('nombre_marca');

        // Guardar los cambios en la base de datos
        $marca->save();

        // $bitacora = new BitacoraController;
        // $bitacora->update();

        try {

            return redirect ('marca')->with('success', '✅ La marca ha sido Actualizada exitosamente.');

            } catch (QueryException $exception) {
                $errorMessage = 'Error: .';
                return redirect()->back()->withErrors($errorMessage);
            }

    }

    public function destroy($id)
    {
        Marcas::find($id)->delete();
        // $bitacora = new BitacoraController;
        // $bitacora->update();
        return redirect('marca.index')->with('eliminar', 'ok');
    }
}
