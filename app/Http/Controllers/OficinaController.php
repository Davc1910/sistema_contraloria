<?php

namespace App\Http\Controllers;

use App\Models\Oficinas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;


class OficinaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-oficina|crear-oficina|editar-oficina|borrar-oficina', ['only' => ['index']]);
        $this->middleware('permission:crear-oficina', ['only' => ['create','store']]);
        $this->middleware('permission:editar-oficina', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-oficina', ['only' => ['destroy']]);
    }

    public function index()
    {
        $oficinas = Oficinas::all();
        return view('oficina.index', compact('oficinas'));
    }

    public function create()
    {
        return view('oficina.create');
    }

    public function store(Request $request)
    {

        $oficinas = new Oficinas();
        $oficinas->nombre_encargado = $request->input('nombre_encargado');
        $oficinas->encargado_cedula = $request->input('encargado_cedula');
        $oficinas->nombre_oficina = $request->input('nombre_oficina');


        $oficinas->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect('oficina')->with('success', '✅ La oficina ha sido Guardada exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }


    public function edit($id)
    {
        $oficina = Oficinas::find($id);
        return view('oficina.edit', compact('oficina'));
    }


    public function update(Request $request, $id)
    {
        $oficina = Oficinas::find($id);
        $oficina->nombre_encargado = $request->input('nombre_encargado');
        $oficina->encargado_cedula = $request->input('encargado_cedula');
        $oficina->nombre_oficina = $request->input('nombre_oficina');

        $oficina->save();

        $bitacora = new BitacoraController();
        $bitacora->update();

       try {

            return redirect ('oficina')->with('success', '✅ La oficina ha sido Actualizada exitosamente.');

            } catch (QueryException $exception) {
                $errorMessage = 'Error: ' . $exception->getMessage();
                return redirect()->back()->withErrors($errorMessage);
            }
    }

    public function destroy($id)
    {
        Oficinas::find($id)->delete();
        $bitacora = new BitacoraController();
        $bitacora->update();
        return redirect('oficina')->with('eliminar', 'ok');
    }
}

