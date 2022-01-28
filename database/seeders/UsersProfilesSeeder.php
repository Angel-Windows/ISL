<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('truncate table users_profiles');
        DB::table('users_profiles')->insert([
                ['currency' => '2', 'user_id' => 1, 'balance' => 0, 'first_name' => 'Сергей', 'last_name' => 'Никитченко', 'price_lesson' => 1],
                ['currency' => '1', 'user_id' => 2, 'balance' => 200, 'first_name' => 'Герман', 'last_name' => 'Трапицын', 'price_lesson' => 100],
                ['currency' => '2', 'user_id' => 3, 'balance' => -200, 'first_name' => '-x-', 'last_name' => '-х-', 'price_lesson' => 240],
                ['currency' => '3', 'user_id' => 4, 'balance' => 100, 'first_name' => 'Марк', 'last_name' => 'Аганбегян', 'price_lesson' => 250],
                ['currency' => '1', 'user_id' => 5, 'balance' => -1000, 'first_name' => 'Admin', 'last_name' => 'Admin', 'price_lesson' => 1],
                ['currency' => '1', 'user_id' => 6, 'balance' => -4600, 'first_name' => 'Артем', 'last_name' => 'Шарапов', 'price_lesson' => 150],
                ['currency' => '3', 'user_id' => 7, 'balance' => -3800, 'first_name' => 'Семиполец', 'last_name' => 'Максим', 'price_lesson' => 250],
                ['currency' => '4', 'user_id' => 8, 'balance' => 55, 'first_name' => 'Дарья', 'last_name' => 'Шарапова', 'price_lesson' => 200],
                ['currency' => '2', 'user_id' => 9, 'balance' => 450, 'first_name' => 'Максим', 'last_name' => 'Дімура', 'price_lesson' => 250],
                ['currency' => '1', 'user_id' => 10, 'balance' => -488, 'first_name' => 'Максим', 'last_name' => 'Елин', 'price_lesson' => 250],
                ['currency' => '4', 'user_id' => 11, 'balance' => -489, 'first_name' => 'Ангелина', 'last_name' => 'Рожкован', 'price_lesson' => 250],
            ]
        );
    }
}
