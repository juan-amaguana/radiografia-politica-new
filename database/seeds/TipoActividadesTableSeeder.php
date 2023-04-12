<?php

use Illuminate\Database\Seeder;
use App\Models\TipoActividad;
use Illuminate\Support\Facades\DB;

class TipoActividadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actividades')->delete(); 
        // Añadimos una entrada a esta tabla
        TipoActividad::create(array('nombre_tipo_actividad' => 'Cargo publico'));
        TipoActividad::create(array('nombre_tipo_actividad' => 'Cargo privado'));
        TipoActividad::create(array('nombre_tipo_actividad' => 'Actividad Politica'));
    }
}
