<?php

use Illuminate\Database\Seeder;
use App\Recorrido_Vuelo;

class RecorridoVueloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Recorrido_Vuelo::class,200)->create();
    }
}
