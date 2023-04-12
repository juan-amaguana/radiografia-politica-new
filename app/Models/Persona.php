<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    protected $table = 'personas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'imagen_persona',
        'nombres_persona',
        'apellidos_persona',
        'genero_persona',
        'fecha_nacimiento',
        'descripcion_corta_persona',
        'descripcion_persona',
        'plan_persona',
        'twitter_persona',
        'facebook_persona',
        'candidato_persona',
        'observatorio_persona',
        'curriculum_persona',
        'user_id',
        'estado_id',
        'partido_politico_id',
        'posicion_id',
        'provincia_id',
        'canton_id',
        'parroquia_id',
        'partidos_politicos_anteriores',
    ];

    protected $softCascade = ['perfil', 'actividad', 'postulanteCandidatura'];

    public function posicion()
    {
        return $this->belongsTo('App\Models\Posicion');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function perfil()
    {
        return $this->hasOne('App\Models\Perfil');
    }

    public function estado()
    {
        return $this->belongsTo('App\Models\Estado');
    }

    public function partidoPolitico()
    {
        return $this->belongsTo('App\Models\PartidoPolitico');
    }

    public function actividad()
    {
        return $this->hasMany('App\Models\Actividad');
    }

    public function postulanteCandidatura()
    {
        return $this->hasMany('App\Models\PostulanteCandidatura');
    }

    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincia');
    }

    public function canton()
    {
        return $this->belongsTo('App\Models\Canton');
    }

    public function parroquia()
    {
        return $this->belongsTo('App\Models\Parroquia');
    }

    public static function personasApi()
    {
        return Persona::with('actividad')
            ->with(['perfil' => function ($query) {
                $query->with('judicial')->with('sri')->with('compania')->with('estudio')->with('patrimonio');
            }])
            ->join('partidos_politicos', 'personas.partido_politico_id', '=', 'partidos_politicos.id')
            ->join('estados', 'personas.estado_id', '=', 'estados.id')
            ->where('personas.estado_id', 3)
            ->select('personas.*', 'partidos_politicos.nombre_partido_politico as pertenece_partido_politico', 'estados.nombre_estado as estado_persona')
            ->get();
    }

    public static function personaApi($persona_id)
    {
        return Persona::with('actividad')
            ->with(['perfil' => function ($query) {
                $query->with('judicial')->with('sri')->with('compania')->with('estudio')->with('patrimonio');
            }])
            ->leftjoin('partidos_politicos', 'personas.partido_politico_id', '=', 'partidos_politicos.id')
            ->join('estados', 'personas.estado_id', '=', 'estados.id')
            ->select('personas.*', 'partidos_politicos.nombre_partido_politico as pertenece_partido_politico', 'estados.nombre_estado as estado_persona', 'partidos_politicos.imagen_partido_politico as imagen_partido_politico')
            ->where('personas.id', $persona_id)
            ->first();
    }

    public static function personaPerfil($persona_id)
    {

        return Persona::join('perfiles', 'perfiles.persona_id', '=', 'personas.id')
            ->whereNotNull('perfiles.persona_id')
            ->where('personas.id', $persona_id)
            ->first();

    }

    public static function personaCargo($persona_id)
    {

        return Persona::join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->leftjoin('posiciones', 'posiciones.id', '=', 'actividades.posicion_id')
            ->where('personas.id', $persona_id)
            ->where('actividades.posicion_actual', 1)
            ->get();

    }

    public static function sri_divisas($persona_id)
    {

        return Persona::join('perfiles', 'perfiles.persona_id', '=', 'personas.id')
        // ->whereNotNull('perfiles.persona_id')
        // ->whereNotNull('personas.partido_politico_id')
            ->join('sris', 'sris.perfil_id', '=', 'perfiles.id')
            ->where('personas.id', $persona_id)
            ->where('sris.tipo_impuesto_sri', 1)
            ->select('sris.anio_sri', 'sris.valor_impuesto_sri', 'sris.declaracion')
            ->orderBy('sris.anio_sri', 'desc')
            ->first();
    }

    public static function sri_divisasDetalle($persona_id)
    {

        return Persona::join('perfiles', 'perfiles.persona_id', '=', 'personas.id')
        // ->whereNotNull('perfiles.persona_id')
        // ->whereNotNull('personas.partido_politico_id')
            ->join('sris', 'sris.perfil_id', '=', 'perfiles.id')
            ->where('personas.id', $persona_id)
            ->where('sris.tipo_impuesto_sri', 1)
            ->select('sris.anio_sri', 'sris.valor_impuesto_sri', 'sris.declaracion')
            ->orderBy('sris.anio_sri', 'desc')
            ->get();
    }

    public static function sri_renta($persona_id)
    {

        return Persona::join('perfiles', 'perfiles.persona_id', '=', 'personas.id')
        // ->whereNotNull('perfiles.persona_id')
        // ->whereNotNull('personas.partido_politico_id')
            ->join('sris', 'sris.perfil_id', '=', 'perfiles.id')
            ->where('personas.id', $persona_id)
            ->where('sris.tipo_impuesto_sri', 2)
            ->select('sris.anio_sri', 'sris.valor_impuesto_sri', 'perfiles.url_sri', 'perfiles.nombre_archivo_sri', 'sris.declaracion')
            ->orderBy('sris.anio_sri', 'desc')
            ->limit(1)
            ->first();
    }

    public static function sri_rentaDetalle($persona_id)
    {

        return Persona::join('perfiles', 'perfiles.persona_id', '=', 'personas.id')
        // ->whereNotNull('perfiles.persona_id')
        // ->whereNotNull('personas.partido_politico_id')
            ->join('sris', 'sris.perfil_id', '=', 'perfiles.id')
            ->where('personas.id', $persona_id)
            ->where('sris.tipo_impuesto_sri', 2)
            ->whereNull('sris.deleted_at')
            ->select('sris.anio_sri', 'sris.valor_impuesto_sri', 'sris.declaracion')
            ->orderBy('sris.anio_sri', 'desc')
            ->get();
    }

    public static function personaspartidosPoliticos()
    {
        return Persona::join('perfiles', 'perfiles.persona_id', '=', 'personas.id')
            ->whereNotNull('perfiles.persona_id')
            ->whereNotNull('personas.partido_politico_id')
            ->join('partidos_politicos', 'partidos_politicos.id', '=', 'personas.partido_politico_id')
            ->select('partidos_politicos.nombre_partido_politico', DB::raw('COUNT(personas.partido_politico_id) as personas'))
            ->groupBy('partidos_politicos.nombre_partido_politico')
            ->orderBy('personas', 'desc')
            ->limit(10)
            ->get();
    }

    public static function personasSexoPartidosPoliticos($partido_politico_id)
    {
        $personas_partido_politico = Persona::join('partidos_politicos', 'partidos_politicos.id', '=', 'personas.partido_politico_id')
            ->select('personas.genero_persona', 'partidos_politicos.id', 'partidos_politicos.nombre_partido_politico', DB::raw('COUNT(personas.partido_politico_id) as personas'))
            ->where('partidos_politicos.id', $partido_politico_id)
            ->groupBy('partidos_politicos.id', 'partidos_politicos.nombre_partido_politico', 'personas.genero_persona')
            ->get();

        return $personas_partido_politico;

    }

    public static function personasEstudiosPersona($persona_id)
    {
        return Persona::join('perfiles', 'perfiles.persona_id', '=', 'personas.id')
            ->whereNotNull('perfiles.persona_id')
            ->join('estudios', 'estudios.perfil_id', '=', 'perfiles.id')
            ->select('estudios.profesion_estudio', 'estudios.pregrado_estudio', 'estudios.posgrado_estudio', 'estudios.phd_estudio', 'perfiles.url_estudio', 'perfiles.nombre_archivo_estudio')
            ->where('personas.id', $persona_id)
            ->get();
    }

    public static function personasPatrimonioPersona($persona_id)
    {
        return Persona::join('perfiles', 'perfiles.persona_id', '=', 'personas.id')
            ->join('patrimonios', 'patrimonios.perfil_id', '=', 'perfiles.id')
            ->where('personas.id', $persona_id)
            ->get();
    }

    public static function personasCompaniaPresidente($persona_id)
    {
        return Persona::join('perfiles', 'perfiles.persona_id', '=', 'personas.id')
            ->join('companias', 'companias.perfil_id', '=', 'companias.id')
            ->where('companias.posicion_compania', 1)
            ->where('personas.id', $persona_id)
            ->get();
    }

    public static function personasCompaniaAccionista($persona_id)
    {
        return Persona::join('perfiles', 'perfiles.persona_id', '=', 'personas.id')
            ->join('companias', 'companias.perfil_id', '=', 'companias.id')
            ->where('companias.posicion_compania', 3)
            ->where('personas.id', $persona_id)
            ->get();
    }

    public static function personasCompania($persona_id)
    {
        return Compania::join('perfiles', 'perfiles.id', '=', 'companias.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->select('companias.id', 'perfiles.id', 'companias.nombre_compania', 'companias.posicion_compania', 'companias.estado')
            ->where('personas.id', $persona_id)
            ->orderBy("companias.posicion", "desc")
            ->get();
    }

    public static function personasCargoActual($persona_id)
    {
        return Persona::join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->where('persona_id', $persona_id)
            ->where('posicion_actual', 1)
            ->first();
    }

    //     select companias.id, perfiles.id , personas.id, companias.nombre_compania, companias.posicion_compania
    // from companias
    // INNER JOIN perfiles on perfiles.id = companias.perfil_id
    // INNER JOIN personas on personas.id = perfiles.persona_id
    // WHERE personas.id = 111

    public static function personasCompaniaGerente($persona_id)
    {
        return Persona::join('perfiles', 'perfiles.persona_id', '=', 'personas.id')
            ->join('companias', 'companias.perfil_id', '=', 'companias.id')
            ->where('companias.posicion_compania', 2)
            ->where('personas.id', $persona_id)
            ->get();
    }

    public static function mostVisited(){
        return Persona::join('partidos_politicos', 'partidos_politicos.id', '=', 'personas.partido_politico_id')
            ->join('perfiles', 'perfiles.persona_id', '=', 'personas.id')
            ->where('personas.estado_id', 3)
            ->whereNull('personas.deleted_at')
            ->whereNull('perfiles.deleted_at')
            ->orderByDesc('personas.visitas')
            ->limit(5)
            ->get();
    }

    public static function personaDetalle()
    {

        $exfuncionarios = Persona::leftJoin('partidos_politicos', 'partidos_politicos.id', '=', 'personas.partido_politico_id')
            ->leftJoin('perfiles', 'perfiles.persona_id', '=', 'personas.id')
            ->leftJoin('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->leftJoin('posiciones', 'actividades.posicion_id', '=', 'posiciones.id')
            ->leftJoin('categorias', 'categorias.id', '=', 'posiciones.categoria_id')
            ->leftJoin('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->select('categorias.nombre_categoria', 'personas.id', DB::raw("'n/a' as descripcion_cargo"), DB::raw("'n/a' as cargo"), 'posiciones.orden', 'perfiles.picture as picture', 'partidos_politicos.nombre_partido_politico as partido', 'personas.facebook_persona as facebook', 'personas.twitter_persona as twitter', 'personas.descripcion_corta_persona as description', 'personas.descripcion_persona as description_persona', 'personas.nombres_persona as name', 'personas.apellidos_persona as lastname', 'personas.imagen_persona as img', 'posiciones.funcion_estado_id', 'funcion_estado.nombre as funcion_estado', DB::raw("'exFuncionario' as estado_cargo"), DB::raw("'n/a' as institucion"),
                DB::raw("(CASE
                                        WHEN personas.id in (select  postulante_candidaturas.persona_id from postulante_candidaturas JOIN candidaturas ON candidaturas.id = postulante_candidaturas.candidatura_id WHERE candidaturas.es_candidatura = 1) THEN 3
                                        WHEN personas.id in (select postulante_candidaturas.persona_id from postulante_candidaturas JOIN candidaturas ON candidaturas.id = postulante_candidaturas.candidatura_id WHERE candidaturas.es_candidatura = 0) THEN 2 ELSE 999 END) AS es_candidato"))
            ->where('personas.estado_id', 3)
            ->whereNull('personas.deleted_at')
            ->whereNull('perfiles.deleted_at')
            ->whereNotIn('personas.id', function ($subquery) {
                $subquery->select('personas.id')
                    ->from('personas')
                    ->leftJoin('perfiles', 'perfiles.persona_id', '=', 'personas.id')
                    ->leftJoin('partidos_politicos', 'partidos_politicos.id', '=', 'personas.partido_politico_id')
                    ->leftJoin('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3);
            })
            ->distinct();
        //->get();
        //->toSql();

        //Candidatos
        /*$candidatos = Persona::leftJoin('partidos_politicos','partidos_politicos.id','=','personas.partido_politico_id')
        ->leftJoin('perfiles','perfiles.persona_id','=','personas.id')
        ->leftJoin('postulante_candidaturas', 'postulante_candidaturas.persona_id', '=', 'personas.id')
        ->leftJoin('candidaturas', 'candidaturas.id', '=', 'postulante_candidaturas.candidatura_id')
        ->leftJoin('posiciones','candidaturas.posicion_id','=','posiciones.id')
        ->leftJoin('categorias','categorias.id','=','posiciones.categoria_id')
        ->leftJoin('funcion_estado','funcion_estado.id','=','posiciones.funcion_estado_id')
        ->select('categorias.nombre_categoria','personas.id', DB::raw("'n/a' as descripcion_cargo"), DB::raw("'n/a' as cargo"), 'posiciones.orden', 'perfiles.picture as picture', 'partidos_politicos.nombre_partido_politico as partido', 'personas.facebook_persona as facebook', 'personas.twitter_persona as twitter', 'personas.descripcion_corta_persona as description', 'personas.descripcion_persona as description_persona', 'personas.nombres_persona as name', 'personas.apellidos_persona as lastname', 'personas.imagen_persona as img', 'posiciones.funcion_estado_id', 'funcion_estado.nombre as funcion_estado', DB::raw("'Candidato' as estado_cargo"),
        DB::raw("'n/a' as institucion"),
        DB::raw("3 as es_candidato"))
        ->where('personas.estado_id',3)
        ->where('candidaturas.es_candidatura',1)
        ->whereNotIn('postulante_candidaturas.persona_id', function($subquery){
        $subquery->select('actividades.persona_id')
        ->distinct()
        ->from('actividades');
        })
        ->distinct();
        $postulante = Persona::leftJoin('partidos_politicos','partidos_politicos.id','=','personas.partido_politico_id')
        ->leftJoin('perfiles','perfiles.persona_id','=','personas.id')
        ->leftJoin('postulante_candidaturas', 'postulante_candidaturas.persona_id', '=', 'personas.id')
        ->leftJoin('candidaturas', 'candidaturas.id', '=', 'postulante_candidaturas.candidatura_id')
        ->leftJoin('posiciones','candidaturas.posicion_id','=','posiciones.id')
        ->leftJoin('categorias','categorias.id','=','posiciones.categoria_id')
        ->leftJoin('funcion_estado','funcion_estado.id','=','posiciones.funcion_estado_id')
        ->select('categorias.nombre_categoria','personas.id', DB::raw("'n/a' as descripcion_cargo"), DB::raw("'n/a' as cargo"), 'posiciones.orden', 'perfiles.picture as picture', 'partidos_politicos.nombre_partido_politico as partido', 'personas.facebook_persona as facebook', 'personas.twitter_persona as twitter', 'personas.descripcion_corta_persona as description', 'personas.descripcion_persona as description_persona', 'personas.nombres_persona as name', 'personas.apellidos_persona as lastname', 'personas.imagen_persona as img', 'posiciones.funcion_estado_id', 'funcion_estado.nombre as funcion_estado', DB::raw("'Candidato' as estado_cargo"),
        DB::raw("'n/a' as institucion"),
        DB::raw("2 as es_candidato"))
        ->where('personas.estado_id',3)
        ->where('candidaturas.es_candidatura',0)
        ->whereNotIn('postulante_candidaturas.persona_id', function($subquery){
        $subquery->select('actividades.persona_id')
        ->distinct()
        ->from('actividades');
        })
        ->distinct();*/
        //->toSql();

        //Funcionarios
        $test = Persona::leftJoin('partidos_politicos', 'partidos_politicos.id', '=', 'personas.partido_politico_id')
            ->leftJoin('perfiles', 'perfiles.persona_id', '=', 'personas.id')
            ->leftJoin('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->leftJoin('posiciones', 'actividades.posicion_id', '=', 'posiciones.id')
            ->leftJoin('categorias', 'categorias.id', '=', 'posiciones.categoria_id')
            ->leftJoin('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->leftJoin('institucion', 'institucion.id', '=', 'posiciones.institucion_id')
            ->select('categorias.nombre_categoria', 'personas.id', 'personas.created_at', 'actividades.descripcion_corta as descripcion_cargo', 'posiciones.nombre_posicion as cargo', 'posiciones.orden', 'perfiles.picture as picture', 'partidos_politicos.nombre_partido_politico as partido', 'personas.facebook_persona as facebook', 'personas.twitter_persona as twitter', 'personas.descripcion_corta_persona as description', 'personas.descripcion_persona as description_persona', 'personas.nombres_persona as name', 'personas.apellidos_persona as lastname', 'personas.imagen_persona as img', 'posiciones.funcion_estado_id', 'funcion_estado.nombre as funcion_estado', DB::raw("'Funcionario' as estado_cargo"), 'institucion.nombre as institucion',
                DB::raw("(CASE
                                    WHEN personas.id in (select  postulante_candidaturas.persona_id from postulante_candidaturas JOIN candidaturas ON candidaturas.id = postulante_candidaturas.candidatura_id WHERE candidaturas.es_candidatura = 1) THEN 3
                                    WHEN personas.id in (select  postulante_candidaturas.persona_id from postulante_candidaturas JOIN candidaturas ON candidaturas.id = postulante_candidaturas.candidatura_id WHERE candidaturas.es_candidatura = 0) THEN 2
                                    ELSE 999 END) AS es_candidato"))
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->whereNull('personas.deleted_at')
            ->whereNull('perfiles.deleted_at')
            ->distinct();
            //->union($exfuncionarios)
        //->union($candidatos)
        //->union($postulante)
        //->union($candidatos)
            //->get();
        //->toSql();
        return $test->orderBy('personas.created_at', 'DESC')->get();

    }

    public static function personasActividadPublica($persona_id)
    {
        return Actividad::join('personas', 'personas.id', '=', 'actividades.persona_id')
            ->leftjoin('posiciones', 'posiciones.id', '=', 'actividades.posicion_id')
            ->select('actividades.id', 'actividades.nombre_fuente_actividad', 'actividades.descripcion_corta', 'actividades.descripcion', 'posiciones.nombre_posicion', 'actividades.link_fuente_actividad',
                DB::raw('YEAR(actividades.fecha_inicio_actividad) as anio_inicio'),
                DB::raw('YEAR(actividades.fecha_fin_actividad) as anio_fin'))
        //->whereNotNull('actividades.posicion_actual')
            ->where('actividades.tipo_actividad_id', 1)
            ->where('personas.id', $persona_id)
            ->orderBy('anio_inicio', 'DESC')
            ->get();
    }

    public static function personasActividadPrivada($persona_id)
    {
        return Actividad::join('personas', 'personas.id', '=', 'actividades.persona_id')
            ->leftjoin('posiciones', 'posiciones.id', '=', 'actividades.posicion_id')
            ->select('actividades.id', 'actividades.nombre_fuente_actividad', 'actividades.descripcion_corta', 'actividades.descripcion', 'posiciones.nombre_posicion', 'actividades.link_fuente_actividad',
                DB::raw('YEAR(actividades.fecha_inicio_actividad) as anio_inicio'),
                DB::raw('YEAR(actividades.fecha_fin_actividad) as anio_fin'))
        //->whereNotNull('actividades.posicion_actual')
            ->where('actividades.tipo_actividad_id', 2)
            ->where('personas.id', $persona_id)
            ->orderBy('anio_inicio', 'DESC')
            ->get();
    }

    public static function personasActividadPolitica($persona_id)
    {
        return Actividad::join('personas', 'personas.id', '=', 'actividades.persona_id')
            ->leftjoin('posiciones', 'posiciones.id', '=', 'actividades.posicion_id')
            ->select('actividades.id', 'actividades.nombre_fuente_actividad', 'actividades.descripcion_corta', 'actividades.descripcion', 'posiciones.nombre_posicion', 'actividades.link_fuente_actividad',
                DB::raw('YEAR(actividades.fecha_inicio_actividad) as anio_inicio'),
                DB::raw('YEAR(actividades.fecha_fin_actividad) as anio_fin'))
        //->whereNotNull('actividades.posicion_actual')
            ->where('actividades.tipo_actividad_id', 3)
            ->where('personas.id', $persona_id)
            ->orderBy('anio_inicio', 'DESC')
            ->get();
    }

    public static function personasActividadOrganizacionSociedadCivil($persona_id)
    {
        return Actividad::join('personas', 'personas.id', '=', 'actividades.persona_id')
            ->leftjoin('posiciones', 'posiciones.id', '=', 'actividades.posicion_id')
            ->select('actividades.id', 'actividades.nombre_fuente_actividad', 'actividades.descripcion_corta', 'actividades.descripcion', 'posiciones.nombre_posicion', 'actividades.link_fuente_actividad',
                DB::raw('YEAR(actividades.fecha_inicio_actividad) as anio_inicio'),
                DB::raw('YEAR(actividades.fecha_fin_actividad) as anio_fin'))
        //->whereNotNull('actividades.posicion_actual')
            ->where('actividades.tipo_actividad_id', 4)
            ->where('personas.id', $persona_id)
            ->orderBy('anio_inicio', 'DESC')
            ->get();
    }

    public static function personasActividadOrganismoInternacional($persona_id)
    {
        return Actividad::join('personas', 'personas.id', '=', 'actividades.persona_id')
            ->leftjoin('posiciones', 'posiciones.id', '=', 'actividades.posicion_id')
            ->select('actividades.id', 'actividades.nombre_fuente_actividad', 'actividades.descripcion_corta', 'actividades.descripcion', 'posiciones.nombre_posicion', 'actividades.link_fuente_actividad',
                DB::raw('YEAR(actividades.fecha_inicio_actividad) as anio_inicio'),
                DB::raw('YEAR(actividades.fecha_fin_actividad) as anio_fin'))
        //->whereNotNull('actividades.posicion_actual')
            ->where('actividades.tipo_actividad_id', 5)
            ->where('personas.id', $persona_id)
            ->orderBy('anio_inicio', 'DESC')
            ->get();
    }

    public static function personaActividadesTodos($persona_id)
    {
        return Actividad::join('personas', 'personas.id', '=', 'actividades.persona_id')
            ->leftjoin('posiciones', 'posiciones.id', '=', 'actividades.posicion_id')
            ->select('actividades.id', 'actividades.nombre_fuente_actividad', 'actividades.descripcion_corta', 'actividades.descripcion', 'posiciones.nombre_posicion', 'actividades.link_fuente_actividad',
                DB::raw('YEAR(actividades.fecha_inicio_actividad) as anio_inicio'),
                DB::raw('YEAR(actividades.fecha_fin_actividad) as anio_fin'))
        //->whereNotNull('actividades.posicion_actual')
            ->where('personas.id', $persona_id)
            ->orderBy('anio_inicio', 'DESC')
            ->get();
    }

    public static function cargosPosiciones()
    {
        return Actividad::join('personas', 'personas.id', '=', 'actividades.persona_id')
            ->leftjoin('posiciones', 'posiciones.id', '=', 'actividades.posicion_id')
            ->leftjoin('categorias_posiciones', 'categorias_posiciones.posiciones_id', '=', 'posiciones.id')
            ->leftjoin('categorias', 'categorias.id', '=', 'categorias_posiciones.categorias_id')
            ->select('posiciones.nombre_posicion',
                DB::raw('COUNT(posiciones.id) as cargos_posiciones')
            )
        //->whereNotNull('actividades.posicion_actual')
            ->where('actividades.posicion_actual', 1)
            ->groupBy('posiciones.nombre_posicion')
            ->get();

    }

    public static function personasPosiciones($Posicion_nombre)
    {

        //$Posicion_id = 3;

        return Actividad::join('personas', 'personas.id', '=', 'actividades.persona_id')
            ->leftjoin('posiciones', 'posiciones.id', '=', 'actividades.posicion_id')
            ->leftjoin('categorias_posiciones', 'categorias_posiciones.posiciones_id', '=', 'posiciones.id')
            ->leftjoin('categorias', 'categorias.id', '=', 'categorias_posiciones.categorias_id')
            ->select('personas.id', 'personas.nombres_persona', 'personas.apellidos_persona')
            ->where('posiciones.nombre_posicion', $Posicion_nombre)
            ->get();

    }

    public static function visitasPerfiles()
    {
        return Persona::select('imagen_persona', 'nombres_persona', 'apellidos_persona', 'visitas')
            ->orderBy('visitas', 'desc')
            ->limit(8)
            ->get();
    }

    public static function conteoGenero($funcion_estado)
    {
        return Persona::join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', '=', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('funcion_estado.id', $funcion_estado)
            ->whereNotNull('personas.genero_persona')
            ->select('funcion_estado.nombre as funcion_estado', 'personas.genero_persona', DB::raw("count(personas.genero_persona) as cantidad_genero"))
            ->groupBy('funcion_estado', 'personas.genero_persona')
            ->get();
    }

    public static function detallePersonasGenero($funcion_estado, $genero_persona)
    {
        return Persona::join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', '=', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('funcion_estado.id', $funcion_estado)
            ->where('personas.genero_persona', $genero_persona)
            ->select('personas.nombres_persona', 'personas.apellidos_persona', 'posiciones.nombre_posicion')
            ->get();
    }

    public static function conteoGeneroTodosFuncionEstado()
    {
        return Persona::join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', '=', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->whereNotNull('personas.genero_persona')
            ->select('personas.genero_persona', DB::raw("count(personas.genero_persona) as cantidad_genero"))
            ->groupBy('personas.genero_persona')
            ->get();
    }

    public static function detalleGeneroTodosFuncionEstado($genero_persona)
    {
        return Persona::join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', '=', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->whereNotNull('personas.genero_persona')
            ->where('personas.genero_persona', $genero_persona)
            ->select('personas.nombres_persona', 'personas.apellidos_persona', 'posiciones.nombre_posicion')
            ->get();
    }

    /*API*/

    public static function apiGenero()
    {
        return Persona::join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', '=', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->whereNotNull('personas.genero_persona')
            ->select('personas.id as persona_id', 'personas.*', 'posiciones.nombre_posicion as cargo', 'funcion_estado.nombre as funcion', 'funcion_estado.categoria')
            ->orderBy('funcion_estado.categoria')
            ->get();
    }

    public static function posicionActual($persona_id)
    {
        return Persona::join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', '=', 'posiciones.id')
            ->where('personas.id', $persona_id)
            ->where('actividades.posicion_actual', 1)
            ->select('posiciones.nombre_posicion', 'posiciones.id as posicion_id', 'actividades.link_fuente_actividad', 'actividades.url_legislativo')
            ->first();
    }

}