<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservaVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehiculo_id');
            $table->integer('reserva_id');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->unsignedInteger('precio');
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_termino');
            $table->boolean('es_valido')->default=true;
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
        Schema::dropIfExists('reserva_vehiculos');
    }
}
