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
            $table->unsignedBigInteger('aeropuerto_origen_id');
            $table->unsignedBigInteger('aeropuerto_detino_id');
            $table->foreign('aeropuerto_origen_id')->references('id')->on('aeropuertos');
            $table->foreign('aeropuerto_destino_id')->references('id')->on('aeropuertos');            
            $table->smallInteger('capacidad_economica');
            $table->smallInteger('capacidad_business');
            $table->smallInteger('capacidad_discapacidad_business');
            $table->smallInteger('capacidad_discapacidad_economica');
            $table->date('fecha_salida');
            $table->date('fecha_llegada');
            $table->time('hora_salida');
            $table->time('hora_llegada');
            $table->string('patente');
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
