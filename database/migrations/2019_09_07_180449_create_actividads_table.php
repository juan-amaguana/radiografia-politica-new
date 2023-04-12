<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_fuente_actividad',254)->nullable();
            $table->text('link_fuente_actividad')->nullable();
            $table->date('fecha_inicio_actividad')->nullable();
            $table->date('fecha_fin_actividad')->nullable();
            $table->boolean('posicion_actual')->nullable();
            $table->strig('url_legislativo')->nullable();
            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
            $table->unsignedBigInteger('tipo_actividad_id')->nullable();
            $table->foreign('tipo_actividad_id')->references('id')->on('tipo_actividades')->onDelete('SET NULL');
            $table->unsignedBigInteger('posicion_id')->nullable();
            $table->foreign('posicion_id')->references('id')->on('posiciones')->onDelete('SET NULL');
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
        Schema::dropIfExists('actividades');
    }
}
