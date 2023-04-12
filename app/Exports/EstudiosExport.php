<?php

namespace App\Exports;

use App\Models\Estudio;
use App\Models\Administracion;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;


class EstudiosExport implements FromView, WithTitle
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
        $meta_datos =Administracion::metaDatosApi();
        $datos_api = Estudio::apiEstudios();
        //dd($datos_api);
        return view('exports.api.estudiosPersonasExcel', [
            'datos_api' => $datos_api,
            'meta_datos' => $meta_datos
        ]);
    } 

    public function title(): string
    {
        return 'Estudios personas';
    }
} 
