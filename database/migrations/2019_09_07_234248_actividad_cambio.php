<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActividadCambio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         //
         Schema::table('actividades', function($table) {
             $table->unsignedBigInteger('sector_id')->nullable();
             $table->integer('provincia_id')->nullable();
             $table->integer('canton_id')->nullable();
             $table->integer('parroquia_id')->nullable();
             $table->foreign('sector_id')->references('id')->on('sector')->onDelete('SET NULL')->nullable();
             $table->foreign('provincia_id')->references('id')->on('provincia')->onDelete('SET NULL')->nullable();
             $table->foreign('canton_id')->references('id')->on('canton')->onDelete('SET NULL')->nullable();
             $table->foreign('parroquia_id')->references('id')->on('parroquia')->onDelete('SET NULL')->nullable();

         });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
