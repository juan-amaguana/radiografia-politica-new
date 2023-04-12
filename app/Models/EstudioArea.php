<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstudioArea extends Model
{
    use SoftDeletes;

    protected $table = 'estudio_areas';


    public function estudio(){
        return $this->hasMany('App\Models\Estudio');
    }
} 
