<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSrisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sris', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('anio_sri');
            $table->boolean('tipo_impuesto_sri');
            $table->integer('valor_impuesto_sri');
            $table->boolean('declaracion')->nullable()->comment = "1: Sin declaracion; 2: Con declaracion";
            $table->unsignedBigInteger('perfil_id')->nullable();
            $table->foreign('perfil_id')->references('id')->on('perfiles')->onDelete('SET NULL');
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
        Schema::dropIfExists('sris');
    }
}
