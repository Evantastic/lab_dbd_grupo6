<?php

use Faker\Generator as Faker;

$factory->define(App\Hotel::class, function (Faker $faker) {
    $ciudades = DB::table('ciudades')->select('id')->get();
    return [
        'ciudad_id' => $ciudades->random()->id,
        'nombre' => $faker->company,
        'direccion' => $faker->streetAddress,
        'descripcion' => $faker->text($maxNbChars = 500),
        'estrellas' => rand(1,5)
    ];
});
