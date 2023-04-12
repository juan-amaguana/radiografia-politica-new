<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{
	use SoftDeletes;
    protected $table = 'estados';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_estado',
    ];

    public function persona(){
        return $this->hasMany('App\Models\Persona');
    }
}
