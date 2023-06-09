<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        /*$this->call(RolesTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CategoriasTableSeeder::class);
        $this->call(CategoriaTipoEmpresaTableSeeder::class);
        $this->call(TipoActividadesTableSeeder::class);*/
        //$this->call(EstudioAreasTableSeeder::class);
        $this->call(UserFcdTableSeeder::class);
        Model::reguard();
    }
}
