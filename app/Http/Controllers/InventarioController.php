<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Mobiliario;
use App\Models\Equipo;
use App\Models\Periferico;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:ver-articulo|crear-articulo|editar-articulo|borrar-articulo', ['only' => ['index']]);
    }

    public function index()
    {
        $articulos = Articulo::with('articuloEspecifico')->get();

        return view('inventario.index', compact('articulos'));
    }
}
