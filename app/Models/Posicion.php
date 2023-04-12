<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Posicion extends Model
{
	use SoftDeletes;
	protected $table = 'posiciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array 
     */
    protected $fillable = [
        'nombre_posicion',
        'user_id',
				'funcion_estado_id',
				'institucion_id',
    ];

    public function categoria(){
    	return $this->belongsTo('App\Models\Categoria','categoria_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User'); 
    }

    public function postulanteCandidatura()
    {
        return $this->hasMany('App\Models\PostulanteCandidatura');
    }

    public function actividad()
    {
        return $this->hasMany('App\Models\Actividad');
    }

	public function funcion_estado()
    {
        return $this->belongsTo('App\Models\FuncionEstado', 'funcion_estado_id');
    }

	public function institucion()
    {
        return $this->hasMany('App\Models\Institucion', 'institucion_id');
    }

    public function persona()
    {
        return $this->hasMany('App\Models\Persona', 'posicion_id_CHECK');
    }

    public function candidatura()
    {
        return $this->hasMany('App\Models\Candidatura');
    }
    

    public static function obtenerPersonasCargo(){
        $ids_posiciones = "1,2,3,4,5";
        $array_ids = explode(",", $ids_posiciones);
        return Posicion::with(['persona' => function($query) {
                            $query->join('actividades','actividades.persona_id','=','personas.id')->where('actividades.posicion_actual',1);
                        }])
                        ->select('posiciones.id','posiciones.nombre_posicion')
                        ->whereIn('posiciones.id', $array_ids)
                        ->get();
                        
    }
    
}