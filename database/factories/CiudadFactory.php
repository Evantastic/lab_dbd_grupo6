<?php

use Faker\Generator as Faker;

$factory->define(App\Ciudad::class, function (Faker $faker) {
    return [
        'nombre' => $faker->text($maxNbChars = 128),
        'nombre_pais' => $faker->text($maxNbChars = 128)
    ];
});
