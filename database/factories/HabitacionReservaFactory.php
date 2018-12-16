<?php

use Faker\Generator as Faker;

$factory->define(App\Habitacion_Reserva::class, function (Faker $faker) {
    $habitaciones = DB::table('habitaciones')->select('id')->get();
    $reservas = DB::table('reservas')->select('id')->get();
    return [
        'habitacion_id' => $habitaciones->random()->id,
        'reserva_id' => $reservas->random()->id,
        'precio' => rand(100,10000),
        'fecha_termino' => $faker->dateTime,
        'fecha_inicio' => $faker->dateTime
    ];
});
