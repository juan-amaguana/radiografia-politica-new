<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compania extends Model
{
    use SoftDeletes;
    protected $table = 'companias';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_compania',
        'posicion_compania',
        'total_compania',
        'perfil_id',
        'user_id',
        'estado',
        'posicion'
    ];

    public function perfil()
    {
        return $this->belongsTo('App\Models\Perfil');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
 