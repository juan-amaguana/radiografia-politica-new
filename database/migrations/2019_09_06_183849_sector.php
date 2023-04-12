<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sector extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sector', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
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
        Schema::dropIfExists('sector');
    }
}

// INSERT INTO `sector` (`nombre`, `created_at`, `updated_at`) VALUES
// ('Turismo', '2017-10-20 06:31:19', '2017-10-20 06:31:19'),
// ('Acuícola', '2017-10-20 06:27:39', '2017-10-20 06:27:39'),
// ('Agroindustria', '2017-10-20 06:27:39', '2017-10-20 06:27:39'),
// ('Industria', '2017-10-20 06:27:39', '2017-10-20 06:27:39'),
// ('Transporte', '2017-10-20 06:27:39', '2017-11-24 00:52:59'),
// ('Comercio', '2017-11-23 20:00:00', '2017-11-23 20:00:00');
