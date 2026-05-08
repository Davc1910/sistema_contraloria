<?php

namespace App\Http\Controllers;
use App\Models\Mobiliarios;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class MobiliarioController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-mobiliario|crear-mobiliario|editar-mobiliario|borrar-mobiliario', ['only' => ['index']]);
        $this->middleware('permission:crear-mobiliario', ['only' => ['create','store']]);
        $this->middleware('permission:editar-mobiliario', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-mobiliario', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mobiliarios = Mobiliarios::all();

        return view('mobiliario.index', compact('mobiliarios'));
    }

    public function create()
    {
        return view('mobiliario.create');
    }

    public function store(Request $request)
    {

        $mobiliarios = Mobiliarios::create($request->all());

        $mobiliarios->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
            return redirect('mobiliario.index')->with('success', '✅ El mobiliario ha sido Guardado exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }

    }


    public function edit($id)
    {
        $mobiliario = Mobiliarios::find($id);
        return view('mobiliario.edit',compact('mobiliario'));
    }

    public function update(Request $request, $id)
    {

        $mobiliario = Mobiliarios::find($id);

        $mobiliario->tipo = $request->input('tipo');
        $mobiliario->serial = $request->input('serial');

        $mobiliario->save();

        $bitacora = new BitacoraController;
        $bitacora->update();

        try {
            return redirect('mobiliario')->with('success', '✅ El mobiliario ha sido Actualizado exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    public function destroy($id)
    {
        try {
            $mobiliario = Mobiliario::findOrFail($id);

            $mobiliario->delete();
            $bitacora = new BitacoraController;
            $bitacora->update();
            return redirect('mobiliario')->with('success', '✅ El mobiliario ha sido eliminado exitosamente.');

        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar el mobiliario debido a que está asociado a otros registros.';
            return redirect()->back()->withErrors($errorMessage);
        }
    }
}
