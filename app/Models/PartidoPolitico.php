<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartidoPolitico extends Model
{
	use SoftDeletes;

    protected $table = 'partidos_politicos';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_partido_politico',
        'imagen_partido_politico',
        'user_id',
    ];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function persona(){
        return $this->hasMany('App\Models\Persona');
    }

    public function postulanteCandidatura()
    {
        return $this->hasMany('App\Models\PostulanteCandidatura');
    }

    public function actividad()
    {
        return $this->hasMany('App\Models\Actividad');
    }
}
