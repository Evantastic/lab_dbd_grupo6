<?php

use Illuminate\Database\Seeder;
use App\Vuelo;

class VueloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Vuelo::class,50)->create();
    }
}
