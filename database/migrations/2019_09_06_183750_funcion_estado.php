<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FuncionEstado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('funcion_estado', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->boolean('categoria');
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
        //
        Schema::dropIfExists('funcion_estado');
    }
}

// INSERT INTO funcion_estado (nombre, created_at, updated_at, deleted_at) values
// ('Legislativa', '2019-02-19 19:50:00', NULL, NULL),
// ('Ejecutiva', '2019-02-19 19:50:00', NULL, NULL),
// ('Judicial', '2019-02-19 19:50:00', NULL, NULL),
// ('Transparencia y Control Social', '2019-02-19 19:50:00', NULL, NULL),
// ('Electoral', '2019-02-19 19:50:00', NULL, NULL);
