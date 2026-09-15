<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Personas;
use App\Models\Oficinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\BitacoraController;
use Carbon\Carbon;

class PersonaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-persona|crear-persona|editar-persona|borrar-persona', ['only' => ['index']]);
         $this->middleware('permission:crear-persona', ['only' => ['create','store']]);
         $this->middleware('permission:editar-persona', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-persona', ['only' => ['destroy']]);
    }

    public function index()
    {
        $personas = Personas::with('oficina')->get();
        return view('persona.index', compact('personas'));
    }

    public function create()
    {
        $oficinas = Oficinas::all();
        return view('persona.create', compact('oficinas'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
            'cedula' => 'unique:personas,cedula',
            'telefono' => 'unique:personas,telefono',
            'email' => 'unique:personas,email',
            ],
            [
            'cedula.unique' => 'La cédula ya existe en la base de datos.',
            'telefono.unique' => 'El teléfono ya existe en la base de datos.',
            'email.unique' => 'El correo electrónico ya existe en la base de datos.'
            ]
        );

        $personas = new Personas();
        $personas->cedula = $request->input('cedula');
        $personas->nombre = $request->input('nombre');
        $personas->apellido = $request->input('apellido');
        $personas->email = $request->input('email');
        $personas->telefono = $request->input('telefono');
        $personas->id_oficina = $request->input('id_oficina');

        $personas->save();

        // Registrar en bitácora
        $bitacora = new BitacoraController();
        $bitacora->update();

        try {
            return redirect()->route('persona.index')->with('success', '✅ La persona ha sido Guardada exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persona = Personas::find($id);
        $oficinas = Oficinas::all();
        return view('persona.edit', compact('persona', 'oficinas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
            'cedula' => 'unique:personas,cedula,' . $id,
            'telefono' => 'unique:personas,telefono,' . $id,
            'email' => 'unique:personas,email,' . $id,
            ],
            [
            'cedula.unique' => 'La cédula ya existe en la base de datos.',
            'telefono.unique' => 'El teléfono ya existe en la base de datos.',
            'email.unique' => 'El correo electrónico ya existe en la base de datos.'
            ]
        );

        $persona = Personas::find($id);
        $persona->cedula = $request->input('cedula');
        $persona->nombre = $request->input('nombre');
        $persona->apellido = $request->input('apellido');
        $persona->email = $request->input('email');
        $persona->telefono = $request->input('telefono');
        $persona->id_oficina = $request->input('id_oficina');

        $persona->save();

        // Registrar en bitácora
        $bitacora = new BitacoraController();
        $bitacora->update();


        try {
            return redirect('persona')->with('success', '✅ La persona ha sido Actualizada exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }

    }


    public function destroy($id)
    {
        try {
            $persona = Personas::findOrFail($id);

            $persona->delete();
            $bitacora = new BitacoraController;
            $bitacora->update();
            return redirect('persona')->with('eliminar', 'ok');

        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar la persona debido a que está asociada a otros registros.';
            return redirect()->back()->withErrors($errorMessage);
        }
    }
}

