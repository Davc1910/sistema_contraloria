<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seguimientos;
use App\Models\Asignaciones;
use App\Models\Evaluaciones;
use App\Models\Proyectos;
use App\Models\Ayudas;
use App\Models\Voceros;
use App\Models\Comunidades;
use App\Models\Bitacora;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller

{
    
    public function index(Request $request)
    {

        $seguimiento = Seguimientos::join('asignaciones', 'asignaciones.id', '=', 'seguimientos.id_asignacion')
            ->join('evaluaciones', 'evaluaciones.id', '=', 'asignaciones.id_evaluacion')
            ->join('proyectos', 'proyectos.id', '=', 'evaluaciones.id_proyecto')
            ->join('voceros', 'voceros.id', '=', 'asignaciones.id_vocero')
            ->join('comunidades', 'comunidades.id', '=', 'asignaciones.id_comunidad')
            ->join('ayudas', 'ayudas.id', '=', 'asignaciones.id_ayuda')
            ->select([
                'voceros.cedula',
                'voceros.nombre',
                'voceros.apellido',
                'proyectos.nombre_pro',
                'proyectos.tipo_pro',
                'proyectos.fecha_inicial',
                'proyectos.fecha_final',
                'evaluaciones.viabilidad',
                'evaluaciones.estatus_resp',
                'asignaciones.presupuesto',
                'asignaciones.moneda_presu',
                'comunidades.nom_comuni as nombre_comunidad',
                'ayudas.nombre_ayuda as nombre_ayuda',
                'ayudas.tipo_ayuda as tipo_ayuda'
            ])
            ->get();
            
        return view('reporte.index', ['resultados' => $seguimiento]);

    }
    

    public function generarPDF(Request $request)
    {

        $search = $request->input('search');

        // Iniciar la consulta base
        $seguimientoQuery  = Seguimientos::join('asignaciones', 'asignaciones.id', '=', 'seguimientos.id_asignacion')
            ->join('evaluaciones', 'evaluaciones.id', '=', 'asignaciones.id_evaluacion')
            ->join('proyectos', 'proyectos.id', '=', 'evaluaciones.id_proyecto')
            ->join('voceros', 'voceros.id', '=', 'asignaciones.id_vocero')
            ->join('comunidades', 'comunidades.id', '=', 'asignaciones.id_comunidad')
            ->join('ayudas', 'ayudas.id', '=', 'asignaciones.id_ayuda')
            ->select([
                'voceros.cedula',
                'voceros.nombre',
                'voceros.apellido',
                'proyectos.nombre_pro',
                'proyectos.tipo_pro',
                'proyectos.fecha_inicial',
                'proyectos.fecha_final',
                'evaluaciones.viabilidad',
                'evaluaciones.estatus_resp',
                'asignaciones.presupuesto',
                'asignaciones.moneda_presu',
                'comunidades.nom_comuni as nombre_comunidad',
                'ayudas.nombre_ayuda as nombre_ayuda',
                'ayudas.tipo_ayuda as tipo_ayuda'
            ]);

        // Aplicar el filtro de búsqueda si existe
        if ($search) {
            $seguimientoQuery->where(function($query) use ($search) {
                $query->where('voceros.cedula', 'LIKE', '%' . $search . '%')
                ->orWhere('voceros.nombre', 'LIKE', '%' . $search . '%')
                ->orWhere('voceros.apellido', 'LIKE', '%' . $search . '%')
                ->orWhere('proyectos.nombre_pro', 'LIKE', '%' . $search . '%')
                ->orWhere('proyectos.tipo_pro', 'LIKE', '%' . $search . '%')
                ->orWhere('proyectos.fecha_inicial', 'LIKE', '%' . $search . '%')
                ->orWhere('proyectos.fecha_final', 'LIKE', '%' . $search . '%')
                ->orWhere('evaluaciones.viabilidad', 'LIKE', '%' . $search . '%')
                ->orWhere('evaluaciones.estatus_resp', 'LIKE', '%' . $search . '%')
                ->orWhere('asignaciones.presupuesto', 'LIKE', '%' . $search . '%')
                ->orWhere('asignaciones.moneda_presu', 'LIKE', '%' . $search . '%')
                ->orWhere('comunidades.nom_comuni as nombre_comunidad', 'LIKE', '%' . $search . '%')
                ->orWhere('ayudas.nombre_ayuda as nombre_ayuda', 'LIKE', '%' . $search . '%')
                ->orWhere('ayudas.tipo_ayuda as tipo_ayuda', 'LIKE', '%' . $search . '%');
                    
            });
        }

        // Ejecutar la consulta
        $seguimiento = $seguimientoQuery->get();

        // Generar el PDF incluso si no se encuentran registros
        $pdf = PDF::loadView('reporte.pdf', ['resultados' => $seguimiento]);
        return $pdf->stream('reporte.pdf');

    }

    public function mensual (Request $request) {
         ///
        return view('reporte.mensual'); 
    
    }


    public function bitacora()
    { 
        $bitacora = Bitacora::all();
        return view('reporte.bitacora', compact('bitacora'));
    }


}


