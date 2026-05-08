<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller

{

    public function bitacora()
    {
        $bitacora = Bitacora::all();
        return view('reporte.bitacora', compact('bitacora'));
    }

}


