<?php

namespace App\Exports;

use App\Models\Persona;
use App\Models\Administracion;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PersonasExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function collection()
    {
        return Persona::all();
    }*/

    public function view(): View 
    {
    	$api_radiografia_politica = array("metaDatos"=>Administracion::metaDatosApi(), "datos"=>Persona::personaDetalle());
    	//dd($api_radiografia_politica);
        return view('exports.personasExcel', [
            'api_radiografia_politica' => $api_radiografia_politica
        ]);
    } 
}
