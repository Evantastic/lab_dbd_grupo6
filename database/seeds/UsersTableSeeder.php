<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'apellido' => 'admin',
            'nacionalidad' => 'admin',
            'edad' => 21,
            'tipoUsuario' => 1,
            'email' => 'admin@admin.cl',
            'password' => bcrypt('admin'),
            'is_admin' => '1'
        ]);
       factory(User::class,100)->create(); //
    }
}
