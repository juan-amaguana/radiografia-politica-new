<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use App\Models\Sri;
use App\Models\Administracion;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class SriExport implements FromView, WithTitle
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
        $datos_api = Sri::apiSri();
        //dd($datos_api);
        return view('exports.api.sriPersonasExcel', [
            'datos_api' => $datos_api,
            'meta_datos' => $meta_datos
        ]);
    } 

    public function title(): string
    {
        return 'SRI personas';
    }
}
