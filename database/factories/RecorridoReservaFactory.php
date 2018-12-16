<?php

use Faker\Generator as Faker;

$factory->define(App\Recorrido_Reserva::class, function (Faker $faker) {
    $recorridos = DB::table('recorridos')->select('id')->get();
    $reservas = DB::table('reservas')->select('id')->get();
    return [
        'recorrido_id' => $recorridos->random()->id,
        'reserva_id' => $reservas->random()->id,
        'costo_economico' => rand(100,10000),
        'costo_bussiness' => rand(100,10000)
    ];
});
