<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActividadAddDescriptionImportance extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
       //
       Schema::table('actividades', function($table) {
         $table->text('descripcion_corta')->nullable();
         $table->text('descripcion')->nullable();
         $table->boolean('importante')->nullable();
         $table->unsignedBigInteger('compania_id')->nullable();
         $table->foreign('compania_id')->references('id')->on('companias')->onDelete('SET NULL')->nullable();
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
