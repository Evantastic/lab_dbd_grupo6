<?php

use Illuminate\Database\Seeder;
use App\Reserva_Vehiculo;

class ReservaVehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Reserva_Vehiculo::class,50)->create();
    }
}
