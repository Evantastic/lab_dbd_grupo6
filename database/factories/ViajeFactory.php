<?php

use Faker\Generator as Faker;

$factory->define(App\Viaje::class, function (Faker $faker) {
    $ciudades = DB::table('ciudades')->select('id')->get();
    $ciudadOrigen = $ciudades->random()->id;
    $ciudadDestino = $ciudades->random()->id;
    while($ciudadDestino == $ciudadOrigen){
        $ciudadDestino = $ciudades->random()->id;
    }
    return [
        'ciudad_origen_id' => $ciudadOrigen,
        'ciudad_destino_id' => $ciudadDestino
    ];
});
