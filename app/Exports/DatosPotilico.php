<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

use App\Models\Persona;

class DatosPotilico implements FromView, WithTitle, WithDrawings
{
    
	protected $id_persona;
    
    public function __construct(int $id_persona)
    {
        $this->id_persona = $id_persona;
    }

    public function view(): View
    {
    	$datos_persona = Persona::where('id',$this->id_persona)->first();
    	
        return view('exports.datosPersonalesPoliticoExcel', [
            'datos_persona' => $datos_persona
        ]);
    }

     public function drawings()
    {
        $datos_persona = Persona::where('id',$this->id_persona)->first();
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path($datos_persona->imagen_persona));
        $drawing->setHeight(150);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function title(): string
    {
        return 'Datos personales';
    }
}
