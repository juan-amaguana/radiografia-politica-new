<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

use App\Models\Persona;

class AntecedentesPotilico implements FromView, WithTitle
{
    
	protected $id_persona;
    
    public function __construct(int $id_persona)
    {
        $this->id_persona = $id_persona;
    }

    public function view(): View
    {
        //dd('hola');
        $persona_politico = $persona = Persona::personaApi($this->id_persona);

    	//dd($persona_politico);
        return view('exports.antecedentesPoliticoExcel', [
            'antecedentes_politico' => $persona_politico->perfil
        ]);
    }

    public function title(): string
    {
        return 'Antecedentes Penales';
    }
}
