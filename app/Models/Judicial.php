<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Judicial extends Model
{
    use SoftDeletes;
    protected $table = 'judiciales';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_judicial',
        'numero_judicial',
        'tipo_jucio_id',
        'perfil_id',
        'user_id',
    ];

    public function tipoJuicio()
    {
        return $this->belongsTo('App\Models\TipoJuicio','tipo_jucio_id');
    }

    public function perfil()
    {
        return $this->belongsTo('App\Models\Perfil');
    }

}
