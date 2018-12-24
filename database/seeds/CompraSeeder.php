<?php

use Illuminate\Database\Seeder;
use App\Compra;
class CompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     factory(Compra::class,60)->create();
    }
}
