<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Seguimientos;
use App\Models\Asignaciones;
use App\Models\Evaluaciones;
use App\Models\Proyectos;
use App\Models\Ayudas;
use App\Models\Resposanbles;
use App\Models\Comunidades;
use App\Models\Parroquia;
use App\Models\Bitacora;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class EspecificosController extends Controller
{
    
    public function index(Request $request)
    {

        $seguimiento = Seguimientos::join('asignaciones', 'asignaciones.id', '=', 'seguimientos.id_asignacion')
            ->join('evaluaciones', 'evaluaciones.id', '=', 'asignaciones.id_evaluacion')
            ->join('proyectos', 'proyectos.id', '=', 'evaluaciones.id_proyecto')
            ->join('resposanbles', 'resposanbles.id', '=', 'evaluaciones.id_resposanble')
            ->select([
                'resposanbles.cedula',
                'resposanbles.nombre',
                'resposanbles.apellido',
                'proyectos.nombre_pro',
                'proyectos.tipo_pro',
                'proyectos.cantidad_bene',
                'asignaciones.direccion',
                'asignaciones.impacto_ambiental',
                'asignaciones.impacto_social',
                'seguimientos.estado_actual',
                'seguimientos.gasto',
                'seguimientos.moneda'
            ])
            ->get();
            
        return view('especifico.index', ['resultados' => $seguimiento]);

    }
    

    public function generarPDF(Request $request)
    {

        $search = $request->input('search');

        // Iniciar la consulta base
        $seguimientoQuery  = Seguimientos::join('asignaciones', 'asignaciones.id', '=', 'seguimientos.id_asignacion')
            ->join('evaluaciones', 'evaluaciones.id', '=', 'asignaciones.id_evaluacion')
            ->join('proyectos', 'proyectos.id', '=', 'evaluaciones.id_proyecto')
            ->join('resposanbles', 'resposanbles.id', '=', 'evaluaciones.id_resposanble')
            ->select([
                'resposanbles.cedula',
                'resposanbles.nombre',
                'resposanbles.apellido',
                'proyectos.nombre_pro',
                'proyectos.tipo_pro',
                'proyectos.cantidad_bene',
                'asignaciones.direccion',
                'asignaciones.impacto_ambiental',
                'asignaciones.impacto_social',
                'seguimientos.estado_actual',
                'seguimientos.gasto',
                'seguimientos.moneda'
            ]);

        // Aplicar el filtro de búsqueda si existe
        if ($search) {
            $seguimientoQuery->where(function($query) use ($search) {
                $query->where('resposanbles.cedula', 'LIKE', '%' . $search . '%')
                ->orWhere('resposanbles.nombre', 'LIKE', '%' . $search . '%')
                ->orWhere('resposanbles.apellido', 'LIKE', '%' . $search . '%')
                ->orWhere('proyectos.nombre_pro', 'LIKE', '%' . $search . '%')
                ->orWhere('proyectos.tipo_pro', 'LIKE', '%' . $search . '%')
                ->orWhere('proyectos.cantidad_bene', 'LIKE', '%' . $search . '%')
                ->orWhere('asignaciones.direccion', 'LIKE', '%' . $search . '%')
                ->orWhere('asignaciones.impacto_ambiental', 'LIKE', '%' . $search . '%')
                ->orWhere('asignaciones.impacto_social', 'LIKE', '%' . $search . '%')
                ->orWhere('seguimientos.estado_actual', 'LIKE', '%' . $search . '%')
                ->orWhere('seguimientos.gasto', 'LIKE', '%' . $search . '%')
                ->orWhere('seguimientos.moneda' ,'LIKE', '%' . $search . '%');
                    
            });
        }

        // Ejecutar la consulta
        $seguimiento = $seguimientoQuery->get();

        // Generar el PDF incluso si no se encuentran registros
        $pdf = PDF::loadView('especifico.pdf', ['resultados' => $seguimiento]);
        return $pdf->stream('especifico.pdf');

    }

    public function mensual (Request $request) {
         ///
        return view('especifico.mensual'); 
    
    }


    public function bitacora()
    { 
        $bitacora = Bitacora::all();
        return view('especifico.bitacora', compact('bitacora'));
    }


}

