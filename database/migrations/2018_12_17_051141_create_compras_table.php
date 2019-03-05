<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reserva_id');
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('medio_pago');//0 tarjeta de credito // 1 tarjeta de debito // 2 efectivo // 3 cheque
            $table->datetime('fecha_compra');
            $table->boolean('es_valido')->default=true;
            $table->boolean('checkeada')->default=false;
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
        Schema::dropIfExists('compras');
    }
}
