<?php

use Faker\Generator as Faker;

$factory->define(App\queryLog::class, function (Faker $faker) {

	$users = DB::table('users')->select('id')->get();  
    return [
    	'query'=> $faker->text(), 
      	'user_id'=> $users->random()->id
    ];
});
