<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ValoracionTecnicas;
use Illuminate\Database\QueryException;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;


class ControlTecnicaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-control_tecnica|crear-control_tecnica', ['only' => ['index']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $valoracion_tecnicas = ValoracionTecnicas::all();
        return view('control_tecnica.index', compact('valoracion_tecnicas'));
    }

    public function getValoracionTecnicaDetalles($id)
    {
        // Recupera la inspección por su ID
        $valoracion_tecnica = ValoracionTecnicas::find($id);

        if (!$valoracion_tecnica) {
            // Maneja el caso en que no se encuentre la inspección
            return response()->json(['error' => 'Valoración técnica no encontrada'], 404);
        }

        // Devuelve los datos relevantes en formato JSON
        return response()->json([
            'res_fotos' => $valoracion_tecnica->res_fotos,
        ]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }
}
