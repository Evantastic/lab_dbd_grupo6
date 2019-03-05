<?php

use Faker\Generator as Faker;

$factory->define(App\Recorrido::class, function (Faker $faker) {
    $viajes = DB::table('viajes')->select('id')->get();
    return [
        'costo_economico' => rand(500,3000),
        'costo_bussiness' => rand(2000,5000),
        'viaje_id' => $viajes->random()->id
    ];
});
