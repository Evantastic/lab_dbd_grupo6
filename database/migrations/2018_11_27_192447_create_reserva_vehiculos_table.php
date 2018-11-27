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
        Schema::create('reserva_vehiculo', function (Blueprint $table) {
            $table->integer('vehiculo_id');
            $table->integer('reserva_id');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->unsignedInteger('precio');
            $table->date('fecha_inicio');
            $table->date)'fecha_termino');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserva_vehiculo');
    }
}
