<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PosicionModification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('posiciones', function($table) {
          $table->unsignedBigInteger('funcion_estado_id')->nullable();
          $table->unsignedBigInteger('institucion_id')->nullable();
          $table->foreign('funcion_estado_id')->references('id')->on('funcion_estado')->onDelete('SET NULL')->nullable();
          $table->foreign('institucion_id')->references('id')->on('institucion')->onDelete('SET NULL')->nullable();
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
