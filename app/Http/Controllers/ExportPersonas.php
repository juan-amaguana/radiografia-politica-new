<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PersonasExport;
use App\Exports\PoliticoDetalleExport;
use Excel; 
use App\Models\Persona;

class ExportPersonas extends Controller
{
    public function exportExcel(){
    	return Excel::download(new PersonasExport,'personas-politico.xlsx');
    }

    public function exportCsv(){
    	return Excel::download(new PersonasExport,'personas-politico.csv');
    }

    public function exportarPolitico($id_politico){
    	$persona = Persona::where('id',$id_politico)->first();
    	//dd($persona);
      	return Excel::download(new PoliticoDetalleExport($id_politico),$persona->apellidos_persona.'politico-detalle.xlsx');
    }

    public function exportarPoliticoCsv($id_politico){
    	$persona = Persona::where('id',$id_politico)->first();
    	//dd($persona->apellidos_persona);
      	return Excel::download(new PoliticoDetalleExport($id_politico),$persona->apellidos_persona.'politico-detalle.csv');
    } 
}
