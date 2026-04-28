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

        // dd($asignaciones->id_evaluacion);

        $asignaciones->save();

        //$bitacora = new BitacoraController();
        //$bitacora->update();

        try {
           return redirect()->route('incorporar.index')->with('success', '✅ La asignación ha sido Guardada exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: ' . $exception->getMessage();
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    public function edit($id)
    {
        // $asignacion = Asignaciones::findOrFail($id);
        $asignacion = Asignaciones::with('evaluacion')->findOrFail($id);
        // $evaluacion = Evaluaciones::find($id);
        $evaluacion = $asignacion->evaluacion;
        $voceros = Voceros::all();
        $comunidades = Comunidades::all();
        $ayudas = Ayudas::all();
        $imagenes = $asignacion->imagenes;
        $latitud = $asignacion->latitud;
        $longitud = $asignacion->longitud;
        $direccion = $asignacion->direccion;

        return view('asignacion.edit', compact('evaluacion','asignacion', 'voceros', 'comunidades', 'ayudas', 'imagenes','latitud','longitud','direccion'));
    }

    public function update(Request $request, $id)
    {

        $asignacion = Asignaciones::findOrFail($id);
        $asignacion->id_evaluacion = $request->input('id_evaluacion');
        $asignacion->id_vocero = $request->input('id_vocero');
        $asignacion->id_comunidad = $request->input('id_comunidad');
        $asignacion->id_ayuda = $request->input('id_ayuda');

        // Verificar si se han cargado nuevos archivos
        if ($request->hasFile('imagenes')) {
            $rutaGuardarImg = 'imagenes/';
            $nombresImagenes = [];

            foreach ($request->file('imagenes') as $foto) {
                $imagenAsignacion = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($foto->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path($rutaGuardarImg), $imagenAsignacion);
                $nombresImagenes[] = $imagenAsignacion;
            }

            // Actualizar las imágenes
            $asignacion->imagenes = json_encode($nombresImagenes);
        }

        $asignacion->descri_alcance = $request->input('descri_alcance');
        $asignacion->moneda_presu = $request->input('moneda_presu');
        $asignacion->presupuesto = $request->input('presupuesto');
        $asignacion->impacto_ambiental = $request->input('impacto_ambiental');
        $asignacion->impacto_social = $request->input('impacto_social');
        $asignacion->fecha_inicio = $request->input('fecha_inicio');
        $asignacion->duracion_estimada = $request->input('duracion_estimada');

        $asignacion->latitud = $request->input('latitud');
        $asignacion->longitud = $request->input('longitud');
        $asignacion->direccion = $request->input('direccion');

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

    public function destroy($id)
    {
        // Proyecto::find($id)->delete();
        // $bitacora = new BitacoraController();
        // $bitacora->update();
        // return redirect()->route('proyecto.index')->with('eliminar', 'ok');
    }

}
