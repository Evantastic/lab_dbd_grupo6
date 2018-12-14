<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecorridoVuelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recorrido_vuelos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recorrido_id');
            $table->integer('vuelo_id');
            $table->foreign('recorrido_id')
                ->references('id')
                ->on('recorridos');
            $table->foreign('vuelo_id')
                ->references('id')
                ->on('vuelos');
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
        Schema::dropIfExists('recorrido_vuelos');
    }
}
