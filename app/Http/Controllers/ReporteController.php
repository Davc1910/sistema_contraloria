<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;
use App\Models\Solicitud;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller

{

    public function bitacora()
    {
        $bitacora = Bitacora::all();
        return view('reporte.bitacora', compact('bitacora'));
    }

    public function index(Request $request)
    {
        $solicitudes = Solicitud::with(['persona.oficina', 'articulos', 'tipoSolicitud'])
            ->orderByDesc('fecha')
            ->get();

        return view('reporte.index', compact('solicitudes'));
    }

    public function generarPDF()
    {
        $solicitudes = Solicitud::with(['persona.oficina', 'articulos', 'tipoSolicitud'])
            ->orderByDesc('fecha')
            ->get();

        return Pdf::loadView('reporte.pdf', compact('solicitudes'))
            ->stream('reporte-general.pdf');

    }

}


