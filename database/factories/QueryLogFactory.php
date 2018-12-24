<?php

use Faker\Generator as Faker;

$factory->define(App\queryLog::class, function (Faker $faker) {

	$users = DB::table('users')->select('id')->get();  
    return [
    	
    	'query'=> $faker->text($nbMaxChars = 32), 
      	'user_id'=> $users->random()->id,
      	'fecha_consulta' => $faker->dateTime//
    ];
});
