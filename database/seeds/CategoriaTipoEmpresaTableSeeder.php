<?php

use Illuminate\Database\Seeder;
use App\Models\CategoriaTipoEmpresa;
use Illuminate\Support\Facades\DB;

class CategoriaTipoEmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria_tipo_empresas')->delete();
        // Añadimos una entrada a esta tabla
        CategoriaTipoEmpresa::create(array('nombre_categoria_tipo_empresa' => 'Empresa Publica','descripcion_categoria_tipo_empresa' => 'descripcion Empresa Publica'));
        CategoriaTipoEmpresa::create(array('nombre_categoria_tipo_empresa' => 'Empresa Privada','descripcion_categoria_tipo_empresa' => 'descripcion Empresa Privada'));
        
    }
}
