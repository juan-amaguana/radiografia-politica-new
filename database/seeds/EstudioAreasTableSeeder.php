<?php

use Illuminate\Database\Seeder;
use App\Models\EstudioArea;
use Illuminate\Support\Facades\DB;

class EstudioAreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('estudio_areas')->delete(); 

        EstudioArea::create(array('nombre_estudio_area' => 'Educación', 'descripcion_estudio_area' => 'Profesiones de educación'));
        EstudioArea::create(array('nombre_estudio_area' => 'Humanidades y artes', 'descripcion_estudio_area' => 'Profesiones de humanidades y artes'));
        EstudioArea::create(array('nombre_estudio_area' => 'Ciencias sociales', 'descripcion_estudio_area' => 'Profesiones ciencias sociales'));
        EstudioArea::create(array('nombre_estudio_area' => 'Educación comercial y derecho', 'descripcion_estudio_area' => 'Profesiones hducación comercial y derecho'));
        EstudioArea::create(array('nombre_estudio_area' => 'Ciencias', 'descripcion_estudio_area' => 'Profesiones de Ciencias'));
        EstudioArea::create(array('nombre_estudio_area' => 'Ingeniería, industria y construcción', 'descripcion_estudio_area' => 'Profesiones ingeniería, industria y construcción'));
        EstudioArea::create(array('nombre_estudio_area' => 'Agricultura', 'descripcion_estudio_area' => 'Profesiones de agricultura'));
        EstudioArea::create(array('nombre_estudio_area' => 'Salud y servicios sociales', 'descripcion_estudio_area' => 'Profeciones de salud y servicios sociales'));
        EstudioArea::create(array('nombre_estudio_area' => 'Servicios', 'descripcion_estudio_area' => 'Profesiones de servicios'));
        EstudioArea::create(array('nombre_estudio_area' => 'Otros', 'descripcion_estudio_area' => 'otros'));
       
    }
}
