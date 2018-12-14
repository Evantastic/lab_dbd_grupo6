<?php

use Faker\Generator as Faker;

$factory->define(App\Paquete::class, function (Faker $faker) {
    $recorridos = DB::table('recorridos')->select('id')->get();
    $habitaciones = DB::table('habitaciones')->select('id')->get();
    $vehiculos = DB::table('vehiculos')->select('id')->get();    
    return [
        'recorrido_id' => $recorridos->random()->id,
        'habitacion_id' => $habitaciones->random()->id,
        'vehiculo_id' => $vehiculos->random()->id,
        'descuento' => rand(0,100),
        'tipo' => rand(1,3),
        'cantidad_personas' => rand(1,4),
        'fecha_expiracion' => $faker->dateTime
    ];
});
