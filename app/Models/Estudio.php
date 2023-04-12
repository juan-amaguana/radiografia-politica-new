<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estudio extends Model
{
    use SoftDeletes;
    protected $table = 'estudios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profesion_estudio',
        'pregrado_estudio',
        'posgrado_estudio',
        'phd_estudio',
        'estudio_area_id',
        'perfil_id',
        'user_id',
        'contar_si'

    ];

    public function perfil()
    {
        return $this->belongsTo('App\Models\Perfil');
    }

    public function estudioArea()
    {
        return $this->belongsTo('App\Models\EstudioArea');
    }

    public static function conteoProfecionales($orden)
    {
        return DB::select("select count(estudios.profesion_estudio) as total, estudios.profesion_estudio,
            COUNT(NULLIF(estudios.phd_estudio,0)) as phd, COUNT(NULLIF(estudios.posgrado_estudio,0)) as posgrado
            from estudios
            inner join perfiles on estudios.perfil_id = perfiles.id
            inner join personas on personas.id = perfiles.persona_id
            where profesion_estudio is not null and
            profesion_estudio <> '' and
            personas.estado_id = 3
            group by estudios.profesion_estudio
            order by total " . $orden . "
            LIMIT 34");
    }

    public static function personasProfecion($profesion)
    {
        return DB::select("select personas.nombres_persona, personas.apellidos_persona, estudios.phd_estudio, estudios.posgrado_estudio, estudios.pregrado_estudio
            from estudios
            inner join perfiles on estudios.perfil_id = perfiles.id
            inner join personas on personas.id = perfiles.persona_id
            where estudios.profesion_estudio is not null and
            estudios.profesion_estudio <> '' and
            personas.estado_id = 3 and
            estudios.profesion_estudio = '$profesion'
            order by personas.nombres_persona, personas.apellidos_persona");
    }

    public static function personasFormacionACademica($columna, $function_estado)
    {

        return Estudio::join('perfiles', 'perfiles.id', '=', 'estudios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('funcion_estado.id', $function_estado)
            ->where('estudios.contar_si','=' , $columna)
            ->where('estudios.' . $columna, '>', 0)
            ->select(DB::raw("COUNT(personas.id) as personas"))
            ->first();
    }

    public static function detallePersonasFormacionACademica($columna, $function_estado)
    {

        return Estudio::join('perfiles', 'perfiles.id', '=', 'estudios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('funcion_estado.id', $function_estado)
            ->where('estudios.contar_si','=' , $columna)
            ->where('estudios.' . $columna, '>', 0)
            ->select('personas.nombres_persona', 'personas.apellidos_persona', 'estudios.profesion_estudio')
            ->get();
    }

    public static function personasFormacionACademicaTodos($columna)
    {

        return Estudio::join('perfiles', 'perfiles.id', '=', 'estudios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('estudios.' . $columna, '>', 0)
            ->select(DB::raw("COUNT(personas.id) as personas"))
            ->first();
    }

    public static function detallePersonasFormacionACademicaTodos($columna)
    {

        return Estudio::join('perfiles', 'perfiles.id', '=', 'estudios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('estudios.' . $columna, '>', 0)
            ->select('personas.nombres_persona', 'personas.apellidos_persona', 'estudios.profesion_estudio')
            ->get();
    }

    public static function personasSinTitulos($funtion_estado)
    {

        return Estudio::join('perfiles', 'perfiles.id', '=', 'estudios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('funcion_estado.id', $funtion_estado)
            ->where('estudios.pregrado_estudio', 0)
            ->where('estudios.posgrado_estudio', 0)
            ->where('estudios.phd_estudio', 0)
            ->select(DB::raw("COUNT(personas.id) as personas"))
            ->first();
    }

    public static function detallePersonasSinTitulos($funtion_estado)
    {

        return Estudio::join('perfiles', 'perfiles.id', '=', 'estudios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('funcion_estado.id', $funtion_estado)
            ->where('estudios.pregrado_estudio', 0)
            ->where('estudios.posgrado_estudio', 0)
            ->where('estudios.phd_estudio', 0)
            ->select('personas.nombres_persona', 'personas.apellidos_persona', 'estudios.profesion_estudio')
            ->get();
    }

    public static function personasSinTitulosTodos()
    {

        return Estudio::join('perfiles', 'perfiles.id', '=', 'estudios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('estudios.pregrado_estudio', 0)
            ->where('estudios.posgrado_estudio', 0)
            ->where('estudios.phd_estudio', 0)
            ->select(DB::raw("COUNT(personas.id) as personas"))
            ->first();
    }

    public static function detallePersonasSinTitulosTodos()
    {

        return Estudio::join('perfiles', 'perfiles.id', '=', 'estudios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('estudios.pregrado_estudio', 0)
            ->where('estudios.posgrado_estudio', 0)
            ->where('estudios.phd_estudio', 0)
            ->select('personas.nombres_persona', 'personas.apellidos_persona', 'estudios.profesion_estudio')
            ->get();
    }

    public static function obtenerProfesionales($funtion_estado)
    {
        return Estudio::join('perfiles', 'perfiles.id', '=', 'estudios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('funcion_estado.id', $funtion_estado)
            ->where('personas.estado_id', 3)
            ->where('estudios.profesion_estudio', '!=', '')
            ->select('estudios.profesion_estudio', DB::raw("COUNT(personas.id) as total"))
            ->groupBy('estudios.profesion_estudio')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();
    }

    public static function obtenerProfesionalesTodos()
    {
        return Estudio::join('perfiles', 'perfiles.id', '=', 'estudios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('estudios.profesion_estudio', '!=', '')
            ->select('estudios.profesion_estudio', DB::raw("COUNT(personas.id) as total"))
            ->groupBy('estudios.profesion_estudio')
            ->orderBy('total', 'desc')
            ->get();
    }

    public static function obtenerPersonasProfesionales($profesion, $funcion_estado)
    {
        return Estudio::join('perfiles', 'perfiles.id', '=', 'estudios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('funcion_estado.id', $funcion_estado)
            ->where('personas.estado_id', 3)
            ->where('estudios.profesion_estudio', $profesion)
            ->select('personas.nombres_persona', 'personas.apellidos_persona')
            ->get();
    }

    public static function obtenerPersonasProfesionalesTodos($profesion)
    {
        return Estudio::join('perfiles', 'perfiles.id', '=', 'estudios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('estudios.profesion_estudio', $profesion)
            ->select('personas.nombres_persona', 'personas.apellidos_persona', 'posiciones.nombre_posicion', 'funcion_estado.categoria', 'funcion_estado.nombre')
            ->get();
    }

    public static function obtenerProfesionalesArea($funtion_estado)
    {
        return Estudio::join('estudio_areas', 'estudio_areas.id', '=', 'estudios.estudio_area_id')
            ->join('perfiles', 'perfiles.id', '=', 'estudios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('funcion_estado.id', $funtion_estado)
            ->where('personas.estado_id', 3)
            ->select('estudio_areas.id as area_id', 'estudio_areas.nombre_estudio_area as estudio_area', DB::raw("COUNT(personas.id) as numero_profesionales"))
            ->groupBy('area_id', 'estudio_area')
            ->orderBy('numero_profesionales', 'desc')
            ->get();
    }

    public static function obtenerDetalleProfesionalesArea($funtion_estado, $area_estudio_id)
    {

        return Estudio::join('estudio_areas', 'estudio_areas.id', '=', 'estudios.estudio_area_id')
            ->join('perfiles', 'perfiles.id', '=', 'estudios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('funcion_estado.id', $funtion_estado)
            ->where('estudio_areas.id', $area_estudio_id)
            ->select('personas.nombres_persona', 'personas.apellidos_persona', 'estudios.profesion_estudio')
            ->get();


    }

    public static function obtenerProfesionalesAreaTodos()
    {
        return Estudio::join('estudio_areas', 'estudio_areas.id', '=', 'estudios.estudio_area_id')
            ->join('perfiles', 'perfiles.id', '=', 'estudios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->select('estudio_areas.id as area_id', 'estudio_areas.nombre_estudio_area as estudio_area', DB::raw("COUNT(personas.id) as numero_profesionales"))
            ->groupBy('area_id', 'estudio_area')
            ->orderBy('numero_profesionales', 'desc')
            ->get();
    }

    public static function obtenerDetalleProfesionalesAreaTodos($area_estudio_id)
    {
        return Estudio::join('estudio_areas', 'estudio_areas.id', '=', 'estudios.estudio_area_id')
            ->join('perfiles', 'perfiles.id', '=', 'estudios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('estudio_areas.id', $area_estudio_id)
            ->select('personas.nombres_persona', 'personas.apellidos_persona', 'estudios.profesion_estudio')
            ->get();
    }

    public static function apiEstudios()
    {
        return Estudio::leftjoin('estudio_areas', 'estudio_areas.id', '=', 'estudios.estudio_area_id')
            ->join('perfiles', 'perfiles.id', '=', 'estudios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->select('personas.id as persona_id', 'personas.nombres_persona', 'personas.apellidos_persona', 'estudio_areas.nombre_estudio_area as estudio_area', 'estudios.profesion_estudio', 'estudios.pregrado_estudio as titulos_pegrado', 'estudios.posgrado_estudio as titulos_posgrado', 'estudios.phd_estudio as titulos_phd', 'posiciones.nombre_posicion as cargo', 'funcion_estado.nombre as funcion', 'funcion_estado.categoria')
            ->orderBy('funcion_estado.categoria')
            ->get();
    }

}
