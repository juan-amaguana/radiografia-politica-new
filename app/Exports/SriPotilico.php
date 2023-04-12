<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

use App\Models\Persona;

class SriPotilico implements FromView, WithTitle
{
    
	protected $id_persona;
    
    public function __construct(int $id_persona)
    {
        $this->id_persona = $id_persona;
    }

    public function view(): View
    {
        $sri_divisas = Persona::sri_divisasDetalle($this->id_persona);
        $sri_rentas = Persona::sri_rentaDetalle($this->id_persona);

    	//dd($sri_divisas,$sri_rentas);
        return view('exports.sriPoliticoExcel', [
            'sri_rentas' => $sri_rentas,
            'sri_divisas' => $sri_divisas,
        ]);
    }

    public function title(): string
    {
        return 'SRI impuestos';
    }
}
