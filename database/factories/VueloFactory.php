<?php

use Faker\Generator as Faker;

$factory->define(App\Vuelo::class, function (Faker $faker) {
    $aeropuertos = DB::table('aeropuertos')->select('id')->get();
    $aeropuertoOrigen = $aeropuertos->random()->id;
    $aeropuertoDestino = $aeropuertos->random()->id;
    while($aeropuertoDestino == $aeropuertoOrigen){
        $aeropuertoDestino = $aeropuertos->random()->id;
    }
    return [
        'aeropuerto_origen_id' => $aeropuertoOrigen,
        'aeropuerto_destino_id' => $aeropuertoDestino,
        'capacidad_economica' => rand(50,100),
        'capacidad_bussiness' => rand(50,100),
        'capacidad_discapacidad_economica' => rand(5,15),
        'capacidad_discapacidad_bussiness' => rand(5,15),
        'tiempo_salida' => $faker->dateTime,
        'tiempo_llegada' => $faker->dateTime,
        'patente' => $faker->text($maxNbChars = 16)
    ];
});
