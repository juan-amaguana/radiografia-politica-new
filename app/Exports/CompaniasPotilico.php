<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

use App\Models\Persona;

class CompaniasPotilico implements FromView, WithTitle
{
    
	protected $id_persona;
    
    public function __construct(int $id_persona)
    {
        $this->id_persona = $id_persona;
    }

    public function view(): View
    {
        $compania_presidente = Persona::personasCompaniaPresidente($this->id_persona);
        $compania_gerente = Persona::personasCompaniaGerente($this->id_persona);
        $compania_accionista = Persona::personasCompaniaAccionista($this->id_persona);

    	//dd($compania_presidente,$compania_gerente,$compania_accionista);
        return view('exports.companiaPoliticoExcel', [
            'compania_presidente' => $compania_presidente,
            'compania_gerente' => $compania_gerente,
            'compania_accionista' => $compania_accionista,
        ]);
    }

    public function title(): string
    {
        return 'Superintendecia de Companias';
    }
}
