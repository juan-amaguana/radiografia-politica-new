<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sri extends Model
{
    use SoftDeletes;
    protected $table = 'sris';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'anio_sri',
        'tipo_impuesto_sri',
        'declaracion',
        'valor_impuesto_sri',
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
    public static function obtenerUltimoAnioRegistros()
    {
        $registro_ultimo = Sri::orderBy('anio_sri', 'desc')->get()->first();

        return $registro_ultimo->anio_sri;
    }

    public static function sriGraficaRenta($anio)
    {
        return DB::select("select personas.nombres_persona, personas.apellidos_persona, anio_sri, personas.id as persona_id, sris.valor_impuesto_sri as sri_rentas from personas
            inner join perfiles on personas.id = perfiles.persona_id
            inner join sris on perfiles.id = sris.perfil_id
            where personas.estado_id = 3 and
            sris.anio_sri = '$anio' and
            sris.tipo_impuesto_sri = 1
            order by persona_id Asc
            LIMIT 7");
    }

    public static function sriGrficaDivisas($anio)
    {
        return DB::select("select personas.nombres_persona, personas.apellidos_persona, anio_sri, personas.id as persona_id, sris.valor_impuesto_sri as sri_divisas from personas
            inner join perfiles on personas.id = perfiles.persona_id
            inner join sris on perfiles.id = sris.perfil_id
            where personas.estado_id = 3 and
            sris.anio_sri = '$anio' and
            sris.tipo_impuesto_sri = 2
            order by persona_id ASC
            LIMIT 7");
    }

    public static function obtenerSriFuncionEstado($function_estado, $anio)
    {
        return Sri::join('perfiles', 'perfiles.id', '=', 'sris.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('funcion_estado.id', $function_estado)
            ->where('sris.tipo_impuesto_sri', 2)
            ->where('sris.anio_sri', $anio)
            ->select('sris.valor_impuesto_sri', 'personas.nombres_persona', 'personas.apellidos_persona', 'perfiles.id as perfil_id', 'personas.imagen_persona')
            ->orderBy('sris.valor_impuesto_sri', 'DESC')
            ->distinct('personas.apellidos_persona')
            ->take(5)
            ->get();
    }

    public static function obtenerSriFuncionEstadoTodos($anio)
    {
        return Sri::join('perfiles', 'perfiles.id', '=', 'sris.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            ->where('personas.estado_id', 3)
            ->where('sris.tipo_impuesto_sri', 2)
            ->where('sris.anio_sri', $anio)
            ->select('sris.valor_impuesto_sri', 'personas.nombres_persona', 'personas.apellidos_persona', 'perfiles.id as perfil_id', 'personas.imagen_persona')
            ->orderBy('sris.valor_impuesto_sri', 'DESC')
            ->distinct('personas.apellidos_persona')
            ->take(5)
            ->get();
    }

    public static function obtenerPorcentajeSriRango($function_estado, $rango)
    {

        $rangos = explode("-", $rango);

        $date = \Carbon\Carbon::now();
        $anio = Sri::obtenerUltimoAnioRegistros();
        //dd($anio);
        $anio = intval($date->format('Y'))-1;

        if (count($rangos) > 1) {
            $data_sri = Sri::join('perfiles', 'perfiles.id', '=', 'sris.perfil_id')
                ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                ->where('actividades.posicion_actual', 1)
                ->where('personas.estado_id', 3)
                ->where('funcion_estado.id', $function_estado)
                ->where('sris.tipo_impuesto_sri', 2)
                ->where('sris.anio_sri', $anio)
                ->whereBetween('sris.valor_impuesto_sri', [$rangos[0], $rangos[1]])
                ->select(DB::raw("COUNT(personas.id) as total_persona"))
                ->first();
        }

        if (count($rangos) == 1) {
            //dd($rangos[0]);
            if ($rangos[0] > 5000) {
                $data_sri = Sri::join('perfiles', 'perfiles.id', '=', 'sris.perfil_id')
                    ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('funcion_estado.id', $function_estado)
                    ->where('sris.tipo_impuesto_sri', 2)
                    ->where('sris.anio_sri', $anio)
                    ->where('sris.valor_impuesto_sri', '>', $rangos[0])
                    ->select(DB::raw("COUNT(personas.id) as total_persona"))
                    ->first();
            } else {
                $data_sri = Sri::join('perfiles', 'perfiles.id', '=', 'sris.perfil_id')
                    ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('funcion_estado.id', $function_estado)
                    ->where('sris.tipo_impuesto_sri', 2)
                    ->where('sris.anio_sri', $anio)
                    ->where('sris.valor_impuesto_sri', 0)
                    ->select(DB::raw("COUNT(personas.id) as total_persona"))
                    ->first();
            }
        }

        return $data_sri;

    }

    public static function obtenerPorcentajeSriRangoTodos($rango)
    {
        $anio = Sri::obtenerUltimoAnioRegistros();

        $rangos = explode("-", $rango);

        $date = \Carbon\Carbon::now();
        $anio = intval($date->format('Y'))-1;
        //$anio = 2018;
        //dd($anio);

        if (count($rangos) > 1) {
            $data_sri = Sri::join('perfiles', 'perfiles.id', '=', 'sris.perfil_id')
                ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                ->where('actividades.posicion_actual', 1)
                ->where('personas.estado_id', 3)
                ->where('sris.tipo_impuesto_sri', 2)
                ->where('sris.anio_sri', $anio)
                ->whereBetween('sris.valor_impuesto_sri', [$rangos[0], $rangos[1]])
                ->select(DB::raw("COUNT(personas.id) as total_persona"), DB::raw("SUM(sris.valor_impuesto_sri) as total_sri"))
                ->first();
        }

        if (count($rangos) == 1) {
            //dd($rangos[0]);
            if ($rangos[0] > 5000) {
                $data_sri = Sri::join('perfiles', 'perfiles.id', '=', 'sris.perfil_id')
                    ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('sris.tipo_impuesto_sri', 2)
                    ->where('sris.anio_sri', $anio)
                    ->where('sris.valor_impuesto_sri', '>', $rangos[0])
                    ->select(DB::raw("COUNT(personas.id) as total_persona"), DB::raw("SUM(sris.valor_impuesto_sri) as total_sri"))
                    ->first();
            } else {
                $data_sri = Sri::join('perfiles', 'perfiles.id', '=', 'sris.perfil_id')
                    ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('sris.tipo_impuesto_sri', 2)
                    ->where('sris.anio_sri', $anio)
                    ->where('sris.valor_impuesto_sri', 0)
                    ->select(DB::raw("COUNT(personas.id) as total_persona"), DB::raw("SUM(sris.valor_impuesto_sri) as total_sri"))
                    ->first();
            }
        }

        return $data_sri;

    }

    public static function obtenerSriRango($function_estado, $rango)
    {

        $rangos = explode("-", $rango);
        $date   = \Carbon\Carbon::now();
        //$anio = intval($date->format('Y'))-1;
        $anio = Sri::obtenerUltimoAnioRegistros();
        //dd(count($rangos));

        if (count($rangos) > 1) {

            $data_sri = Sri::join('perfiles', 'perfiles.id', '=', 'sris.perfil_id')
                ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                ->where('actividades.posicion_actual', 1)
                ->where('personas.estado_id', 3)
                ->where('funcion_estado.id', $function_estado)
                ->where('sris.tipo_impuesto_sri', 2)
                ->where('sris.anio_sri', $anio)
                ->whereBetween('sris.valor_impuesto_sri', [$rangos[0], $rangos[1]])
                ->select('sris.valor_impuesto_sri', 'posiciones.nombre_posicion as cargo', 'personas.nombres_persona', 'personas.apellidos_persona', 'perfiles.id as perfil_id', 'personas.imagen_persona')
                ->orderBy('sris.valor_impuesto_sri', 'DESC')
                ->get();
        }

        if (count($rangos) == 1) {
            //dd($rangos[0]);
            if ($rangos[0] > 5000) {
                $data_sri = Sri::join('perfiles', 'perfiles.id', '=', 'sris.perfil_id')
                    ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('funcion_estado.id', $function_estado)
                    ->where('sris.tipo_impuesto_sri', 2)
                    ->where('sris.anio_sri', $anio)
                    ->where('sris.valor_impuesto_sri', '>', $rangos[0])
                    ->select('sris.valor_impuesto_sri', 'posiciones.nombre_posicion as cargo', 'personas.nombres_persona', 'personas.apellidos_persona', 'perfiles.id as perfil_id', 'personas.imagen_persona')
                    ->orderBy('sris.valor_impuesto_sri', 'DESC')
                    ->get();
            } else {
                $data_sri = Sri::join('perfiles', 'perfiles.id', '=', 'sris.perfil_id')
                    ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('funcion_estado.id', $function_estado)
                    ->where('sris.tipo_impuesto_sri', 2)
                    ->where('sris.anio_sri', $anio)
                    ->where('sris.valor_impuesto_sri', 0)
                    ->select('sris.valor_impuesto_sri', 'posiciones.nombre_posicion as cargo', 'personas.nombres_persona', 'personas.apellidos_persona', 'perfiles.id as perfil_id', 'personas.imagen_persona')
                    ->orderBy('sris.valor_impuesto_sri', 'DESC')
                    ->get();
            }
        }

        return $data_sri;

    }

    public static function obtenerSriTodosRango($rango)
    {
        $rangos = explode("-", $rango);
        $date   = \Carbon\Carbon::now();
        //$anio = intval($date->format('Y'))-1;
        $anio   = Sri::obtenerUltimoAnioRegistros();
        $rangos = explode("-", $rango);

        //dd(count($rangos));

        if (count($rangos) > 1) {
            $data_sri = Sri::join('perfiles', 'perfiles.id', '=', 'sris.perfil_id')
                ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                ->where('actividades.posicion_actual', 1)
                ->where('personas.estado_id', 3)
                ->where('sris.tipo_impuesto_sri', 2)
                ->where('sris.anio_sri', $anio)
                ->whereBetween('sris.valor_impuesto_sri', [$rangos[0], $rangos[1]])
                ->select('sris.valor_impuesto_sri', 'posiciones.nombre_posicion as cargo', 'personas.nombres_persona', 'personas.apellidos_persona', 'perfiles.id as perfil_id', 'personas.imagen_persona')
                ->orderBy('sris.valor_impuesto_sri', 'DESC')
                ->get();
        }

        if (count($rangos) == 1) {
            //dd($rangos[0]);
            if ($rangos[0] > 5000) {
                $data_sri = Sri::join('perfiles', 'perfiles.id', '=', 'sris.perfil_id')
                    ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('sris.tipo_impuesto_sri', 2)
                    ->where('sris.anio_sri', $anio)
                    ->where('sris.valor_impuesto_sri', '>', $rangos[0])
                    ->select('sris.valor_impuesto_sri', 'posiciones.nombre_posicion as cargo', 'personas.nombres_persona', 'personas.apellidos_persona', 'perfiles.id as perfil_id', 'personas.imagen_persona')
                    ->orderBy('sris.valor_impuesto_sri', 'DESC')
                    ->get();
            } else {
                $data_sri = Sri::join('perfiles', 'perfiles.id', '=', 'sris.perfil_id')
                    ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
                    ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
                    ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
                    ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
                    ->where('actividades.posicion_actual', 1)
                    ->where('personas.estado_id', 3)
                    ->where('sris.tipo_impuesto_sri', 2)
                    ->where('sris.anio_sri', $anio)
                    ->where('sris.valor_impuesto_sri', 0)
                    ->select('sris.valor_impuesto_sri', 'posiciones.nombre_posicion as cargo', 'personas.nombres_persona', 'personas.apellidos_persona', 'perfiles.id as perfil_id', 'personas.imagen_persona')
                    ->orderBy('sris.valor_impuesto_sri', 'DESC')
                    ->get();
            }
        }

        return $data_sri;

    }

    /*API*/

    public static function apiSri()
    {
        $date = \Carbon\Carbon::now();
        //$anio_fin = intval($date->format('Y'))-1;
        $anio = Sri::obtenerUltimoAnioRegistros();
        return Sri::join('perfiles', 'perfiles.id', '=', 'sris.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->join('actividades', 'actividades.persona_id', '=', 'personas.id')
            ->join('posiciones', 'actividades.posicion_id', 'posiciones.id')
            ->join('funcion_estado', 'funcion_estado.id', '=', 'posiciones.funcion_estado_id')
            ->where('actividades.posicion_actual', 1)
            //->where('sris.anio_sri', $anio_fin)
            ->select('sris.anio_sri as anio_declaracion', 'sris.tipo_impuesto_sri', 'sris.valor_impuesto_sri', 'personas.nombres_persona', 'personas.apellidos_persona', 'personas.id as persona_id', 'posiciones.nombre_posicion as cargo', 'funcion_estado.nombre as funcion', 'funcion_estado.categoria')
            ->orderBy('funcion_estado.categoria')
            ->get();
    }

    public static function obtenerSriIndex()
    {
        $sris = Sri::join('perfiles', 'perfiles.id', '=', 'sris.perfil_id')
            ->join('personas', 'personas.id', '=', 'perfiles.persona_id')
            ->select('sris.anio_sri as anio_declaracion', 'sris.tipo_impuesto_sri', 'sris.valor_impuesto_sri', 'personas.nombres_persona', 'personas.apellidos_persona', 'sris.id as sri_id')
            ->get();

        $sris_data = array();
        foreach ($sris as $sri) {
            $data = array();
            $data += ["sri_id" => $sri->sri_id];
            $data += ["anio_declaracion" => $sri->anio_declaracion];
            if ($sri->tipo_impuesto_sri == 1) {
                $data += ["tipo_impuesto_sri" => 'Impuesto de divisas'];
            } else { $data += ["tipo_impuesto_sri" => 'Impuesto a la renta'];}
            $data += ["valor_impuesto_sri" => $sri->valor_impuesto_sri];
            $data += ["nombre_completo_persona" => $sri->nombres_persona . ' ' . $sri->apellidos_persona];
            array_push($sris_data, $data);
        }
        return $sris_data;
    }
}