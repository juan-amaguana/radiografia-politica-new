<?php

use Illuminate\Database\Seeder;
use App\Models\Estado;
use Illuminate\Support\Facades\DB;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('estados')->delete(); 
        // Añadimos una entrada a esta tabla
        Estado::create(array('nombre_estado' => 'Borrador'));
        Estado::create(array('nombre_estado' => 'En revisión'));
        Estado::create(array('nombre_estado' => 'Publicado'));
    }
}
