<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSumateIniciativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sumate_iniciativas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_aportante');
            $table->string('telefono_aportante');
            $table->string('email_aportante');
            $table->string('archivo_funcionario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sumate_iniciativas');
    }
}
