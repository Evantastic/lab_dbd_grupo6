<?php

use Illuminate\Database\Seeder;
use App\queryLog;

class queryLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(queryLog::class,60)->create();
    }
}
