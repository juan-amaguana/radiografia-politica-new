<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Actividad extends Model
{
    use SoftDeletes;

    protected $table = 'actividades';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
        'nombre_fuente_actividad',
        'link_fuente_actividad',
        'fecha_inicio_actividad',
        'fecha_fin_actividad',
        'posicion_actual',
        'persona_id',
        'tipo_actividad_id',
        'posicion_id',
        'url_legislativo',
        'partido_politico_id',
        'sector_id',
        'provincia_id',
        'canton_id',
        'parroquia_id',
        'descripcion_corta',
        'descripcion',
        'importante',
        'es_encargo_puesto',
        'es_subrogacion_puesto',
    ];

    public function persona()
    {
        return $this->belongsTo('App\Models\Persona');
    }

    public function posicion()
    {
        return $this->belongsTo('App\Models\Posicion');
    }

    public function partidoPolitico()
    {
        return $this->belongsTo('App\Models\PartidoPolitico');
    }

    public function tipoActividad()
    {
        return $this->belongsTo('App\Models\TipoActividad','tipo_actividad_id' );
    }

    public function provincia(){
        return $this->belongsTo('App\Models\Provincia');
    }

    public function sector(){
        return $this->belongsTo('App\Models\Sector');
    }

    public function canton(){
        return $this->belongsTo('App\Models\Canton');
    }

    public function parroquia(){
        return $this->belongsTo('App\Models\Parroquia');
    }

}
