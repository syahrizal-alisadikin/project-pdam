<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'fk_rw_id'      => '001',
            'name'          => 'Izal',
            'email'         => 'admin@gmail.com',
            'password'      => bcrypt('password')
        ]);
    }
}
