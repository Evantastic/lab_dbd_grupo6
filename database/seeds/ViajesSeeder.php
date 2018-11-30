<?php

use Illuminate\Database\Seeder;
use App\Viaje;

class ViajesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Viaje::class,50)->create();
    }
}
