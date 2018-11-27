<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaquetesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paquetes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recorrido_id');
            $table->integer('habitacion_id');
            $table->integer('vehiculo_id');
            $table->foreign('recorrido_id')->references('id')->on('recorridos');
            $table->foreign('habitacion_id')->references('id')->on('habitaciones');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->smallInteger('descuento');
            $table->smallInteger('tipo');
            $table->smallInteger('cantidad_personas');
            $table->date('fecha_expiracion');
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
        Schema::dropIfExists('paquetes');
    }
}
