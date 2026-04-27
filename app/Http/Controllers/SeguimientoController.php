<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seguimientos;
use App\Models\Asignaciones;
use App\Models\ControlSeguimientos;
use App\Models\Visitas;
use Illuminate\Database\QueryException;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class SeguimientoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-seguimiento|crear-seguimiento|editar-ptoyecto|', ['only' => ['index']]);
        $this->middleware('permission:crear-seguimiento', ['only' => ['create','store']]);
        $this->middleware('permission:editar-seguimiento', ['only' => ['edit','update']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asignaciones = Asignaciones::all(); 

        // $asignaciones->each(function ($asignacion) {
        //     $asignacion->yaSeguimiento = Seguimientos::where('id_asignacion', $asignacion->id)->exists();
        // });

        return view('seguimiento.index', compact('asignaciones'));
    }

     public function pdf(Request $request)
    {
        
        $search = $request->input('search');
    
        if ($search) {
            // Filtrar los bancos según la consulta de búsqueda
             $asignaciones = Asignaciones::orWhereHas('vocero', function ($query) use ($search){
                            $query->where('cedula', 'LIKE', '%' . $search . '%')
                            ->orwhere('nombre', 'LIKE', '%' . $search . '%')
                            ->orwhere('apellido', 'LIKE', '%' . $search . '%');
                           })
                           ->orWhereHas('comunidad', function ($query) use ($search){
                            $query->where('nom_comuni ', 'LIKE', '%' . $search . '%');
                           })
                           ->orWhere('presupuesto', 'LIKE', '%' . $search . '%')
                         ->orWhere('moneda_presu', 'LIKE', '%' . $search . '%')
                         ->orWhere('direccion', 'LIKE', '%' . $search . '%')
                         ->orWhere('impacto_ambiental', 'LIKE', '%' . $search . '%')
                         ->orWhere('impacto_social', 'LIKE', '%' . $search . '%')
                           ->get();
        } else {
            // Obtener todos los bancos si no hay término de búsqueda
             $asignaciones = Asignaciones::with('vocero')->get();
             $asignaciones = Asignaciones::with('comunidad')->get();
            
        }
    
        $pdf = Pdf::loadView('seguimiento.pdf', compact('asignaciones'));
        return $pdf->stream('seguimiento.pdf');
    }

    public function getAsignacionDetalles($id)
    {
        // Recupera el asigacion por su ID
        $asignacion = Asignaciones::find($id);

        if (!$asignacion) {
            // Maneja el caso en que no se encuentre la vocero
            return response()->json(['error' => 'Asignacion no encontrada'], 404);
        }

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'id_evaluacion' => $asignacion->id_evaluacion,
            'imagenes' => $asignacion->imagenes,
            'nombre_ayuda' => $asignacion->ayuda->nombre_ayuda,
            'tipo_ayuda' => $asignacion->ayuda->tipo_ayuda,
            
        ]);
 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $asignacion = Asignaciones::findOrFail($id);
        $visitas = Visitas::all();

        return view('seguimiento.create', compact('asignacion', 'visitas')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $this->validate($request, [
            'evidencia_segui' => 'required|array|min:1',
            'evidencia_segui.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ], [
            'evidencia_segui.required' => 'Debe registrar una o más fotos.',
            'evidencia_segui.min' => 'Debe registrar al menos una foto.',
            'evidencia_segui.*.image' => 'Cada archivo debe ser una imagen.',
            'evidencia_segui.*.mimes' => 'Las imágenes deben ser de tipo jpeg, png, jpg, gif o svg.',
        ]);
            // Crear un nuevo seguimiento
            $seguimientos = new Seguimientos();
            $seguimientos->id_asignacion = $request->input('id_asignacion');
            $seguimientos->id_visita = $request->input('id_visita');
            $seguimientos->fecha_hor = $request->input('fecha_hor');
            $seguimientos->responsable_segui = $request->input('responsable_segui');
            $seguimientos->detalle_segui = $request->input('detalle_segui');
            $seguimientos->gasto = $request->input('gasto');
            $seguimientos->moneda = $request->input('moneda');
            $seguimientos->estado_actual = $request->input('estado_actual');
            $seguimientos->riesgos = $request->input('riesgos');

            if ($request->hasFile('evidencia_segui')) {
            $rutaGuardarDocs = 'evidencia_segui/seguimientos/';
            $nombresSeguimiento = [];
    
            foreach ($request->file('evidencia_segui') as $evidencia_segui) {
                $nombreSeguimiento = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($evidencia_segui->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $evidencia_segui->getClientOriginalExtension();
                $evidencia_segui->move(public_path($rutaGuardarDocs), $nombreSeguimiento);
                $nombresSeguimientos[] = $nombreSeguimiento;
            }
    
                $seguimientos->evidencia_segui = json_encode($nombresSeguimientos);
            }


            $seguimientos->save();

            $puente = new ControlSeguimientos();
            $puente->id_seguimiento = $seguimientos->id; // Usamos el ID de lo seguimientos creada
            $puente->id_asignacion = $request->input('id_asignacion');
            $puente->save();

            // Registrar en la bitácora
            $bitacora = new BitacoraController();
            $bitacora->update();
             
         try {
            return redirect('controlseguimiento')->with('success', '✅ El seguimiento ha sido Guardada exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: .';
            return redirect()->back()->withErrors($errorMessage);
        }
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seguimiento = Seguimientos::findOrFail($id);
        $visitas = Visitas::all();
        $responsable_segui = $seguimiento->responsable_segui;
        $fecha_segui = date('d/m/Y', strtotime($seguimiento->fecha_hor));
        $evidencia_segui = $seguimiento->evidencia_segui;
        return view('seguimiento.edit', compact('seguimiento','fecha_segui','responsable_segui','visitas','evidencia_segui')); 
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
        //     'id_proyecto' => 'required|exists:proyectos,id', //valido el id del proyecto
        //     'fecha_segui' => 'required|date',
        //     'responsable_segui' => 'required|string|max:255',
        //     'detalle_segui' => 'nullable|string',
        //     'estatus_proye' => 'nullable|string|max:50',
        // ]);
         
            $seguimiento = Seguimientos::findOrFail($id);
            $seguimiento->id_asignacion = $request->input('id_asignacion');
            $seguimiento->fecha_hor = $request->input('fecha_hor');
            $seguimiento->responsable_segui = $request->input('responsable_segui');
            $seguimiento->id_visita = $request->input('id_visita');
            $seguimiento->detalle_segui = $request->input('detalle_segui');
            $seguimiento->gasto = $request->input('gasto');
            $seguimiento->moneda = $request->input('moneda');
            $seguimiento->estado_actual = $request->input('estado_actual');
            $seguimiento->riesgos = $request->input('riesgos');
           
            if ($request->hasFile('evidencia_segui')) {
            $rutaGuardarDocs = 'evidencia_segui/seguimientos/';
            $nombresSeguimiento = [];
    
            foreach ($request->file('evidencia_segui') as $evidencia_segui) {
                $nombreSeguimiento = date('YmdHis') . '_' . uniqid() . '_' . pathinfo($evidencia_segui->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $evidencia_segui->getClientOriginalExtension();
                $evidencia_segui->move(public_path($rutaGuardarDocs), $nombreSeguimiento);
                $nombresSeguimientos[] = $nombreSeguimiento;
            }
    
                $seguimientos->evidencia_segui = json_encode($nombresSeguimientos);
            }

            $seguimiento->save();

            // Registrar en la bitácora
            $bitacora = new BitacoraController();
            $bitacora->update();
        try {
            return redirect('controlseguimiento')->with('success', '✅ El seguimiento ha sido Actualizado exitosamente.');
        } catch (QueryException $exception) {
            $errorMessage = 'Error: .';
            return redirect()->back()->withErrors($errorMessage);
        }
    }

}

