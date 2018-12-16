<?php

use Faker\Generator as Faker;

$factory->define(App\Reserva_Vehiculo::class, function (Faker $faker) {
    $reservas = DB::table('reservas')->select('id')->get();
    $vehiculos = DB::table('vehiculos')->select('id')->get();
    return [
        'reserva_id' => $reservas->random()->id,
        'vehiculo_id' => $vehiculos->random()->id,
        'precio' => rand(100,10000),
        'fecha_inicio' => $faker->dateTime,
        'fecha_termino' => $faker->dateTime
    ];
});
