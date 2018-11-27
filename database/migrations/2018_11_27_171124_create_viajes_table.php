<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viajes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('ciudad_origen_id');
            $table->unsignedBigInteger('ciudad_destino_id');
            $table->foreign('ciudad_origen_id')->references('id')->on('ciudades');
            $table->foreign('ciudad_destino_id')->references('id')->on('ciudades');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('viajes');
    }
}
