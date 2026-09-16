<?php

namespace App\Http\Controllers;

use App\Models\TipoSolicitud;
use App\Models\Solicitud;
use App\Models\Articulo;
use App\Models\Personas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BitacoraController;
use Barryvdh\DomPDF\Facade\Pdf;

class TipoSolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todas las solicitudes y cargar relaciones
        $solicitudes = Solicitud::with('persona', 'articulo')->get();

        // Iterar sobre cada solicitud para verificar si está planificada
            $solicitudes->each(function ($solicitud) {
                // Buscar en la tabla TipoSolicitud si existe una tipo de solicitud para esta solicitud
                $solicitud->yaSolicitada = TipoSolicitud::where('id_solicitud', $solicitud->id)->exists();
            });

        // $recaudos = Recaudos::all();

        return view('tipo_solicitud.index', compact('solicitudes'));
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
     * @param  \App\Models\Incorporar  $incorporar
     * @return \Illuminate\Http\Response
     */
    public function show(Incorporar $incorporar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incorporar  $incorporar
     * @return \Illuminate\Http\Response
     */
    public function edit(Incorporar $incorporar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incorporar  $incorporar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incorporar $incorporar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incorporar  $incorporar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incorporar $incorporar)
    {
        //
    }
}
