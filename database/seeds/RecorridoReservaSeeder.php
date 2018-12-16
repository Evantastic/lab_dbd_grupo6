<?php

use Illuminate\Database\Seeder;
use App\Recorrido_Reserva;

class RecorridoReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Recorrido_Reserva::class,50)->create();
    }
}
