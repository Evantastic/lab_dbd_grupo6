<?php

use Faker\Generator as Faker;

$factory->define(App\Ayudante::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'ramo' => $faker->company
    ];
});
