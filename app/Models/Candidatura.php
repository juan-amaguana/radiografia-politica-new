<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Candidatura extends Model
{
    use SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
    protected $table = 'candidaturas';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_candidatura',
        'posicion_id',
        'fecha_inicio_candidatura',
        'fecha_fin_candidatura',
        'candidatura_abierta',
        'es_candidatura',
    ];

    protected $softCascade = ['postulanteCandidatura'];

    public function postulanteCandidatura()
    {
        return $this->hasMany('App\Models\PostulanteCandidatura');
    }


    public function posicion(){
         return $this->belongsTo('App\Models\Posicion','posicion_id');
    }

    public static function candidaturasPostulaciones($persona_id){

        return Candidatura::join('postulante_candidaturas','postulante_candidaturas.candidatura_id','=','candidaturas.id')
                            ->join('personas','personas.id','=','postulante_candidaturas.persona_id')
                            ->where('personas.id',$persona_id)
                            ->select( 'postulante_candidaturas.id',DB::raw("(CASE 
                                        WHEN candidaturas.es_candidatura=1 THEN 'Candidatura' 
                                        ELSE 'Postulación' END) AS descripcion_corta"),'candidaturas.nombre_candidatura as descripcion',
                            DB::raw ('YEAR(candidaturas.fecha_inicio_candidatura) as anio_inicio'),DB::raw('YEAR(candidaturas.fecha_fin_candidatura) as anio_fin'))
                            ->get();

    } 
}
