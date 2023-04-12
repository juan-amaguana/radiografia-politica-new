<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administracion;
use App\Models\Persona;
use App\Models\Patrimonio;
use App\Models\Sri;
use App\Models\Estudio;
use Excel;
use App\Exports\GeneroExport;
use App\Exports\PatrimonioExport;
use App\Exports\SriExport;
use App\Exports\EstudiosExport;

class ExportApiController extends Controller
{
    public function excelGenero(){
    	return Excel::download(new GeneroExport,'genero.xlsx');
    }

    public function csvGenero(){
    	return Excel::download(new GeneroExport,'genero.csv');
    }

    function jsonGenero(){
    	$api_genero = array("metaDatos"=>Administracion::metaDatosApi(), "datosGeneroPersona"=>Persona::apiGenero());
    	return $api_genero;
    }

    public function excelPatrimonio(){
    	return Excel::download(new PatrimonioExport,'patrimonio.xlsx');
    }

    public function csvPatrimonio(){
    	return Excel::download(new PatrimonioExport,'patrimonio.csv');
    }

    public function jsonPatrimonio(){
    	$api_patrimonio = array("metaDatos"=>Administracion::metaDatosApi(), "datosPatrimonioPersona"=>Patrimonio::apiPatrimonio());
    	return $api_patrimonio;
    }

    public function excelSri(){
    	return Excel::download(new SriExport,'sri.xlsx');
    }

    public function csvSri(){
    	return Excel::download(new SriExport,'sri.csv');
    }

    public function jsonSri(){
    	$api_sri = array("metaDatos"=>Administracion::metaDatosApi(), "datosSRIPersona"=>Sri::apiSri());
    	return $api_sri;
    }

    public function excelEstudio(){
        return Excel::download(new EstudiosExport,'estudio.xlsx');
    }

    public function csvEstudio(){
        return Excel::download(new EstudiosExport,'estudio.csv');
    }

    public function jsonEstudio(){
        $api_sri = array("metaDatos"=>Administracion::metaDatosApi(), "datosEstudiosPersona"=>Estudio::apiEstudios());
        return $api_sri;
    }
}
