<?php

use Illuminate\Database\Seeder;
use App\Paquete_Reserva;

class PaqueteReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Paquete_Reserva::class,50)->create();
    }
}
