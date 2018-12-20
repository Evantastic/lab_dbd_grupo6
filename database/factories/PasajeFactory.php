<?php

use Faker\Generator as Faker;

$factory->define(App\Pasaje::class, function (Faker $faker) {
    
    $reservas = DB::table('reservas')->select('id')->get();
	$vuelos = DB::table('vuelos')->select('id')->get();  
	return [
		'fila'=>$faker->randomLetter,
        'columna' => $faker->numberBetween(1,100),
        'pasaje_simple'=>$faker->boolean,
        'asiento_bussiness'=>$faker->boolean,
        'asiento_discapacidad'=>$faker->boolean,
        'reserva_id' => $reservas->random()->id,
        'vuelo_id'=> $vuelos->random()->id
    ];
  
});
