<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidaturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_candidatura')->nullable();
            $table->date('fecha_inicio_candidatura')->nullable();
            $table->date('fecha_fin_candidatura')->nullable();
            $table->boolean('candidatura_abierta')->nullable();
            $table->boolean('es_candidatura')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidaturas');
    }
}
