<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHabitacionReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitacion_reserva', function (Blueprint $table) {
            $table->integer('habitacion_id');
            $table->integer('reserva_id');
            $table->foreign('habitacion_id')->references('id')->on('habitaciones');
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->unsignedInteger('precio');
            $table->date('fecha_inicio');
            $table->date('fecha_termino');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('habitacion_reserva');
    }
}
