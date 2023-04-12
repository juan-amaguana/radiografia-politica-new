<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministracionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administraciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('mision');
            $table->text('vision')->nullable();
            $table->string('imagen1');
            $table->string('imagen2'); 
            $table->string('imagen3');
            $table->string('logo_movil');
            $table->string('logo_web');
            $table->text('descripcion_logo_movil');
            $table->text('descripcion_logo_web');
            $table->string('key_word');
            $table->string('email');
            $table->string('telefono');
            $table->text('direccion');
            $table->text('licencia');
            $table->string('email_contacto_datos_abiertos');
            $table->string('autor_datos_abiertos');
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
        Schema::dropIfExists('administraciones');
    }
}
