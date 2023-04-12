<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacto extends Model
{
    use SoftDeletes;
    
    protected $table = 'contactos';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_contacto',
        'email_contacto',
        'telefono_contacto',
        'asunto_contacto',
        'mensaje_contacto',
    ];
}
