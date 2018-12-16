<?php

use Illuminate\Database\Seeder;
use App\Habitacion_Reserva;

class HabitacionReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Habitacion_Reserva::class,50)->create();
    }
}
