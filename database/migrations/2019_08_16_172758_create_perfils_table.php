<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration; 

class CreatePerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url_sri')->nullable();
            $table->string('url_patrimonio')->nullable();
            $table->string('url_compania')->nullable();
            $table->string('url_judicial')->nullable();
            $table->string('url_penal')->nullable();
            $table->string('url_estudio')->nullable();
            $table->string('url_contraloria')->nullable();
            $table->string('url_perfil')->nullable();
            $table->boolean('antecedentes_penales');
            $table->string('nombre_archivo_sri')->nullable();
            $table->string('nombre_archivo_patrimonio')->nullable();
            $table->string('nombre_archivo_compania')->nullable();
            $table->string('nombre_archivo_judicial')->nullable();
            $table->string('nombre_archivo_penal')->nullable();
            $table->string('nombre_archivo_estudio')->nullable();
            $table->string('nombre_archivo_Contralor')->nullable();
            $table->string('picture')->nullable();
            $table->unsignedBigInteger('persona_id')->nullable();
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('perfiles');
    }
}
