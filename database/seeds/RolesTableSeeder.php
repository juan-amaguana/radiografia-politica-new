<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete(); 
        // Añadimos una entrada a esta tabla
        Role::create(array('nombre_role' => 'Admin'));
    } 
}
