<?php

use Faker\Generator as Faker;

$factory->define(App\Reserva::class, function (Faker $faker) {
    return [
        'costo' => rand(100,10000),
        'seguro' => true
    ];
});
