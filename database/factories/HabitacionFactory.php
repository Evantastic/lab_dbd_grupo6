<?php

use Faker\Generator as Faker;

$factory->define(App\Habitacion::class, function (Faker $faker) {
    $hoteles = DB::table('hoteles')->select('id')->get();
    return [
        'hotel_id' => $hoteles->random()->id;
        'numero_habitacion' =Z $faker->randomDigitNotNull;
        'capacidad' => rand(1,6);
        'descripcion' => $faker->text($maxNbChars = 500);
        'precio' => $faker->randomNumber($nbDigits = NULL, $strict = false);
    ];
});
