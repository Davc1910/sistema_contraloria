<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Oficinas;
use App\Models\Personas;
use App\Models\Modelos;
use App\Models\Marcas;
use App\Models\Mobiliarios;
use App\Models\perifericos;
use App\Models\Articulo;
use App\Models\Equipo;
use App\Models\Solicitud;
use App\Models\tipoSolicitud;
use App\Models\TipoPerifericos;



class homeController extends Controller
{
    //
    public function index(){

        $oficinas = Oficinas::all();
        $count_oficina = DB::table('oficinas')
        ->count();

        $personas = Personas::all();
        $count_persona = DB::table('personas')
        ->count();

        $modelos = Modelos::all();
        $count_modelo = DB::table('modelos')
        ->count();

        $marcas = Marcas::all();
        $count_marca = DB::table('marcas')
        ->count();

        $tipoperifericos = TipoPerifericos::all();
        $count_tipoperiferico = DB::table('tipo_perifericos')
        ->count();

        $perifericos = perifericos::all();
        $count_periferico = DB::table('perifericos')
        ->count();

        $articulo = Articulo::all();
        $count_articulo = DB::table('articulos')
        ->count();

        $equipos = Equipo::all();
        $count_equipo = DB::table('equipos')
        ->count();

        $mobilarios = Mobiliarios::all();
        $count_mobilario = DB::table('mobiliarios')
        ->count();

        $solicitud = Solicitud::all();
        $count_solicitud = DB::table('solicitudes')
        ->count();

        $tiposolicitud = TipoSolicitud::all();
        $count_tiposolicitud = DB::table('tipo_solicitudes')
        ->count();

        return view('home.inicio' , compact('count_oficina', 'count_persona', 'count_modelo', 'count_marca', 'count_mobilario', 'count_equipo', 'count_periferico', 'count_articulo', 'count_solicitud', 'count_tiposolicitud', 'count_tipoperiferico') ,  [
        'count' =>   $count_oficina, $count_persona, $count_modelo, $count_marca, $count_mobilario, $count_equipo, $count_periferico, $count_articulo, $count_solicitud, $count_tiposolicitud, $count_tipoperiferico]);

    }

}
