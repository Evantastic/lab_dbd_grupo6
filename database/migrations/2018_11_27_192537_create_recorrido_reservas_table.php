<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecorridoReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recorrido_reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recorrido_id');
            $table->integer('reserva_id');
            $table->foreign('recorrido_id')->references('id')->on('recorridos');
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->unsignedInteger('costo_economico');
            $table->unsignedInteger('costo_bussiness');
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
        Schema::dropIfExists('recorrido_reservas');
    }
}
