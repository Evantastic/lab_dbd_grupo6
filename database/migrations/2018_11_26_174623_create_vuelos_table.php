<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVuelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vuelos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aeropuerto_origen_id');
            $table->integer('aeropuerto_destino_id');
            $table->foreign('aeropuerto_origen_id')->references('id')->on('aeropuertos');
            $table->foreign('aeropuerto_destino_id')->references('id')->on('aeropuertos');            
            $table->smallInteger('capacidad_economica');
            $table->smallInteger('capacidad_business');
            $table->smallInteger('capacidad_discapacidad_bussiness');
            $table->smallInteger('capacidad_discapacidad_economica');
            $table->datetime('tiempo_salida');
            $table->datetime('tiempo_llegada');
            $table->string('patente',16);
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
        Schema::dropIfExists('vuelos');
    }
}
