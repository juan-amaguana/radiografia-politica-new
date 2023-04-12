<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PoliticoDetalleExport implements WithMultipleSheets
{
	use Exportable;

	protected $id_persona;
    
    public function __construct(int $id_persona)
    {
        $this->id_persona = $id_persona;
    }

    public function sheets(): array
    {
        $sheets = [];

        $sheets[0] = new DatosPotilico($this->id_persona);
        $sheets[1] = new EstudiosPotilico($this->id_persona);
        $sheets[2] = new SriPotilico($this->id_persona);
        $sheets[3] = new PatrimonioPotilico($this->id_persona);
        $sheets[4] = new CompaniasPotilico($this->id_persona);
        $sheets[5] = new AntecedentesPotilico($this->id_persona);
        $sheets[6] = new ActividadesPotilico($this->id_persona);
 
        return $sheets;
    } 
} 
