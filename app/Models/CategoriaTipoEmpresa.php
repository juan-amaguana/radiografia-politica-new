<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaTipoEmpresa extends Model
{
    use SoftDeletes;
    protected $table = 'categoria_tipo_empresas';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_categoria_tipo_empresa',
        'descripcion_categoria_tipo_empresa',
    ];

    public function cargo(){
        return $this->hasMany('App\Models\Cargo');
    }
}
