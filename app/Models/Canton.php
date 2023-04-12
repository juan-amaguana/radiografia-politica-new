<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Canton extends Model
{

    use SoftDeletes;
    protected $table = 'canton';

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
        'provincia_id',
        'nombre',
    ];

    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincia','provincia_id');
    }
    public function persona(){
      return $this->hasMany('App\Models\Persona');
  }

    public function parroquia(){
      return $this->hasMany('App\Models\Parroquia');
    }

    public function actividad(){
      return $this->hasMany('App\Models\Actividad');
    }

    public static function obtenerParroquias($canton_id){
        return Canton::join('parroquia','parroquia.canton_id','=','canton.id')
                        ->where('canton.id',$canton_id)
                        ->get();

    }





}
