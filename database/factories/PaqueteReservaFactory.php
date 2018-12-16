<?php

use Faker\Generator as Faker;

$factory->define(App\Paquete_Reserva::class, function (Faker $faker) {
    $paquetes = DB::table('paquetes')->select('id')->get();
    $reservas = DB::table('reservas')->select('id')->get();
    return [
        'paquete_id' => $paquetes->random()->id,
        'reserva_id' => $reservas->random()->id,
        'descuento' => rand(0,100)
    ];
});
