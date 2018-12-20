<?php

use Illuminate\Database\Seeder;
use App\Pasaje;
class PasajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(Pasaje::class,60)->create(); //
    }
}
