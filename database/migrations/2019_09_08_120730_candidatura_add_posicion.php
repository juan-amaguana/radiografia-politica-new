<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CandidaturaAddPosicion extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::table('candidaturas', function (Blueprint $table) {
        $table->unsignedBigInteger('posicion_id')->nullable();
        $table->foreign('posicion_id')->references('id')->on('posiciones')->onDelete('SET NULL');
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
