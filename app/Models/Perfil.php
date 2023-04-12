<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perfil extends Model
{
    use SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;
    protected $table = 'perfiles'; 

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url_sri',
        'url_patrimonio',
        'url_compania',
        'url_judicial',
        'url_penal',
        'url_estudio',
        'url_contraloria',
        'url_perfil',
        'picture',
        'antecedentes_penales',
        'nombre_archivo_sri',
        'nombre_archivo_patrimonio',
        'nombre_archivo_compania',
        'nombre_archivo_judicial',
        'nombre_archivo_penal',
        'nombre_archivo_estudio',
        'nombre_archivo_contraloria',
        'persona_id',
        'user_id',
        'pensiones_alimenticias',
        'pensiones_alimenticias_fuente'
    ];

    protected $softCascade = ['sri','judicial','patrimonio','compania','estudio'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function estudio()
    {
        return $this->hasOne('App\Models\Estudio');
    }

    public function persona()
    {
        return $this->belongsTo('App\Models\Persona');
    }

    public function compania(){
        return $this->hasMany('App\Models\Compania');
    }

    public function sri(){
        return $this->hasMany('App\Models\Sri');
    }

    public function judicial(){
        return $this->hasMany('App\Models\Judicial');
    }

    public function patrimonio()
    {
        return $this->hasMany('App\Models\Patrimonio');
    }



    
}