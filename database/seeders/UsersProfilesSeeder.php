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
                ['currency' => 'UAH', 'user_id' => 1, 'balance' => 0, 'first_name' => 'Professor', 'last_name' => 'Professor', 'price_lesson' => 1],
                ['currency' => 'RUB', 'user_id' => 2, 'balance' => 200, 'first_name' => 'Данил', 'last_name' => 'Жогов', 'price_lesson' => 100],
                ['currency' => 'UAH', 'user_id' => 3, 'balance' => -200, 'first_name' => 'Богдан', 'last_name' => 'Давид', 'price_lesson' => 240],
                ['currency' => 'RUB', 'user_id' => 4, 'balance' => 100, 'first_name' => 'Марк', 'last_name' => 'Аганбегян', 'price_lesson' => 250],
                ['currency' => 'RUB', 'user_id' => 5, 'balance' => -1000, 'first_name' => 'Sergey', 'last_name' => 'Nikitchenko', 'price_lesson' => 1],
                ['currency' => 'RUB', 'user_id' => 6, 'balance' => -4600, 'first_name' => 'Артем', 'last_name' => 'Шарапов', 'price_lesson' => 150],
                ['currency' => 'RUB', 'user_id' => 7, 'balance' => -3800, 'first_name' => 'Егор', 'last_name' => 'Шарапов', 'price_lesson' => 250],
                ['currency' => 'RUB', 'user_id' => 8, 'balance' => 55, 'first_name' => 'Дарья', 'last_name' => 'Шарапова', 'price_lesson' => 200],
                ['currency' => 'EUR', 'user_id' => 9, 'balance' => 450, 'first_name' => 'Максим', 'last_name' => 'Дімура', 'price_lesson' => 250],
                ['currency' => 'USD', 'user_id' => 10, 'balance' => -488, 'first_name' => 'Максим', 'last_name' => 'Елин', 'price_lesson' => 250],
                ['currency' => 'RUB', 'user_id' => 11, 'balance' => -489, 'first_name' => 'Ангелина', 'last_name' => 'Рожкован', 'price_lesson' => 250],
            ]
        );
    }
}
