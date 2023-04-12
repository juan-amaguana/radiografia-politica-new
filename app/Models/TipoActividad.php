<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoActividad extends Model
{
    use SoftDeletes;
    protected $table = 'tipo_actividades';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_tipo_actividad',
    ];

    public function actividad(){
        return $this->hasMany('App\Models\Actividad');
    }
}
