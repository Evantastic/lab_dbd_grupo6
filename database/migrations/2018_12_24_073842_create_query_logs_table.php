<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queryLogs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('query');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->datetime('fecha_consulta');
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
        Schema::dropIfExists('queryLogs');
    }
}
