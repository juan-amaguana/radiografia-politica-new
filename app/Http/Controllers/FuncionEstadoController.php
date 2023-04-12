<?php

namespace App\Http\Controllers;

use App\Models\FuncionEstado;
use Illuminate\Http\Request;

class FuncionEstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\FuncionEstado  $funcionEstado
     * @return \Illuminate\Http\Response
     */
    public function show(FuncionEstado $funcionEstado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FuncionEstado  $funcionEstado
     * @return \Illuminate\Http\Response
     */
    public function edit(FuncionEstado $funcionEstado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FuncionEstado  $funcionEstado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FuncionEstado $funcionEstado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FuncionEstado  $funcionEstado
     * @return \Illuminate\Http\Response
     */
    public function destroy(FuncionEstado $funcionEstado)
    {
        //
    }

    public function funcionesEstado(){
        return FuncionEstado::where('categoria',0)->get();
    }

    public function institucionesIndependientes(){
        return FuncionEstado::where('categoria',1)->get();
    }
}
