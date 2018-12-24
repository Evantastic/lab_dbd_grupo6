<?php

use Faker\Generator as Faker;

$factory->define(App\Compra::class, function (Faker $faker) {
	$reservas = DB::table('reservas')->select('id')->get();
	$users = DB::table('users')->select('id')->get();  
    return [
        'fecha_compra' => $faker->dateTime,//
        'reserva_id' => $reservas->random()->id,
        'user_id'=> $users->random()->id
    ];
});
