<?php

use Illuminate\Database\Seeder;
use App\Vehiculo;

class VehiculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Vehiculo::class,50)->create();
    }
}
