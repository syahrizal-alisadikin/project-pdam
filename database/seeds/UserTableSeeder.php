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
        for ($i=0; $i < 100000 ; $i++) { 
            $userData[] = [
                    'fk_rw_id'      => '001',
                    'name'          => Str::random(10),
                    'email'         => Str::random(10).'@gmail.com',
                    'password'      => bcrypt('password')
                ]);
            ];
        }

        $chunk = array_chunk($userData, 5000);
        
        foreach ($chunk as $key) {
            User::insert($key);
        }
    }
}
