<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostulanteCandidatura extends Model
{
    use SoftDeletes;
    protected $table = 'postulante_candidaturas';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gano_candidatura',
        'candidatura_id',
        'persona_id',
        'partido_politico_id',
        'descripcion',
        'nombre_fuente_actividad',
        'link_fuente_actividad',
        'retirado',
    ]; 

    public function candidatura()
    {
        return $this->belongsTo('App\Models\Candidatura');
    }

    public function posicion()
    {
        return $this->belongsTo('App\Models\Posicion');
    }

    public function persona()
    {
        return $this->belongsTo('App\Models\Persona');
    }

    public function partidoPolitico()
    {
        return $this->belongsTo('App\Models\PartidoPolitico');
    }
}
