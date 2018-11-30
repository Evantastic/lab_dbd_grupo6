<?php

use Faker\Generator as Faker;

$factory->define(App\Recorrido::class, function (Faker $faker) {
    return [
        'costo_economico' => rand(500,3000),
        'costo_bussiness' => rand(2000,5000)
    ];
});
