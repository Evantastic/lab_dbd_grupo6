<?php

use Faker\Generator as Faker;

$factory->define(App\Recorrido_Vuelo::class, function (Faker $faker) {
    $recorridos = DB::table('recorridos')->select('id')->get();
    $vuelos = DB::table('vuelos')->select('id')->get();
    return [
        'recorrido_id' => $recorridos->random()->id,
        'vuelo_id' => $vuelos->random()->id
    ];
});
