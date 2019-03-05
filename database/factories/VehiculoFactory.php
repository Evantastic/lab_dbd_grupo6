<?php

use Faker\Generator as Faker;

$factory->define(App\Vehiculo::class, function (Faker $faker) {
    $automotoras = DB::table('automotoras')->select('id')->get();
    return [
        'automotora_id' => $automotoras->random()->id,
        'marca' => $faker->company,
        'modelo' => $faker->lastName,
        'tipo'=> $faker->text($maxNbChars = 32),
        'patente' => $faker->text($maxNbChars = 10),
        'precio' => $faker->randomNumber($nbDigits = 3, $strict = false),
        'capacidad' => rand(2,6)
    ];
});
