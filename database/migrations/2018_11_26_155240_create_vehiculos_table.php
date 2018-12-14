<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('automotora_id');
            $table->foreign('automotora_id')->references('id')->on('automotoras');
            $table->string('marca',32);
            $table->string('modelo',32);
            $table->string('tipo',32);
            $table->string('patente',16);
            $table->unsignedInteger('precio');
            $table->smallInteger('capacidad');
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
        Schema::dropIfExists('vehiculos');
    }
}
