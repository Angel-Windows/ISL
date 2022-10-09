<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ReferalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('truncate table referals');
        DB::table('referals')->insert([
            ["user_1" => 1, "user_2"=>2],
            ["user_1" => 1, "user_2"=>4],
            ["user_1" => 1, "user_2"=>6],
            ["user_1" => 1, "user_2"=>7],
            ["user_1" => 1, "user_2"=>8],
            ["user_1" => 1, "user_2"=>9],
            ["user_1" => 1, "user_2"=>10],
            ["user_1" => 1, "user_2"=>11],
            ["user_1" => 1, "user_2"=>12],
        ]);
    }
}
