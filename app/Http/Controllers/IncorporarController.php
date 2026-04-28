<?php

namespace App\Http\Controllers;

use App\Models\Incorporar;
use App\Models\Asignaciones;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IncorporarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asignaciones = Asignaciones::all();
        return view('incorporar.index', compact('asignaciones'));
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
