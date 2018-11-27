<?php

use Illuminate\Database\Seeder;
use App\Ciudad;

class CiudadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Ciudad::class,4)->create();
    }
}
