<?php

use Illuminate\Database\Seeder;
use App\Paquete;

class PaqueteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Paquete::class,50)->create();
    }
}
