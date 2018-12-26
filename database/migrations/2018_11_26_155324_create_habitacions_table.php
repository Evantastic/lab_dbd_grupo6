<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHabitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hotel_id');
            $table->foreign('hotel_id')->references('id')->on('hoteles');
            $table->smallInteger('numero_habitacion');
            $table->smallInteger('capacidad');
            $table->text('descripcion');
            $table->unsignedInteger('precio');
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
        Schema::dropIfExists('habitaciones');
    }
}
