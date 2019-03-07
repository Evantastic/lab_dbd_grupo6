<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',128);
            $table->string('apellido',128)->nullable();
            $table->string('nacionalidad',128)->nullable();
            $table->smallInteger('edad')->nullable();
            $table->smallInteger('tipoUsuario')->nullable();
            $table->string('email',128)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',64)->nullable();
            $table->boolean('es_valido')->default=true;

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
