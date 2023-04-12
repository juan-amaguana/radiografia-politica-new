<?php

namespace App\Exports;

use App\Models\Persona;
use App\Models\Administracion;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class GeneroExport implements FromView, WithTitle
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
        $datos_api = Persona::apiGenero();
        //dd($datos_api);
        return view('exports.api.generoPersonasExcel', [
            'datos_api' => $datos_api,
            'meta_datos' => $meta_datos
        ]);
    } 

    public function title(): string
    {
        return 'genero personas';
    }
}
