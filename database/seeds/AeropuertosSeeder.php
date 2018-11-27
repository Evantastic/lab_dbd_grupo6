<?php

use Illuminate\Database\Seeder;
use App\Aeropuerto;

class AeropuertosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Aeropuerto::class,10)->create();
    }
}
