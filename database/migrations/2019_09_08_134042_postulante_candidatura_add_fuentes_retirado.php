<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostulanteCandidaturaAddFuentesRetirado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('postulante_candidaturas', function (Blueprint $table) {
          $table->string('nombre_fuente_actividad',254)->nullable();
          $table->text('link_fuente_actividad')->nullable();
          $table->boolean('retirado')->nullable();
          $table->date('fecha_retiro')->nullable();
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
