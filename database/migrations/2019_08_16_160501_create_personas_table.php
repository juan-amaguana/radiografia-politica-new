<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration; 

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('imagen_persona');
            $table->string('nombres_persona');
            $table->string('apellidos_persona');
            $table->boolean('genero_persona');
            $table->date('fecha_nacimiento');
            $table->text('descripcion_corta_persona');
            $table->text('descripcion_persona');
            $table->text('plan_persona');
            $table->string('twitter_persona')->nullable();
            $table->string('facebook_persona')->nullable();
            $table->string('observatorio_persona');
            $table->string('curriculum_persona');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('estado_id')->nullable();
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('SET NULL');
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
        Schema::dropIfExists('personas');
    }
}
