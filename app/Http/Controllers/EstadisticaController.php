<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 1. OBTENER DATOS DE EVALUACIONES (Total por mes)
        $evaluaciones_total = DB::table('evaluaciones')
        ->select(DB::raw('count(*) as total'), DB::raw('EXTRACT(MONTH FROM created_at) as mes'))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
        ->get();

        // Llamada a la función única, pasando la etiqueta del gráfico
        $data_evaluacion = $this->preprareChartData($evaluaciones_total, 'Número de evaluaciones');

        // 2. OBTENER DATOS DE EVALUACIONES (Estatus Aprobado/Negado)
        $evaluaciones_estatus = DB::table('evaluaciones')
        ->select(DB::raw('count(*) as total'), DB::raw('EXTRACT(MONTH FROM fecha_evalu) as mes'), 'estatus')
        ->whereYear('fecha_evalu', date('Y'))
        ->groupBy('estatus', DB::raw('EXTRACT(MONTH FROM fecha_evalu)'))
        ->get();

        $data_aprobado = $this->preparePieChartData($evaluaciones_estatus);

        // 3. OBTENER DATOS DE SEGUIMIENTOS (Total por mes) - MOVIDO ANTES DEL RETURN
        $seguimientos = DB::table('seguimientos')
        ->select(DB::raw('count(*) as total'), DB::raw('EXTRACT(MONTH FROM created_at) as mes'))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
        ->get();

        // Llamada a la función única, pasando la etiqueta de "Seguimientos"
        $data_seguimiento = $this->prepraChartData($seguimientos, 'Número de seguimientos');

        // Retorna la vista con TODAS las variables
        return view('estadistica.index', compact('data_evaluacion', 'data_aprobado', 'data_seguimiento'));
    }

    // --------------------------------------------------------------------------------------------------
    // FUNCIÓN DE PREPARACIÓN DE GRÁFICOS (ÚNICA DEFINICIÓN)
    // Usada para Evaluaciones y Seguimientos.
    // --------------------------------------------------------------------------------------------------
    private function preprareChartData($dataCollection, $label) 
    {
        $labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $dataset = array_fill(0, 12, 0);

        foreach ($dataCollection as $item) {
            $dataset[$item->mes - 1] = $item->total;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => $label, // Etiqueta dinámica
                    'data' => $dataset,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)', // Corregido 'bodercolor'
                    'borderWidth' => 3
                ]
            ]
        ];
    }


    private function preparePieChartData($evaluaciones)
    {
        $labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        
        $aprobadas = array_fill(0, 12, 0);
        $negados = array_fill(0, 12, 0);

        foreach ($evaluaciones as $evaluacion) {
            if ($evaluacion->estatus === 'Aprobado') {
                $aprobadas[$evaluacion->mes - 1] = $evaluacion->total;
            } elseif ($evaluacion->estatus === 'Negado') {
                $negados[$evaluacion->mes - 1] = $evaluacion->total;
            }
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Aprobadas',
                    'data' => $aprobadas,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 3
                ],
                [
                    'label' => 'Negados',
                    'data' => $negados,
                    'backgroundColor' => 'rgba(255, 159, 64, 0.2)',
                    'borderColor' => 'rgba(255, 159, 64, 1)',
                    'borderWidth' => 3
                ]
            ]
        ];
    }

    private function prepraChartData($dataCollection, $label) 
    {
        $labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $dataset = array_fill(0, 12, 0);

        foreach ($dataCollection as $item) {
            $dataset[$item->mes - 1] = $item->total;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => $label, // Etiqueta dinámica
                    'data' => $dataset,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)', // Corregido 'bodercolor'
                    'borderWidth' => 3
                ]
            ]
        ];
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
