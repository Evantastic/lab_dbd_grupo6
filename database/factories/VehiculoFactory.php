<?php

use Faker\Generator as Faker;

$factory->define(App\Vehiculo::class, function (Faker $faker) {
    $automotoras = DB::table('automotoras')->select('id')->get();
    return [
        'automotora_id' => $automotoras->random()->id,
        'marca' => $faker->company,
        'modelo' => $faker->word,
        'tipo'=> $faker->word,
        'patente' => $faker->shuffle('abcd12'),
        'precio' => $faker->randomNumber($nbDigits = NULL, $strict = false),
        'capacidad' => rand(1,6)
    ];
});
