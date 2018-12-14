<?php

use Faker\Generator as Faker;

$factory->define(App\Vehiculo::class, function (Faker $faker) {
    $automotoras = DB::table('automotoras')->select('id')->get();
    return [
        'automotora_id' => $automotoras->random()->id,
        'marca' => $faker->text($maxNbChars = 32),
        'modelo' => $faker->text($maxNbChars = 32),
        'tipo'=> $faker->text($maxNbChars = 32),
        'patente' => $faker->text($maxNbChars = 16),
        'precio' => $faker->randomNumber($nbDigits = NULL, $strict = false),
        'capacidad' => rand(1,6)
    ];
});
