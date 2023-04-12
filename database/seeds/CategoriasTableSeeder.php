<?php

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->delete();
        // Añadimos una entrada a esta tabla
        Categoria::create(array('nombre_categoria' => 'Legislativo', 'meta_description' => 'mata descripcion legslativo', 'meta_keywords' => 'mata keywords descipcion legislativo', 'slug' => 'Legislativo slug','estado' => '1'));

        Categoria::create(array('nombre_categoria' => 'Judicial', 'meta_description' => 'mata descripcion Judicial', 'meta_keywords' => 'mata keywords descipcion Judicial', 'slug' => 'Judicial slug','estado' => '1'));

        Categoria::create(array('nombre_categoria' => 'Publico', 'meta_description' => 'mata descripcion Publico', 'meta_keywords' => 'mata keywords descipcion Publico', 'slug' => 'Publico slug','estado' => '1'));

        Categoria::create(array('nombre_categoria' => 'Electoral', 'meta_description' => 'mata descripcion Electoral', 'meta_keywords' => 'mata keywords descipcion Electoral', 'slug' => 'Electoral slug','estado' => '1'));

        Categoria::create(array('nombre_categoria' => 'Transparencia', 'meta_description' => 'mata descripcion Transparencia', 'meta_keywords' => 'mata keywords descipcion Transparencia', 'slug' => 'Transparencia slug','estado' => '1'));
        
    }
}
