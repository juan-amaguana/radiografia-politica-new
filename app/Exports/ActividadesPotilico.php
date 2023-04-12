<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

use App\Models\Persona;

class ActividadesPotilico implements FromView, WithTitle
{
    
	protected $id_persona;
    
    public function __construct(int $id_persona)
    {
        $this->id_persona = $id_persona;
    }

    public function view(): View
    {
        $actividades_publica = Persona::personasActividadPublica($this->id_persona);
        $actividades_privada = Persona::personasActividadPrivada($this->id_persona);
        $actividades_politica = Persona::personasActividadPolitica($this->id_persona);

    	//dd($actividades_publica, $actividades_privada,$actividades_politica);
        return view('exports.timelinePoliticoExcel', [
            'actividades_publica' => $actividades_publica,
            'actividades_privada' => $actividades_privada,
            'actividades_politica' => $actividades_politica,
        ]);
    }

    public function title(): string
    {
        return 'Timeline';
    }
}
