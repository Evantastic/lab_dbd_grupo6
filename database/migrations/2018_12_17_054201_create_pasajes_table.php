<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasajes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reserva_id');
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->integer('vuelo_id');
            $table->foreign('vuelo_id')->references('id')->on('vuelos');
            $table->char('fila');
            $table->integer('columna');
            $table->boolean('pasaje_simple');
            $table->boolean('asiento_bussiness');
            $table->boolean('asiento_discapacidad');
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
        Schema::dropIfExists('pasajes');
    }
}
