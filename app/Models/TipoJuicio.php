<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoJuicio extends Model
{
    use SoftDeletes;
    protected $table = 'tipo_jucios';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_tipo_juicio',
    ];

    public function judicial(){
        return $this->hasMany('App\Models\Judicial');
    }
}
 