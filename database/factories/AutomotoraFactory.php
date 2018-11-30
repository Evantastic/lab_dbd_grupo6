<?php

use Faker\Generator as Faker;

$factory->define(App\Automotora::class, function (Faker $faker) {
    $ciudades = DB::table('ciudades')->select('id')->get();
    return [
        'ciudad_id' => $ciudades->random()->id,
        'direccion' => $faker->streetAddress,
        'nombre' => $faker->company
    ];
});
