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
            $table->unsignedBigInteger('automotora_id');
            $table->foreign('automotora_id')->references('id')->on('automoras');
            $table->string('marca',31);
            $table->string('modelo',31);
            $table->string('tipo',31);
            $table->string('patente',15);
            $table->unsignedSmallInteger('precio');
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
