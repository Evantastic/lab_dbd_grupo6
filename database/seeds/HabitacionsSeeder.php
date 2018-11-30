<?php

use Illuminate\Database\Seeder;
use App\Habitacion;

class HabitacionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Habitacion::class,30)->create();
    }
}
