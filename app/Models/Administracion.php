<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administracion extends Model
{
    use SoftDeletes;
    protected $table = 'administraciones';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mision',
        'vision',
        'imagen1',
        'imagen2',
        'imagen3',
        'logo_movil',
        'logo_web',
        'descripcion_logo_movil',
        'descripcion_logo_web',
        'key_word',
        'email',
        'telefono',
        'direccion',
        'licencia',
        'email_contacto_datos_abiertos',
        'autor_datos_abiertos',
    ];

    public static function metaDatosApi(){
        return Administracion::select('email_contacto_datos_abiertos','autor_datos_abiertos','licencia','key_word')
                            ->first();
    }
}
