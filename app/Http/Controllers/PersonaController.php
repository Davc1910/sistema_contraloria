<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Personas;
use App\Models\Oficinas;
use App\Http\Controllers\BitacoraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
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

    //  public function pdf(Request $request)
    // {
    //     $search = $request->input('search');

    //     if ($search) {
    //         // Filtrar los bancos según la consulta de búsqueda
    //         $proyectos = Proyectos::where('nombre_pro', 'LIKE', '%' . $search . '%')
    //                        ->orWhere('descripcion_pro', 'LIKE', '%' . $search . '%')
    //                        ->orWhere('tipo_pro', 'LIKE', '%' . $search . '%')
    //                        ->orWhere('fecha_inicial', 'LIKE', '%' . $search . '%')
    //                        ->orWhere('fecha_final', 'LIKE', '%' . $search . '%')
    //                        ->orWhere('prioridad', 'LIKE', '%' . $search . '%')
    //                        ->get();
    //     } else {
    //         // Obtener todos los bancos si no hay término de búsqueda
    //         $proyectos = Proyectos::all();
    //     }

    //     // Generar el PDF, incluso si no se encuentran bancos
    //     $pdf = Pdf::loadView('proyecto.pdf', compact('proyectos'));
    //     return $pdf->stream('proyecto.pdf');
    // }

    // public function getproyectoDetalles($id)
    // {
    //     // Recupera el Proyecto por su ID
    //     $proyecto = Proyectos::find($id);

    //     if (!$proyecto) {
    //         // Maneja el caso en que no se encuentre la persona
    //         return response()->json(['error' => 'Persona no encontrada'], 404);
    //     }

    //     // Devuelve los datos relevantes en formato JSON
    //     return response()->json([
    //         'actividades' => $proyecto->actividades,
    //         'acta_conformidad' => $proyecto->acta_conformidad,
    //         'nombre_ayuda' => $proyecto->ayuda->nombre_ayuda,
    //         'tipo_ayuda' => $proyecto->ayuda->tipo_ayuda,
    //         'cantidad_bene' => $proyecto->cantidad_bene,
    //     ]);

    // }

    public function create()
    {
        $oficinas = Oficinas::all();
        return view('persona.create', compact('oficinas'));
    }

    public function store(Request $request)
    {
        // $request->merge([
        //     'fecha_inicial' => trim($request->input('fecha_inicial')),
        //     'fecha_final' => trim($request->input('fecha_final')),
        // ]);

        $personas = new Personas();
        $personas->cedula = $request->input('cedula');
        $personas->nombre = $request->input('nombre');
        $personas->apellido = $request->input('apellido');
        $personas->email = $request->input('email');
        $personas->telefono = $request->input('telefono');
        $personas->id_oficina = $request->input('id_oficina');

        $personas->save();

        // Registrar en bitácora
        // $bitacora = new BitacoraController();
        // $bitacora->update();

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
        // $request->validate([
        //     'nombre_pro' => 'required|string|max:150',
        //     'descripcion_pro' => 'nullable|string',
        //     'tipo_pro' => 'required|in:Infraestructura,Social,Educativo,Salud,Ambiental,Otro',
        //     'fecha_inicial' => 'required|date_format:d/m/Y',
        //     'fecha_final' => 'required|date_format:d/m/Y|after_or_equal:fecha_inicial',
        //     'prioridad' => 'required|in:Alta,Media,Baja',

        // ]);

        $persona = Personas::find($id);
        $persona->cedula = $request->input('cedula');
        $persona->nombre = $request->input('nombre');
        $persona->apellido = $request->input('apellido');
        $persona->email = $request->input('email');
        $persona->telefono = $request->input('telefono');
        $persona->id_oficina = $request->input('id_oficina');

        $persona->save();

        // Registrar en bitácora
        // $bitacora = new BitacoraController();
        // $bitacora->update();


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
            // $bitacora = new BitacoraController;
            // $bitacora->update();
            return redirect('persona')->with('eliminar', 'ok');

        } catch (QueryException $exception) {
            $errorMessage = 'Error: No se puede eliminar la persona debido a que está asociada a otros registros.';
            return redirect()->back()->withErrors($errorMessage);
        }
    }
}

