<?php

namespace App\Http\Controllers;

use App\Models\Administracion;
use App\Models\Candidatura;
use App\Models\Estado;
use App\Models\PartidoPolitico;
use App\Models\Perfil;
use App\Models\Persona;
use App\Models\Posicion;
use App\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use Storage;

class PersonaController extends Controller
{
    protected $rules = [
        'imagen_persona'     => 'required|mimes:jpeg,bmp,png',
        'nombres_persona'    => 'required|max:60',
        'apellidos_persona'  => 'required|max:60',
        'genero_persona'     => 'required|numeric',
        'plan_persona'       => 'mimes:pdf',
        'curriculum_persona' => 'mimes:pdf',
        'estado_id'          => 'required|numeric',

    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $personas = Persona::all();
        return view('main', ['data' => $personas]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function perfil($id)
    {

        $metadata = Administracion::metaDatosApi();
        $persona  = Persona::personaApi($id);
        $patidosAnteriores = null;
        if(isset($persona->partidos_politicos_anteriores) && !empty($persona->partidos_politicos_anteriores)){
            $ids = json_decode($persona->partidos_politicos_anteriores);
            $patidosAnteriores = PartidoPolitico::whereIn('id', $ids)->get();
        }

        //dd($persona);
        $sri_divisas = Persona::sri_divisas($id);

        $sri_renta       = Persona::sri_renta($id);
        $posicion_actual = Persona::posicionActual($id);
        //dd($posicion_actual);
        $estudios = Persona::personasEstudiosPersona($id);

        //dd($estudios);
        $actividad                              = Persona::personasActividadPublica($id);
        $actividad_privada                      = Persona::personasActividadPrivada($id);
        $actividad_politica                     = Persona::personasActividadPolitica($id);
        $actividades_organicacion_civil         = Persona::personasActividadOrganizacionSociedadCivil($id);
        $actividades_organicacion_internacional = Persona::personasActividadOrganismoInternacional($id);
        $concursos                              = Candidatura::candidaturasPostulaciones($id);
        //dd($concursos);
        $patrimonio = Persona::personasPatrimonioPersona($id);

        $compania_presidente = Persona::personasCompaniaPresidente($id);
        $compania_gerente    = Persona::personasCompaniaGerente($id);
        $compania_accionista = Persona::personasCompaniaAccionista($id);
        $personaCargo        = Persona::personaCargo($id);
        $actividades_persona = Persona::personaActividadesTodos($id);
        //dd($actividades_persona);
        $sri_divisas_detalle = Persona::sri_divisasDetalle($id);
        $sri_renta_detalle   = Persona::sri_rentaDetalle($id);
        //dd($sri_divisas_detalle);
        $personasCompania    = Persona::personasCompania($id);
        $personasCargoActual = Persona::personasCargoActual($id);

        if (isset($personaCargo[0])) {
            $personaCargo;
        } else {
            $personaCargo[0] = 0;

        }

        if ($metadata) {$meta = $metadata->toArray();}
        $perfil = Persona::personaPerfil($id);
        //dd($perfil);
        return view('perfil', [
            'id_perfil'                              => $id,
            'perfil'                                 => $perfil,
            'estudios'                               => $estudios->last(),
            'sri_divisas'                            => $sri_divisas,
            'sri_renta'                              => $sri_renta,
            'sri_divisas_detalle'                    => $sri_divisas_detalle,
            'sri_renta_detalle'                      => $sri_renta_detalle,
            'actividad_publica'                      => $actividad,
            'actividad_privada'                      => $actividad_privada,
            'actividad_politica'                     => $actividad_politica,
            'patrimonio'                             => $patrimonio->last(),
            'compania_presidente'                    => $compania_presidente,
            'compania_gerente'                       => $compania_gerente,
            'compania_accionista'                    => $compania_accionista,
            'personasCompania'                       => $personasCompania,
            'personasCargoActual'                    => $personasCargoActual,
            'persona'                                => $persona,
            'patidosAnteriores'                      => $patidosAnteriores,
            'posicion_actual'                        => $posicion_actual,
            'actividades_persona'                    => $actividades_persona,
            'actividades_organicacion_civil'         => $actividades_organicacion_civil,
            'actividades_organicacion_internacional' => $actividades_organicacion_internacional,

        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::all();
        //dd($personas);
        return view('admin.persona.index')->with(['personas' => $personas]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$users = User::all();
        $estados            = Estado::all();
        $partidos_politicos = PartidoPolitico::all();
        $perfiles           = Perfil::all();
        $posiciones         = Posicion::all();
        return view('admin.persona.create')->with(['estados' => $estados, 'partidos_politicos' => $partidos_politicos, 'perfiles' => $perfiles, 'posiciones' => $posiciones]);
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
        $persona                     = $request->all();
        $persona['user_id']          = Auth::user()->id;
        $persona['fecha_nacimiento'] = date('Y-m-d', strtotime($request->fecha_nacimiento));
        if ($request->hasFile('imagen_persona')) {
            $imagen_persona            = $this->storeImagePolitico($request);
            $persona['imagen_persona'] = $imagen_persona;
        }

        if ($request->hasFile('curriculum_persona')) {
            $curriculum_persona            = $this->storeArchivo($request, $request->curriculum_persona, 'archivosCurriculum');
            $persona['curriculum_persona'] = $curriculum_persona;
        }

        if ($request->hasFile('plan_persona')) {
            $plan_persona            = $this->storeArchivo($request, $request->plan_persona, 'archivosPlan');
            $persona['plan_persona'] = $plan_persona;
        }
        if (is_null($request->fecha_nacimiento)) {
            $persona['fecha_nacimiento'] = null;
        } else {
            $persona['fecha_nacimiento'] = $request->fecha_nacimiento;
        }

        if (isset($request->partidos_politicos_anteriores) && !empty($request->partidos_politicos_anteriores)) {
            $persona['partidos_politicos_anteriores'] = json_encode($request->partidos_politicos_anteriores);
        } else {
            $persona['partidos_politicos_anteriores'] = null;
        }
        
        Persona::create($persona);

        flash('la persona del ' . $persona['nombres_persona'] . ' ' . $persona['apellidos_persona'] . ' ha sido registrado.')->success();

        return redirect('/admin/personas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //dd($persona);
        return view('admin.persona.show')->with(['persona' => $persona]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        $users              = User::all();
        $estados            = Estado::all();
        $partidos_politicos = PartidoPolitico::all();
        $perfiles           = Perfil::all();
        $posiciones         = Posicion::all();
        return view('admin.persona.edit')->with(['persona' => $persona, 'users' => $users, 'estados' => $estados, 'partidos_politicos' => $partidos_politicos, 'perfiles' => $perfiles, 'posiciones' => $posiciones]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {

        $persona->nombres_persona   = $request->nombres_persona;
        $persona->apellidos_persona = $request->apellidos_persona;
        $persona->genero_persona    = $request->genero_persona;
        if (is_null($request->fecha_nacimiento)) {
            $persona->fecha_nacimiento = null;
        } else {
            $persona->fecha_nacimiento = date('Y-m-d', strtotime($request->fecha_nacimiento));
        }

        $persona->twitter_persona  = $request->twitter_persona;
        $persona->facebook_persona = $request->facebook_persona;
        //$persona->descripcion_corta_persona = $request->descripcion_corta_persona;
        //$persona->descripcion_persona = $request->descripcion_persona;
        $persona->estado_id           = $request->estado_id;
        $persona->partido_politico_id = $request->partido_politico_id;
        //$persona->observatorio_persona = $request->observatorio_persona;

        if ($request->hasFile('imagen_persona')) {
            $nombre_imagen_persona   = $this->updateImagenPolitico($persona, $request);
            $persona->imagen_persona = $nombre_imagen_persona;
        }

        if ($request->hasFile('curriculum_persona')) {
            $this->destroyArchivo($persona->curriculum_persona, 'archivosCurriculum');
            $nombre_curriculum_persona   = $this->storeArchivo($request, $request->curriculum_persona, 'archivosCurriculum');
            $persona->curriculum_persona = $nombre_curriculum_persona;
        }
        //dd($persona);
        if ($request->hasFile('plan_persona')) {
            $this->destroyArchivo($persona->plan_persona, 'archivosPlan');
            $nombre_plan_persona   = $this->storeArchivo($request, $request->plan_persona, 'archivosPlan');
            $persona->plan_persona = $nombre_plan_persona;
        }

        if (isset($request->partidos_politicos_anteriores) && !empty($request->partidos_politicos_anteriores)) {
            $persona['partidos_politicos_anteriores'] = json_encode($request->partidos_politicos_anteriores);
        } else {
            $persona['partidos_politicos_anteriores'] = null;
        }

        $persona->save();

        flash('la persona  ' . $persona->nombres_persona . ' ' . $persona->apellidos_persona . ' ha sido actualizado.')->info();

        return redirect('/admin/personas');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request_persona)
    {
        $persona = Persona::find($request_persona->persona_id);
        //dd($persona);
        $this->deleteImagenPolitico($persona);
        $this->destroyArchivo($persona->plan_persona, 'archivosPlan');
        $this->destroyArchivo($persona->curriculum_persona, 'archivosCurriculum');
        $persona->delete();

        flash('la persona ' . $persona->nombres_persona . ' ' . $persona->apellidos_persona . ' ha sido eliminado.')->error();

        return redirect('/admin/personas');
    }

    public function storeArchivo($request, $archivo_request, $storage)
    {

        $nombreArchivo = strtotime("now") . '_' . str_replace(" ", "_", $request->nombres_persona . $request->apellidos_persona) . '.' . $archivo_request->getClientOriginalExtension();

        Storage::disk($storage)->put($nombreArchivo, file_get_contents($archivo_request->getRealPath()));
        if ($storage == 'archivosCurriculum') {
            $nombre_hoja_vida = '/docs/curriculum/' . $nombreArchivo;
        } else {
            $nombre_hoja_vida = '/docs/plan/' . $nombreArchivo;
        }

        return $nombre_hoja_vida;
    }

    public function destroyArchivo($nombre_archivo, $storage)
    {
        $ruta_archivo     = explode("/", $nombre_archivo);
        $nombre_hoja_vida = end($ruta_archivo);
        //dd($ruta_archivo);
        Storage::disk($storage)->delete($nombre_hoja_vida);
    }

    public function storeImagePolitico($datos_persona)
    {
        $nombre_persona = $this->nombrePolitico($datos_persona);
        $imagen_persona = $datos_persona->file('imagen_persona');
        $nombre_imagen  = time() . '-' . $nombre_persona . '-detail' . '.' . $imagen_persona->getClientOriginalExtension();

        Image::make($imagen_persona)->resize(300, 225)->save(public_path('/img/perfiles/' . $nombre_imagen));

        $nombre_imagen_politico = '/img/perfiles/' . $nombre_imagen;

        return $nombre_imagen_politico;

    }

    public function updateImagenPolitico($datos_persona, $datos_persona_update)
    {
        $this->deleteImagenPolitico($datos_persona);
        $nombre_imagen_politico = $this->storeImagePolitico($datos_persona_update);
        return $nombre_imagen_politico;
    }

    public function deleteImagenPolitico($datos_persona)
    {
        File::delete(public_path($datos_persona->imagen_persona));
    }

    public function nombrePolitico($datos_persona)
    {
        $nombres_politico   = explode(" ", $datos_persona->nombres_persona);
        $apellidos_politico = explode(" ", $datos_persona->apellidos_persona);
        return $nombres_politico[0] . '-' . $apellidos_politico[0];
    }

    public function personasApi()
    {
        $api_radiografia_politica = array("metaDatos" => Administracion::metaDatosApi(), "datos" => Persona::personasApi());
        //return $api_radiografia_politica;
        return response($api_radiografia_politica)
            ->header('Access-Control-Allow-Origin', '*');
    }

    public function personaApi($persona_id)
    {
        $api_persona_radiografia_politica = array("metaDatos" => Administracion::metaDatosApi(), "datosPersona" => Persona::personaApi($persona_id));
        //return $api_persona_radiografia_politica;
        return response($api_persona_radiografia_politica)
            ->header('Access-Control-Allow-Origin', '*');
    }

    public function personaDetalleApi()
    {
        return Persona::personaDetalle();

    }

    public function mostVisited()
    {
        return Persona::mostVisited();

    }

    public function visitasPerfiles()
    {
        $personas_visitas = [];
        $visitas          = Persona::visitasPerfiles();
        foreach ($visitas as $visita) {
            $item_visita = ['nombre_persona' => $visita->nombres_persona . " " . $visita->apellidos_persona, 'imagen_persona' => $visita->imagen_persona, 'visitas' => $visita->visitas];
            array_push($personas_visitas, $item_visita);
        }
        return $personas_visitas;
    }

    public function generoPersonaFuncionEstado($funcion_estado)
    {
        return Persona::conteoGenero($funcion_estado);
    }

    public function generoPersonaFuncionEstadoTodos()
    {
        return Persona::conteoGeneroTodosFuncionEstado();
    }

    public function perfilActividades($perfil_id)
    {

        $actividad          = Persona::personasActividadPublica($perfil_id);
        $actividad_privada  = Persona::personasActividadPrivada($perfil_id);
        $actividad_politica = Persona::personasActividadPolitica($perfil_id);

        $data_actividades_perfil = array('cargos_en_el_sector_público' => $actividad, 'cargos_en_el_sector_privado' => $actividad_privada, 'actividad_política' => $actividad_politica);

        return $data_actividades_perfil;
    }

    public function detalleGeneroPersonaFuncionEstado($funcion_estado, $genero_persona)
    {
        return Persona::detallePersonasGenero($funcion_estado, $genero_persona);
    }

    public function detalleTodosGeneroPersonaFuncionEstado($genero_persona)
    {
        return Persona::detalleGeneroTodosFuncionEstado($genero_persona);
    }

}