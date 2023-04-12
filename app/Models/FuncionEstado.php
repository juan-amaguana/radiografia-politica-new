<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FuncionEstado extends Model
{

  use SoftDeletes;
  protected $table = 'funcion_estado';

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
    ];


    public function posicion()
    {
        return $this->hasMany('App\Models\Posicion');
    }



  public static function funcionesEstado(){
    return FuncionEstado::where('categoria',0)
                          ->get();
  }

  public static function institucionesIndependientes(){
    return FuncionEstado::where('categoria',1)
                          ->get();
  }
 
}
