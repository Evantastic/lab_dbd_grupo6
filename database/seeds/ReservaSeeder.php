<?php

use Illuminate\Database\Seeder;
use App\Reserva;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Reserva::class,100)->create();
    }
}
