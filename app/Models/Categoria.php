<?php

namespace App\Models;
use App\Models\Position;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;
    protected $table = 'categorias';

    public function posicion(){
    	return $this->hasMany('App\Models\Posicion');
    }

    
}
