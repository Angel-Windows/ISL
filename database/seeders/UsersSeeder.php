<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('truncate table users');
        DB::table('users')->insert([
                ['email' => 'eliphas.sn@gmail.com', 'password' => Hash::make(1232)],
                ['email' => 'syperdan100@gmail.com', 'password' => Hash::make(1232)],
                ['email' => 'sayler.sn@gmail.com', 'password' => Hash::make(1232)],
                ['email' => 'markaganbegyan@gmail.com', 'password' => Hash::make(1232)],
                ['email' => 'sergey@school.com', 'password' => Hash::make(1232)],
                ['email' => 'artem@school.com', 'password' => Hash::make(1232)],
                ['email' => 'egor@school.com', 'password' => Hash::make(1232)],
                ['email' => 'dsharapovad@gmail.com', 'password' => Hash::make(1232)],
                ['email' => 'maxdimuraelios@gmail.com', 'password' => Hash::make(1232)],
                ['email' => 'max_elin@gmail.com', 'password' => Hash::make(1232)],
                ['email' => 'angelina_rozhkovan@gmail.com', 'password' => Hash::make(1232)],
            ]
        );
    }
}
