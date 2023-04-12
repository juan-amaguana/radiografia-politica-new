<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Perfil;
use App\Models\PartidoPolitico;
use App\Models\FuncionEstado;
use App\Models\Patrimonio;

class GraficasRadiografiaPoliticaController extends Controller
{
    public function graficas(){
        $partidos_politicos = PartidoPolitico::all();
    	return view('graficas.radiografia_politica')->with(['partidos_politicos'=>$partidos_politicos]);
    }

    public function posiciones(){
        //$partidos_politicos = PartidoPolitico::all();
        return view('graficas.posiciones_politicos');
    }


    public function personaPartidosPoliticos(){
    	$personas_partido_politico = Persona::personaspartidosPoliticos();
    	$personas_radiografia_politica = array();
    	$titles = array();

    	foreach ($personas_partido_politico as $partido_politico) {
    		array_push($personas_radiografia_politica, $partido_politico->personas);
    		array_push($titles, $partido_politico->nombre_partido_politico);
    	}
    	//array_push($personas_radiografia_politica, $titles);
    	return ['personas_radiografia_politica'=>$personas_radiografia_politica,'titles'=>$titles];
    }

    public function personaEstudios($partido_politico_id){
        $personas_pregrado = Persona::personasEstudiosPregrado($partido_politico_id);
        $personas_posgrado = Persona::personasEstudiosPosgrado($partido_politico_id);
        $personas_phd = Persona::personasEstudiosPhd($partido_politico_id);
        
        $personas_radiografia_politica = array();
        $personas_radiografia_politica['pregrado'] =( !is_null($personas_pregrado) ) ? $personas_pregrado->pregrado_personas : 0;
        $personas_radiografia_politica['postgrado'] = ( !is_null($personas_posgrado) ) ? $personas_posgrado->postgrado_personas : 0;
        $personas_radiografia_politica['phd'] = ( !is_null($personas_phd) ) ? $personas_phd->phd_personas : 0;

        return $personas_radiografia_politica;
    }

    public function personasSexosPartidosPoliticos($partido_politico_id){
        $partido_politico = PartidoPolitico::find($partido_politico_id);
        $personas_sexos_partido_politico = Persona::personasSexoPartidosPoliticos($partido_politico_id);

        $personas_radiografia_politica = array();
        $titles = array();

        foreach ($personas_sexos_partido_politico as $persona_sexo_partido_politico) {
            
            if ($persona_sexo_partido_politico->genero_persona == 0) {
                $personas_radiografia_politica['mujeres'] =$persona_sexo_partido_politico->personas; 
            }else{
                $personas_radiografia_politica['hombres'] =$persona_sexo_partido_politico->personas;
            }
        }
        return  ['personas_radiografia_politica'=>$personas_radiografia_politica,'partido_politico'=>$partido_politico];
    }

    /*public function posicionesCargosApi(){
        $cargos_posiciones = Persona::cargosPosiciones();


        $cargo_posicion_personas = array('cargos_posiciones' => 
                                foreach ($cargos_posiciones as $cargo_posicion ) {
                                    $persona_posicion = Persona::personasPosiciones($cargo_posicion->nombre_posicion);
                                    
                                   }
                                );

        return ['cargo_posicion_personas'=>$cargo_posicion_personas];


    }*/

    public function graficasCargosPosiciones(){
        return view ('graficas.posiciones_cargos');
    }

    public function graficasProfesionales(){
        $funciones = FuncionEstado::all();
        return view ('graficas.profesionales')->with(['funciones'=>$funciones]);   
    }

    public function graficaPatrimonio(){

        return view('graficas.patrimonio');
    }

    public function graficaSri(){
        return view('graficas.sri');
    }
    
    public function graficasVisitasPerfil(){
        return view('graficas.visitas');
    }

    public function graficaPatrimonioFuncionEstado(){

        $funciones = FuncionEstado::all();
        //dd($funciones);
        return view('graficas.2patrimonioFuncionEstado')->with(['funciones'=>$funciones]);
    }


    public function graficaImpuestoRentaFuncionEstado(){
        $funciones = FuncionEstado::all();
        //dd($funciones);
        return view('graficas.3impuestoRentaFuncionEstado')->with(['funciones'=>$funciones]);
    }

    

    public function graficaGeneroFuncionEstado(){
        
        //dd($funciones);
        return view('graficas.1generoFuncionEstado');
    }


    public function graficaFormacionAcademica(){
        $funciones = FuncionEstado::all();
        return view('graficas.4formacion_academica')->with(['funciones'=>$funciones]);
    }

    public function graficaFormacionAcademicaArea(){
        $funciones = FuncionEstado::all();
        return view('graficas.5formacion_academicaArea')->with(['funciones'=>$funciones]);
    }

   

    public function graficaPatrimonioRangoFuncionEstado(){
        $funciones = FuncionEstado::all();
        
        return view('graficas.2_1patrimonioRangoFuncionEstado2')->with(['funciones'=>$funciones]);

    }

    public function graficaImpuestoRentaRangoFuncionEstadoNuevo(){
        $funciones = FuncionEstado::all();
        //dd($funciones);
        return view('graficas.3_1impuestoRentaRangoFuncionEstado2')->with(['funciones'=>$funciones]);
    }

}
