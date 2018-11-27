<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecorridoVuelo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recorrido_vuelo', function (Blueprint $table) {
            $table->integer('recorrido_id');
            $table->integer('vuelo_id');
            $table->foreign('recorrido_id')->references('id')->on('recorridos');
            $table->foreign('vuelo_id')->references('id')->on('vuelos');            
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recorrido_vuelo');        
    }
}
