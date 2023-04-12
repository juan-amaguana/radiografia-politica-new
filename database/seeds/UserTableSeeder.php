<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        User::create(array('name' => 'Daniel Naula Guiñan' ,'email' => 'jesus1494@hotmail.es','password' => Hash::make('admin123456789'),'role_id' =>1));
        
    }
} 
