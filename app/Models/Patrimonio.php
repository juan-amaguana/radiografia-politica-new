<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patrimonio extends Model
{
    use SoftDeletes;

    protected $table = 'patrimonios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_archivo_patrimonio1',
        'nombre_archivo_patrimonio2',
        'numero_casas',
        'numero_carros',
        'dinero',
        'numero_companias',
        'fecha_declaracion',
        'fecha_declaracion_anterior',
        'activos',
        'pasivos',
        'patrimonio',
        'publicar',
        'perfil_id',
        'user_id',
    ];

    public function perfil()
    {
        return $this->belongsTo('App\Models\Perfil');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function obtenerPatrimonioAnio($anio)
    {
        return DB::select("select personas.nombres_persona, personas.apellidos_persona, personas.id, patrimonios.fecha_declaracion, patrimonios.activos, patrimonios.pasivos,
            patrimonios.patrimonio, patrimonios.numero_carros, patrimonios.numero_casas, patrimonios.numero_companias,
            patrimonios.nombre_archivo_patrimonio1, patrimonios.nombre_archivo_patrimonio2
            from personas
            inner join perfiles on personas.id = perfiles.persona_id
            inner join patrimonios on perfiles.id = patrimonios.perfil_id
            where personas.estado_id = 3 and
            year(patrimonios.fecha_declaracion) = '$anio'
            order by patrimonios.patrimonio desc
            LIMIT 6");
    }

    public static function obtenerUltimoAnioRegistros()
    {
        $registro_ultimo = Patrimonio::orderBy('fecha_declaracion', 'desc')->get()->first();

        return $registro_ultimo->fecha_declaracion;
    }

    public static function patrimonioFuncionEstado($function_estado)
    {
        //$date = \Carbon\Carbon::now();
        //$anio_actual = intval($date->format('Y'))-1;
        $date = Patrimonio::obtenerUltimoAnioRegistros();
        $anio_actual = date('Y', strtotime($date));
        //dd($anio_actual);
        return Patrimonio::join('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('funcion_estado.id', $function_estado)
            ->where('patrimonios.publicar', 'SI')
            //->whereYear('patrimonios.fecha_declaracion', $anio_actual)
            ->select('patrimonios.patrimonio', 'personas.nombres_persona', 'personas.apellidos_persona', 'perfiles.id as perfil_id', 'perfiles.picture as imagen_persona')
            ->orderBy('patrimonios.patrimonio', 'DESC')
            ->orderBy('patrimonios.fecha_declaracion', 'ASC')
            ->take(5)
            ->get();
    }

    public static function patrimonioFuncionEstadoTodos()
    {
        //$date = \Carbon\Carbon::now();
        //$anio_actual = intval($date->format('Y'))-1;
        $date = Patrimonio::obtenerUltimoAnioRegistros();
        $anio_actual = date('Y', strtotime($date));
        return Patrimonio::join('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('patrimonios.publicar', 'SI')
            //->whereYear('patrimonios.fecha_declaracion', $anio_actual)
            ->select('patrimonios.patrimonio', 'personas.nombres_persona', 'personas.apellidos_persona', 'perfiles.id as perfil_id', 'perfiles.picture as imagen_persona')
            ->orderBy('patrimonios.patrimonio', 'DESC')
            ->distinct()
            ->take(5)
            ->get();
    }

    public static function patrimonioRangoFuncionEstado($function_estado, $rango)
    {
        //$date = \Carbon\Carbon::now();
        //$anio_actual = intval($date->format('Y'))-1;
        $date = Patrimonio::obtenerUltimoAnioRegistros();
        $anio_actual = date('Y', strtotime($date));
        $rangos = (is_array($rango)) ? $rango : explode("-", $rango);

        if (count($rangos) > 1) {
            $data_patrimonio = Patrimonio::join('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
                ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                ->where('actividades.posicion_actual', 1)
                ->where('personas.estado_id', 3)
                ->where('funcion_estado.id', $function_estado)
                //->whereYear('patrimonios.fecha_declaracion', $anio_actual)
                ->where('patrimonios.publicar', 'SI')
                ->whereBetween('patrimonios.patrimonio', [$rangos[0], $rangos[1]])
                ->select(DB::raw("COUNT(personas.id) as total_persona"))
                ->first();
        }

        if (count($rangos) == 1) {
            if ($rangos[0] == 1000001) {
                $data_patrimonio = Patrimonio::join('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
                    ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('funcion_estado.id', $function_estado)
                    // ->whereYear('patrimonios.fecha_declaracion', $anio_actual)
                    ->where('patrimonios.publicar', 'SI')
                    ->where('patrimonios.patrimonio', '>', $rangos[0])
                    ->select(DB::raw("COUNT(personas.id) as total_persona"))
                    ->first();
            }

            if ($rangos[0] == 0) {
                $data_patrimonio = Patrimonio::join('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
                    ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('funcion_estado.id', $function_estado)
                    ->where('patrimonios.publicar', 'SI')
                    // ->whereYear('patrimonios.fecha_declaracion', $anio_actual)
                    ->where('patrimonios.patrimonio', $rangos[0])
                    ->select(DB::raw("COUNT(personas.id) as total_persona"))
                    ->first();
            }

            if ($rangos[0] == "sin_registros") {

                $data_patrimonio = Patrimonio::rightJoin('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
                    ->rightJoin('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->rightJoin('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->rightJoin('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->rightJoin('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('funcion_estado.id', $function_estado)
                    //->whereYear('patrimonios.fecha_declaracion', $anio_actual)
                    ->where('patrimonios.publicar', 'SI')
                    ->select(DB::raw("COUNT(personas.id) as total_persona"))
                    ->first();
            }
        }

        return $data_patrimonio;

    }

    public static function patrimonioPersonasRangoFuncionEstado($function_estado, $rango)
    {
        //$date = \Carbon\Carbon::now();
        //$anio_actual = intval($date->format('Y'))-1;
        $date = Patrimonio::obtenerUltimoAnioRegistros();
        $anio_actual = date('Y', strtotime($date));
        $pos = strpos($rango, ',');

        if ($pos === false) {
            $rangos = explode("-", $rango);
        } else {
            $rangos = explode(",", $rango);
        }

        if (count($rangos) > 1) {
            $data_patrimonio = Patrimonio::join('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
                ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                ->where('actividades.posicion_actual', 1)
                ->where('personas.estado_id', 3)
                ->where('funcion_estado.id', $function_estado)
                ->where('patrimonios.publicar', 'SI')
                //->whereYear('patrimonios.fecha_declaracion', $anio_actual)
                ->whereBetween('patrimonios.patrimonio', [$rangos[0], $rangos[1]])
                ->select('patrimonios.patrimonio', 'posiciones.nombre_posicion as cargo', 'personas.nombres_persona', 'personas.apellidos_persona', 'perfiles.id as perfil_id', 'perfiles.picture as imagen_persona')
                ->orderBy('patrimonios.patrimonio', 'DESC')
                ->get();
        }

        if (count($rangos) == 1) {
            if ($rangos[0] == 1000001) {
                $data_patrimonio = Patrimonio::join('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
                    ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('funcion_estado.id', $function_estado)
                    ->where('patrimonios.publicar', 'SI')
                    // ->whereYear('patrimonios.fecha_declaracion', $anio_actual)
                    ->where('patrimonios.patrimonio', '>', $rangos[0])
                    ->select('patrimonios.patrimonio', 'posiciones.nombre_posicion as cargo', 'personas.nombres_persona', 'personas.apellidos_persona', 'perfiles.id as perfil_id', 'perfiles.picture as imagen_persona')
                    ->orderBy('patrimonios.patrimonio', 'DESC')
                    ->get();
            }

            if ($rangos[0] == 0) {
                $data_patrimonio = Patrimonio::join('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
                    ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('funcion_estado.id', $function_estado)
                    ->where('patrimonios.publicar', 'SI')
                    //->whereYear('patrimonios.fecha_declaracion', $anio_actual)
                    ->where('patrimonios.patrimonio', $rangos[0])
                    ->select('patrimonios.patrimonio', 'posiciones.nombre_posicion as cargo', 'personas.nombres_persona', 'personas.apellidos_persona', 'perfiles.id as perfil_id', 'perfiles.picture as imagen_persona')
                    ->orderBy('patrimonios.patrimonio', 'DESC')
                    ->get();
            }

            if ($rangos[0] == "sin_registros") {

                $data_patrimonio = Patrimonio::rightJoin('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
                    ->rightJoin('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->rightJoin('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->rightJoin('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->rightJoin('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('funcion_estado.id', $function_estado)
                    ->where('patrimonios.publicar', 'SI')
                    //->whereYear('patrimonios.fecha_declaracion', $anio_actual)
                    ->select('patrimonios.patrimonio', 'posiciones.nombre_posicion as cargo', 'personas.nombres_persona', 'personas.apellidos_persona', 'perfiles.id as perfil_id', 'perfiles.picture as imagen_persona')
                    ->take(5)
                    ->get();
            }
        }

        return $data_patrimonio;

    }

    public static function patrimonioRangoTodosFuncionEstado($rango)
    {
        //$date = \Carbon\Carbon::now();
        //$anio_actual = intval($date->format('Y'))-1;
        $date = Patrimonio::obtenerUltimoAnioRegistros();
        $anio_actual = date('Y', strtotime($date));

        $pos = strpos($rango, ',');
        if ($pos === false) {
            $rangos = explode("-", $rango);
        } else {
            $rangos = explode(",", $rango);
        }

        if (count($rangos) > 1) {
            $data_patrimonio = Patrimonio::join('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
                ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                ->where('actividades.posicion_actual', 1)
                ->where('personas.estado_id', 3)
                ->where('patrimonios.publicar', 'SI')
                //->whereYear('patrimonios.fecha_declaracion', $anio_actual)
                ->whereBetween('patrimonios.patrimonio', [$rangos[0], $rangos[1]])
                ->select('patrimonios.patrimonio', 'posiciones.nombre_posicion as cargo', 'personas.nombres_persona', 'personas.apellidos_persona')
                ->orderBy('patrimonios.patrimonio', 'DESC')
                ->get();
        }

        if (count($rangos) == 1) {
            if ($rangos[0] == 1000001) {
                $data_patrimonio = Patrimonio::join('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
                    ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('patrimonios.publicar', 'SI')
                    // ->whereYear('patrimonios.fecha_declaracion', $anio_actual)
                    ->where('patrimonios.patrimonio', '>', $rangos[0])
                    ->select('patrimonios.patrimonio', 'posiciones.nombre_posicion as cargo', 'personas.nombres_persona', 'personas.apellidos_persona')
                    ->orderBy('patrimonios.patrimonio', 'DESC')
                    ->get();
            }

            if ($rangos[0] == 0) {
                $data_patrimonio = Patrimonio::join('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
                    ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('patrimonios.publicar', 'SI')
                    // ->whereYear('patrimonios.fecha_declaracion', $anio_actual)
                    ->where('patrimonios.patrimonio', $rangos[0])
                    ->select('patrimonios.patrimonio', 'posiciones.nombre_posicion as cargo', 'personas.nombres_persona', 'personas.apellidos_persona')
                    ->orderBy('patrimonios.patrimonio', 'DESC')
                    ->get();
            }

            if ($rangos[0] == "sin_registros") {
                $data_patrimonio = Patrimonio::rightJoin('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
                    ->rightJoin('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->rightJoin('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->rightJoin('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->rightJoin('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('patrimonios.publicar', 'SI')
                    // ->whereYear('patrimonios.fecha_declaracion', $anio_actual)
                    ->select('personas.nombres_persona', 'posiciones.nombre_posicion as cargo', 'personas.apellidos_persona')
                    ->orderBy('patrimonios.patrimonio', 'DESC')
                    ->get();
            }
        }

        return $data_patrimonio;
    }

    public static function rangoPatrimoniosTodos($rango)
    {
        //$date = \Carbon\Carbon::now();
        //$anio_actual = intval($date->format('Y'))-1;
        $date = Patrimonio::obtenerUltimoAnioRegistros();
        $anio_actual = date('Y', strtotime($date));

        $rangos = (is_array($rango)) ? $rango : explode("-", $rango);

        if (count($rangos) > 1) {
            $data_patrimonio = Patrimonio::join('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
                ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                ->where('actividades.posicion_actual', 1)
                ->where('personas.estado_id', 3)
                // ->whereYear('patrimonios.fecha_declaracion', $anio_actual)
                ->where('patrimonios.publicar', 'SI')
                ->whereBetween('patrimonios.patrimonio', [$rangos[0], $rangos[1]])
                ->select(DB::raw("COUNT(personas.id) as total_persona"), DB::raw("SUM(patrimonios.patrimonio) as total_patrimonio"))
                ->first();
        }

        if (count($rangos) == 1) {
            if ($rangos[0] == 1000001) {
                //dd($rangos[0]);
                $data_patrimonio = Patrimonio::join('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
                    ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('patrimonios.publicar', 'SI')
                    //->whereYear('patrimonios.fecha_declaracion', $anio_actual)
                    ->where('patrimonios.patrimonio', '>', $rangos[0])
                    ->select(DB::raw("COUNT(personas.id) as total_persona"), DB::raw("SUM(patrimonios.patrimonio) as total_patrimonio"))
                    ->first();
            }

            if ($rangos[0] == 0) {
                $data_patrimonio = Patrimonio::join('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
                    ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('patrimonios.publicar', 'SI')
                    //    ->whereYear('patrimonios.fecha_declaracion', $anio_actual)
                    ->where('patrimonios.patrimonio', $rangos[0])
                    ->select(DB::raw("COUNT(personas.id) as total_persona"), DB::raw("SUM(patrimonios.patrimonio) as total_patrimonio"))
                    ->first();
            }
            // if($rango[0] == 99){
            //     echo "Uno";
            // }

            if ($rangos[0] == "sin_registros") {

                $data_patrimonio = Patrimonio::rightJoin('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
                    ->rightJoin('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->rightJoin('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->rightJoin('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->rightJoin('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('patrimonios.publicar', 'SI')
                    //->whereYear('patrimonios.fecha_declaracion', $anio_actual)
                    ->select(DB::raw("COUNT(personas.id) as total_persona"), DB::raw("SUM(patrimonios.patrimonio) as total_patrimonio"))
                    ->first();
            }
        }

        return $data_patrimonio;

    }

    /*API*/
    public static function apiPatrimonio()
    {
        //$date = \Carbon\Carbon::now();
        //$anio_actual = intval($date->format('Y'))-1;
        $date = Patrimonio::obtenerUltimoAnioRegistros();
        $anio_actual = date('Y', strtotime($date));

        return Patrimonio::join('perfiles', 'perfiles.id', '=', 'patrimonios.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('patrimonios.publicar', 'SI')
            //->whereYear('patrimonios.fecha_declaracion', $anio_actual)
            ->select('patrimonios.patrimonio', 'patrimonios.numero_casas', 'patrimonios.numero_carros', 'patrimonios.numero_companias', 'patrimonios.fecha_declaracion', 'patrimonios.activos', 'patrimonios.pasivos', 'personas.nombres_persona', 'personas.apellidos_persona', 'personas.id as persona_id', 'posiciones.nombre_posicion as cargo', 'funcion_estado.nombre as funcion', 'funcion_estado.categoria')
            ->orderBy('funcion_estado.categoria')
            ->get();
    }
}