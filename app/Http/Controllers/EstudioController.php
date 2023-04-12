<?php

namespace App\Http\Controllers;

use App\Models\Estudio;
use App\Models\EstudioArea;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstudioController extends Controller
{
    protected $rules = [
        'profesion_estudio' => 'required|max:100',
        'perfil_id'         => 'required|numeric',
        'pregrado_estudio'  => 'required|numeric',
        'posgrado_estudio'  => 'required|numeric',
        'phd_estudio'       => 'required|numeric',
        'estudio_area_id'   => 'required|numeric',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudios = Estudio::all();
        return view('admin.estudio.index')->with(['estudios' => $estudios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd('hola');
        $perfiles = Perfil::all();

        $estudio_areas = EstudioArea::all();
        return view('admin.estudio.create')->with(['perfiles' => $perfiles, 'estudio_areas' => $estudio_areas]);
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
        //dd($request);
        $estudio            = $request->all();
        $estudio['user_id'] = Auth::user()->id;

        $estudio_registro = Estudio::create($estudio);

        flash('los estudios de ' . $estudio_registro->perfil->persona->nombres_persona . ' ' . $estudio_registro->perfil->persona->apellidos_persona . ' ha sido registrado.')->success();

        return redirect('/admin/estudios');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estudio  $estudio
     * @return \Illuminate\Http\Response
     */
    public function show(Estudio $estudio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estudio  $estudio
     * @return \Illuminate\Http\Response
     */
    public function edit(Estudio $estudio)
    {
        $perfiles      = Perfil::all();
        $estudio_areas = EstudioArea::all();
        return view('admin.estudio.edit')->with(['perfiles' => $perfiles, 'estudio' => $estudio, 'estudio_areas' => $estudio_areas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estudio  $estudio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estudio $estudio)
    {
        $this->validate($request, $this->rules);
        $estudio->perfil_id         = $request->perfil_id;
        $estudio->profesion_estudio = $request->profesion_estudio;
        $estudio->estudio_area_id   = $request->estudio_area_id;
        $estudio->pregrado_estudio  = $request->pregrado_estudio;
        $estudio->posgrado_estudio  = $request->posgrado_estudio;
        $estudio->phd_estudio       = $request->phd_estudio;
        $estudio->contar_si         = $request->contar_si;
        $estudio->save();

        flash('los estudios de ' . $estudio->perfil->persona->nombres_persona . ' ' . $estudio->perfil->persona->apellidos_persona . ' ha sido actualizado.')->info();
        return redirect('/admin/estudios');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estudio  $estudio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudio $estudio)
    {
        $estudio->delete();

        flash('los estudios de ' . $estudio->perfil->persona->nombres_persona . ' ' . $estudio->perfil->persona->apellidos_persona . ' ha sido eliminado.')->error();

        return redirect('/admin/estudios');
    }

    public function obtenerProfesionales($funcion_estado)
    {

        return Estudio::obtenerProfesionales($funcion_estado);
    }

    public function obtenerProfesionalesTodos()
    {

        return Estudio::obtenerProfesionalesTodos();
    }

    public function obtenerProfesionalesPersona($profesion, $funtion_estado)
    {

        return Estudio::obtenerPersonasProfesionales($profesion, $funtion_estado);

    }

    public function obtenerProfesionalesPersonaTodos($profesion)
    {

        return Estudio::obtenerPersonasProfesionalesTodos($profesion);

    }

    public function formacionAcademica($function_estado)
    {

        $columnas_tabla_estudio = array("pregrado_estudio", "posgrado_estudio", "phd_estudio");
        $data_grafica           = array();
        for ($i = 0; $i < count($columnas_tabla_estudio); $i++) {

            $formacion_academica = Estudio::personasFormacionACademica($columnas_tabla_estudio[$i], $function_estado);

            $palabra_formacion_academica = explode("_", $columnas_tabla_estudio[$i]);
            $data                        = array();
            $data += ["formacion_academica" => ucwords($palabra_formacion_academica[0])];
            $data += ["personas" => $formacion_academica->personas];

            array_push($data_grafica, $data);

        }

        $personas_sin_titulo = Estudio::personasSinTitulos($function_estado);
        $data_sin_titulos    = array();
        $data_sin_titulos += ["formacion_academica" => "No registra títulos"];
        $data_sin_titulos += ["personas" => $personas_sin_titulo->personas];

        array_push($data_grafica, $data_sin_titulos);
        return $data_grafica;

    }

    public function formacionAcademicaTodos()
    {

        $columnas_tabla_estudio = array("pregrado_estudio", "posgrado_estudio", "phd_estudio");
        $data_grafica           = array();
        for ($i = 0; $i < count($columnas_tabla_estudio); $i++) {

            $formacion_academica = Estudio::personasFormacionACademicaTodos($columnas_tabla_estudio[$i]);

            $palabra_formacion_academica = explode("_", $columnas_tabla_estudio[$i]);
            $data                        = array();
            $data += ["formacion_academica" => ucwords($palabra_formacion_academica[0])];
            $data += ["personas" => $formacion_academica->personas];

            array_push($data_grafica, $data);

        }

        $personas_sin_titulo = Estudio::personasSinTitulosTodos();
        $data_sin_titulos    = array();
        $data_sin_titulos += ["formacion_academica" => "No registra títulos"];
        $data_sin_titulos += ["personas" => $personas_sin_titulo->personas];

        array_push($data_grafica, $data_sin_titulos);

        return $data_grafica;

    }

    public function obtenerProfesionalesArea($funcion_estado)
    {
        return Estudio::obtenerProfesionalesArea($funcion_estado);

    }

    public function obtenerProfesionalesAreaTodos()
    {
        return Estudio::obtenerProfesionalesAreaTodos();

    }

    public function obtenerPersonasProfesionalesArea($funcion_estado, $tipo_titulo)
    {
        if ($tipo_titulo != 'Sin título') {
            $columna_busqueda = strtolower($tipo_titulo) . '_estudio';
            return Estudio::detallePersonasFormacionACademica($columna_busqueda, $funcion_estado);
        } else {
            //dd('estoy sin titulo');
            return Estudio::detallePersonasSinTitulos($funcion_estado);
        }
    }

    public function obtenerDetalleProfesionalesAreaTodos($tipo_titulo)
    {
        if ($tipo_titulo != 'Sin título') {
            $columna_busqueda = strtolower($tipo_titulo) . '_estudio';
            return Estudio::detallePersonasFormacionACademicaTodos($columna_busqueda);
        } else {
            //dd('estoy sin titulo');
            return Estudio::detallePersonasSinTitulosTodos();
        }
    }

    public function obtenerDetalleProfesionalesArea($funcion_estado, $area_estudio)
    {
        return Estudio::obtenerDetalleProfesionalesArea($funcion_estado, $area_estudio);

    }

    public function getDetalleProfesionalesAreaTodos($area_estudio_id)
    {
        return Estudio::obtenerDetalleProfesionalesAreaTodos($area_estudio_id);
    }

}
