<?php

namespace App\Http\Controllers;

use App\Models\PostulanteCandidatura;
use App\Models\Candidatura;
use App\Models\Posicion;
use App\Models\Persona;
use App\Models\PartidoPolitico;
use Illuminate\Http\Request;

class PostulanteCandidaturaController extends Controller
{
    protected $rules = [
        'candidatura_id' => 'required|numeric',
        'persona_id' => 'required|numeric',
        // 'descripcion' => 'required',
        'nombre_fuente_actividad' => 'required',
        'link_fuente_actividad' => 'required',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postulantes = PostulanteCandidatura::all();
        return view('admin.postulanteCandidatura.index')->with(['postulantes'=>$postulantes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $candidaturas = Candidatura::all();
        $posiciones = Posicion::all();
        $personas = Persona::all();
        $partidos_politicos = PartidoPolitico::all();

        return view('admin.postulanteCandidatura.create')->with(['candidaturas'=>$candidaturas,'posiciones'=>$posiciones,'personas'=>$personas,'partidos_politicos'=>$partidos_politicos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);

        $this->validate($request, $this->rules);
        $postulante = $request->all();
        PostulanteCandidatura::create($postulante);
        $persona = Persona::find($request->persona_id);
        $posicion = Posicion::find($request->posicion_id);
        $candidatura = Candidatura::find($request->candidatura_id);
        flash('La postulacion de '.$persona->nombres_persona.' '.$persona->apellidos_persona.' para la candidatura '.$candidatura->nombre_candidatura.' ha sido registrado.')->success();

        return redirect('/admin/postulantesCandidaturas');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostulanteCandidatura  $postulanteCandidatura
     * @return \Illuminate\Http\Response
     */
    public function show($postulanteCandidatura_id)
    {
        $postulanteCandidatura = PostulanteCandidatura::find($postulanteCandidatura_id);
        return view('admin.postulanteCandidatura.show')->with(['postulanteCandidatura'=>$postulanteCandidatura]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostulanteCandidatura  $postulanteCandidatura
     * @return \Illuminate\Http\Response
     */
    public function edit($postulanteCandidatura_id)
    {
        $postulanteCandidatura = PostulanteCandidatura::find($postulanteCandidatura_id);
        $candidaturas = Candidatura::all();
        $posiciones = Posicion::all();
        $personas = Persona::all();
        $partidos_politicos = PartidoPolitico::all();

        return view('admin.postulanteCandidatura.edit')->with(['candidaturas'=>$candidaturas,'posiciones'=>$posiciones,'personas'=>$personas,'partidos_politicos'=>$partidos_politicos,'postulanteCandidatura'=>$postulanteCandidatura]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostulanteCandidatura  $postulanteCandidatura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $postulanteCandidatura_id)
    {


        $this->validate($request, $this->rules);

        $postulanteCandidatura = PostulanteCandidatura::find($postulanteCandidatura_id);
        $postulanteCandidatura->candidatura_id = $request->candidatura_id;
        $postulanteCandidatura->persona_id = $request->persona_id;
        //$postulanteCandidatura->partido_politico_id = $request->partido_politico_id;
        $postulanteCandidatura->gano_candidatura = $request->gano_candidatura;
        //$postulanteCandidatura->retirado = $request->retirado;
        $postulanteCandidatura->nombre_fuente_actividad = $request->nombre_fuente_actividad;
        $postulanteCandidatura->link_fuente_actividad = $request->link_fuente_actividad;
        $postulanteCandidatura->descripcion = $request->descripcion;
        $postulanteCandidatura->save();

        flash('La postulacion de '.$postulanteCandidatura->persona->nombres_persona.' '.$postulanteCandidatura->persona->apellidos_persona.' para la posición '.$postulanteCandidatura->candidatura->nombre_candidatura.' ha sido actualizada.')->info();

        return redirect('/admin/postulantesCandidaturas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostulanteCandidatura  $postulanteCandidatura
     * @return \Illuminate\Http\Response
     */
    public function destroy($postulanteCandidatura_id)
    {
        $postulanteCandidatura = PostulanteCandidatura::find($postulanteCandidatura_id);
        $postulanteCandidatura->delete();
        flash('La postulacion de '.$postulanteCandidatura->persona->nombres_persona.' '.$postulanteCandidatura->persona->apellidos_persona.' para la posición '.$postulanteCandidatura->posicion->nombre_posicion.' ha sido eliminada.')->error();

        return redirect('/admin/postulantesCandidaturas');
    }
}
