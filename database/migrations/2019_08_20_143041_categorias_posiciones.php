<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoriasPosiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias_posiciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('posiciones_id');
            $table->unsignedBigInteger('categorias_id');
            
            $table->timestamps();

            $table->foreign('posiciones_id')->references('id')->on('posiciones')->onDelete('cascade');
            $table->foreign('categorias_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias_posiciones');
    }
}
