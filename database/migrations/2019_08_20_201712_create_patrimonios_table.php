<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatrimoniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patrimonios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_archivo_patrimonio1')->nullable();
            $table->string('nombre_archivo_patrimonio2')->nullable();
            $table->unsignedInteger('numero_casas')->nullable();
            $table->unsignedInteger('numero_carros')->nullable();
            $table->unsignedInteger('dinero')->nullable();
            $table->unsignedInteger('numero_companias')->nullable();
            $table->date('fecha_declaracion')->nullable();
            $table->date('fecha_declaracion_anterior')->nullable();
            $table->decimal('activos', 12, 2)->nullable();
            $table->decimal('pasivos', 12, 2)->nullable();
            $table->decimal('patrimonio', 12, 2)->nullable();
            $table->unsignedBigInteger('perfil_id')->nullable();
            $table->foreign('perfil_id')->references('id')->on('perfiles')->onDelete('SET NULL');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
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
        Schema::dropIfExists('patrimonios');
    }
}
