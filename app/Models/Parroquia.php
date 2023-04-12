<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
    //
    //use SoftDeletes;
    protected $table = 'parroquia';

    /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
      protected $fillable = [
          'canton_id',
          'nombre',
      ];

      public function canton()
      {
          return $this->belongsTo('App\Models\Canton','canton_id');
      }

      public function actividad(){
      return $this->hasMany('App\Models\Actividad');
    }
    public function persona(){
      return $this->hasMany('App\Models\Persona');
  }
}
