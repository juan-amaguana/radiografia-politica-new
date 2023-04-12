<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Canton;
use App\Models\PartidoPolitico;
use App\Models\Persona;
use App\Models\Posicion;
use App\Models\Provincia;
use App\Models\Sector;
use App\Models\TipoActividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    protected $rules = [
        'persona_id'              => 'required|numeric',
        'tipo_actividad_id'       => 'required|numeric',
        'posicion_id'             => 'required|numeric',
        'nombre_fuente_actividad' => 'required',
        'link_fuente_actividad'   => 'required',
        'fecha_inicio_actividad'  => 'required',
        'posicion_actual'         => 'required',
        // 'descripcion_corta'       => 'required|max:190',

    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actividades = Actividad::all();
        return view('admin.actividad.index')->with(['actividades' => $actividades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personas           = Persona::all();
        $posiciones         = Posicion::all();
        $partidos_politicos = PartidoPolitico::all();
        $tipos_actividades  = TipoActividad::all();
        $provincias         = Provincia::all();
        $sectores           = Sector::all();

        return view('admin.actividad.create')->with(['sectores' => $sectores, 'provincias' => $provincias, 'personas' => $personas, 'posiciones' => $posiciones, 'partidos_politicos' => $partidos_politicos, 'tipos_actividades' => $tipos_actividades]);
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

        $actividad                           = $request->all();
        $actividad['fecha_inicio_actividad'] = $request->fecha_inicio_actividad;
        if ($request->posicion_actual == 1) {
            $actividad['fecha_fin_actividad'] = null;
        } else {
            $actividad['fecha_fin_actividad'] = $request->fecha_fin_actividad;
        }

        Actividad::create($actividad);
        $persona = Persona::find($actividad['persona_id']);
        flash('La actividad para la persona ' . $persona->nombres_persona . ' ' . $persona->apellidos_persona . ' ha sido registrado.')->success();

        return redirect('/admin/actividades');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function show($actividad_id)
    {
        $actividad = Actividad::find($actividad_id);
        return view('admin.actividad.show')->with(['actividad' => $actividad]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function edit($actividad_id)
    {
        $actividad          = Actividad::find($actividad_id);
        $personas           = Persona::all();
        $posiciones         = Posicion::all();
        $partidos_politicos = PartidoPolitico::all();
        $tipos_actividades  = TipoActividad::all();
        $provincias         = Provincia::all();
        $sectores           = Sector::all();
        return view('admin.actividad.edit')->with(['sectores' => $sectores, 'provincias' => $provincias, 'personas' => $personas, 'posiciones' => $posiciones, 'partidos_politicos' => $partidos_politicos, 'actividad' => $actividad, 'tipos_actividades' => $tipos_actividades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $actividad_id)
    {
        $this->validate($request, $this->rules);
        $actividad                          = Actividad::find($actividad_id);
        $actividad->persona_id              = $request->persona_id;
        $actividad->nombre_fuente_actividad = $request->nombre_fuente_actividad;
        $actividad->link_fuente_actividad   = $request->link_fuente_actividad;
        $actividad->fecha_inicio_actividad  = $request->fecha_inicio_actividad;
        if ($request->posicion_actual == 1) {
            $actividad->fecha_fin_actividad = null;
        } else {
            $actividad->fecha_fin_actividad = $request->fecha_fin_actividad;
        }

        $actividad->posicion_actual     = $request->posicion_actual;
        $actividad->posicion_id         = $request->posicion_id;
        $actividad->url_legislativo     = $request->url_legislativo;
        $actividad->tipo_actividad_id   = $request->tipo_actividad_id;
        $actividad->partido_politico_id = $request->partido_politico_id;
        $actividad->sector_id           = $request->sector_id;
        $actividad->provincia_id        = $request->provincia_id;
        $actividad->canton_id           = $request->canton_id;
        $actividad->parroquia_id        = $request->parroquia_id;
        //$actividad->importante = $request->importante;
        $actividad->descripcion_corta     = $request->descripcion_corta;
        $actividad->descripcion           = $request->descripcion;
        $actividad->es_encargo_puesto     = $request->es_encargo_puesto;
        $actividad->es_subrogacion_puesto = $request->es_subrogacion_puesto;
        $actividad->save();

        flash('La actividad politica' . $actividad->persona->nombres_persona . ' ' . $actividad->persona->apellidos_persona . ' ha sido Actualizado.')->info();
        return redirect('/admin/actividades');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy($actividad_id)
    {
        $actividad = Actividad::find($actividad_id);
        $actividad->delete();
        flash('La actividad ' . $actividad->nombre_actividad . ' ha sido eliminado.')->error();
        return redirect('/admin/actividades');
    }

    public function obtenerCantones($provincia_id)
    {
        return Provincia::obtenerCantones($provincia_id);
    }

    public function obtenerParroquias($canton_id)
    {
        return Canton::ObtenerParroquias($canton_id);
    }

}
