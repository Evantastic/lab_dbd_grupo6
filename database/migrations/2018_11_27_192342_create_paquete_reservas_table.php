<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaqueteReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paquete_reserva', function (Blueprint $table) {
            $table->integer('paquete_id');
            $table->integer('reserva_id');
            $table->foreign('paquete_id')->references('id')->on('paquetes');
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->unsignedInteger('descuento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paquete_reserva');
    }
}
