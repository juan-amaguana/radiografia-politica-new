<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

use App\Models\Persona;

class PatrimonioPotilico implements FromView, WithTitle
{
    
	protected $id_persona;
    
    public function __construct(int $id_persona)
    {
        $this->id_persona = $id_persona;
    }

    public function view(): View
    {
        $patrimonio = Persona::personasPatrimonioPersona($this->id_persona)->first();

    	//dd($patrimonio);
        return view('exports.patrimonioPoliticoExcel', [
            'patrimonio' => $patrimonio
        ]);
    }

    

    public function title(): string
    {
        return 'Declaración Patrimonial';
    }
} 
  