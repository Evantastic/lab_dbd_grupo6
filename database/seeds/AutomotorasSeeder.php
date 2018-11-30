<?php

use Illuminate\Database\Seeder;
use App\Automotora;

class AutomotorasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Automotora::class,50)->create();
    }
}
