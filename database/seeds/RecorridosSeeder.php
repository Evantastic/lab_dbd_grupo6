<?php

use Illuminate\Database\Seeder;
use App\Recorrido;

class RecorridosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Recorrido::class,100)->create();
    }
}
