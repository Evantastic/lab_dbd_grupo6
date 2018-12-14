<?php

use Faker\Generator as Faker;

$factory->define(App\Hotel::class, function (Faker $faker) {
    $ciudades = DB::table('ciudades')->select('id')->get();
    return [
        'ciudad_id' => $ciudades->random()->id,
        'nombre' => $faker->text($maxNbChars = 64),
        'direccion' => $faker->text($maxNbChars = 128),
        'descripcion' => $faker->text($maxNbChars = 512),
        'estrellas' => rand(1,5)
    ];
});
