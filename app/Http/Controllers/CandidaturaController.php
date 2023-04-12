<?php

namespace App\Http\Controllers;

use App\Models\Candidatura;
use App\Models\Posicion;
use Illuminate\Http\Request;

class CandidaturaController extends Controller
{
    protected $rules = [
        'nombre_candidatura'       => 'required|max:60',
        'posicion_id'              => 'required|numeric',
        'fecha_inicio_candidatura' => 'required',
        'fecha_fin_candidatura'    => 'required',
        'es_candidatura'           => 'required',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidaturas = Candidatura::all();
        return view('admin.candidatura.index')->with(['candidaturas' => $candidaturas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posiciones = Posicion::all();
        return view('admin.candidatura.create')->with(['posiciones' => $posiciones]);
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
        $candidatura                             = $request->all();
        $candidatura['fecha_inicio_candidatura'] = $request->fecha_inicio_candidatura;
        $candidatura['fecha_fin_candidatura']    = $request->fecha_fin_candidatura;
        $candidatura['candidatura_abierta']      = 1;

        Candidatura::create($candidatura);
        flash('La candidatura ' . $candidatura['nombre_candidatura'] . ' ha sido registrado.')->success();

        return redirect('/admin/candidaturas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidatura  $candidatura
     * @return \Illuminate\Http\Response
     */
    public function show(Candidatura $candidatura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidatura  $candidatura
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidatura $candidatura)
    {
        $posiciones = Posicion::all();
        return view('admin.candidatura.edit')->with(['candidatura' => $candidatura, 'posiciones' => $posiciones]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidatura  $candidatura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidatura $candidatura)
    {
        $this->validate($request, $this->rules);
        $this->validate(request(), [
            'candidatura_abierta' => 'required',

        ]);
        $candidatura->nombre_candidatura       = $request->nombre_candidatura;
        $candidatura->posicion_id              = $request->posicion_id;
        $candidatura->fecha_inicio_candidatura = $request->fecha_inicio_candidatura;
        $candidatura->fecha_fin_candidatura    = $request->fecha_fin_candidatura;
        $candidatura->es_candidatura           = $request->es_candidatura;
        $candidatura->candidatura_abierta      = $request->candidatura_abierta;
        $candidatura->save();

        flash('La candidatura ' . $candidatura->nombre_candidatura . ' ha sido actualizada.')->info();

        return redirect('/admin/candidaturas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidatura  $candidatura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidatura $candidatura)
    {
        $candidatura->delete();
        flash('La candidatura ' . $candidatura->nombre_candidatura . ' ha sido eliminada.')->error();

        return redirect('/admin/candidaturas');
    }
}
