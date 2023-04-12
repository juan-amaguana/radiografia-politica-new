<?php

namespace App\Http\Controllers;

use App\Models\TipoJuicio;
use Illuminate\Http\Request;

class TipoJuicioController extends Controller
{
    protected $rules = [
        'nombre_tipo_juicio' => 'required|max:60',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_juicios = TipoJuicio::all();
        return view('admin.tipo_juicio.index')->with(['tipo_juicios'=>$tipo_juicios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipo_juicio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $tipo_juicio = $request->all();

        TipoJuicio::create($tipo_juicio);

        flash('El tipo jucio '.$tipo_juicio['nombre_tipo_juicio'].' ha sido registrado.')->success();

        return redirect('/admin/tipoJucios');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoJuicio  $tipoJuicio
     * @return \Illuminate\Http\Response
     */
    public function show(TipoJuicio $tipoJuicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoJuicio  $tipoJuicio
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoJuicio $tipoJuicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoJuicio  $tipoJuicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tipo_juicio_id)
    {
        $this->validate($request, $this->rules);
        $tipoJuicio = TipoJuicio::find($tipo_juicio_id);
        $tipoJuicio->nombre_tipo_juicio = $request->nombre_tipo_juicio;
        $tipoJuicio->save();

        flash('El tipo jucio '.$tipoJuicio->nombre_tipo_juicio.' ha sido actualizado.')->info();

        return redirect('/admin/tipoJucios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoJuicio  $tipoJuicio
     * @return \Illuminate\Http\Response
     */
    public function destroy($tipo_juicio_id)
    {
        $tipoJuicio = TipoJuicio::find($tipo_juicio_id);
        $tipoJuicio->delete();

        flash('El tipo jucio '.$tipoJuicio->nombre_tipo_juicio.' ha sido eliminado.')->error();

        return redirect('/admin/tipoJucios');
    }
}
