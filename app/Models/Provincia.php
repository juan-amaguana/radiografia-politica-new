<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provincia extends Model
{

  use SoftDeletes;
  protected $table = 'provincia';

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
    ];

  public function canton(){
      return $this->hasMany('App\Models\Canton');
  }

  public function persona(){
      return $this->hasMany('App\Models\Persona');
  }

  public function actividad(){
      return $this->hasMany('App\Models\Actividad');
    }

  public static function obtenerCantones($provincia_id){
    return Provincia::join('canton','canton.provincia_id','=','provincia.id')
                      ->where('provincia.id',$provincia_id)
                      ->select('canton.*')
                      ->get();
  }

}
