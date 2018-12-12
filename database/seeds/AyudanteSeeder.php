<?php

use Illuminate\Database\Seeder;
use App\Ayudante;
class AyudanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Ayudante::class,20)->create();
    }
}
