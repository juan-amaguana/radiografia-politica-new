<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;

class UserFcdTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->truncate();
        User::create(array('name' => 'Anticorrupción' ,'email' => 'anticorrupcion@ciudadaniaydesarrollo.org','password' => Hash::make('Anadmin5362'),'role_id' =>1));

        User::create(array('name' => 'Investigación' ,'email' => 'investigacion2@ciudadaniaydesarrollo.org','password' => Hash::make('Inadmin9721'),'role_id' =>1));


        User::create(array('name' => 'Cponce' ,'email' => 'cponce@ciudadaniaydesarrollo.org','password' => Hash::make('Ceadmin7299'),'role_id' =>1));


        User::create(array('name' => 'Investigación4' ,'email' => 'investigacion4@ciudadaniaydesarrollo.org','password' => Hash::make('I4admin7721'),'role_id' =>1));
        
        User::create(array('name' => 'Legislativo' ,'email' => 'legislativo@ciudadaniaydesarrollo.org','password' => Hash::make('Loadmin8112'),'role_id' =>1));
        
        User::create(array('name' => 'Justicia' ,'email' => 'justicia@ciudadaniaydesarrollo.org','password' => Hash::make('Jaadmin3547'),'role_id' =>1));
        
        User::create(array('name' => 'Asistente Comunicación' ,'email' => 'asistente.comunicacion@ciudadaniaydesarrollo.org','password' => Hash::make('Aeadmin8822'),'role_id' =>1));
        
        User::create(array('name' => 'Investigación1' ,'email' => 'investigacion1@ciudadaniaydesarrollo.org','password' => Hash::make('I1admin8053'),'role_id' =>1));
        
        User::create(array('name' => 'Mauricio Alarcon' ,'email' => 'malarcon@ciudadaniaydesarrollo.org','password' => Hash::make('Mnadmin1790'),'role_id' =>1));
        
        User::create(array('name' => 'Marcelo Espinel' ,'email' => 'mespinel@ciudadaniaydesarrollo.org','password' => Hash::make('Moadmin5382'),'role_id' =>1));
    }
}

