<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostulanteCandidaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postulante_candidaturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('gano_candidatura')->nullable();
            $table->unsignedBigInteger('candidatura_id')->nullable();
            $table->foreign('candidatura_id')->references('id')->on('candidaturas')->onDelete('cascade');
            $table->unsignedBigInteger('persona_id')->nullable();
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
            $table->integer('partido_politico_id')->unsigned()->index()->nullable();
            $table->foreign('partido_politico_id')->references('id')->on('partidos_politicos')->onDelete('SET NULL');
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
        Schema::dropIfExists('postulante_candidaturas');
    }
}
