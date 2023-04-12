<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

use App\Models\Persona;

class EstudiosPotilico implements FromView, WithTitle
{
    
	protected $id_persona;
    
    public function __construct(int $id_persona)
    {
        $this->id_persona = $id_persona;
    }

    public function view(): View
    {
    	$estudios_persona = Persona::personaApi($this->id_persona);
    	//dd($estudios_persona->perfil->estudio);
        return view('exports.estudiosPoliticoExcel', [
            'estudios_persona' => $estudios_persona->perfil->estudio
        ]);
    }

    public function title(): string
    {
        return 'Formacion academica';
    }


}
