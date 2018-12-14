<?php

use Faker\Generator as Faker;

$factory->define(App\Aeropuerto::class, function (Faker $faker) {
    $ciudades = DB::table('ciudades')->select('id')->get();
    return [
        'ciudad_id' => $ciudades->random()->id,
        'direccion' => $faker->text($maxNbChars = 128),
        'nombre' => $faker->text($maxNbChars = 64)
    ];
});
