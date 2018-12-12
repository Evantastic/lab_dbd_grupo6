<?php

use Faker\Generator as Faker;

$factory->define(App\Ayudados::class, function (Faker $faker) {
    $ayudantes = DB::table('ayudantes')->select('id')->get();
    return [
        'nombre' => $faker->name,
        'ayudante_id' => $ayudantes->random()->id
    ];
});
