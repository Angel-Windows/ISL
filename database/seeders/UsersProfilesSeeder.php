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
                ['currency' => '2', 'user_id' => 1, 'balance' => 0, 'name' => 'Сергей Никитченко', 'price_lesson' => 1],
                ['currency' => '1', 'user_id' => 2, 'balance' => 200, 'name' => 'Герман Трапицын', 'price_lesson' => 100],
                ['currency' => '2', 'user_id' => 3, 'balance' => -200, 'name' => '-x- х-', 'price_lesson' => 240],
                ['currency' => '3', 'user_id' => 4, 'balance' => 100, 'name' => 'Марк Аганбегян', 'price_lesson' => 250],
                ['currency' => '1', 'user_id' => 5, 'balance' => -1000, 'name' => 'Admin Admin', 'price_lesson' => 1],
                ['currency' => '1', 'user_id' => 6, 'balance' => -4600, 'name' => 'Артем Шарапов', 'price_lesson' => 150],
                ['currency' => '3', 'user_id' => 7, 'balance' => -3800, 'name' => 'Семиполец Максим', 'price_lesson' => 250],
                ['currency' => '4', 'user_id' => 8, 'balance' => 55, 'name' => 'Дарья Шарапова', 'price_lesson' => 200],
                ['currency' => '2', 'user_id' => 9, 'balance' => 450, 'name' => 'Максим Дімура', 'price_lesson' => 250],
                ['currency' => '1', 'user_id' => 10, 'balance' => -488, 'name' => 'Максим Елин', 'price_lesson' => 250],
                ['currency' => '4', 'user_id' => 11, 'balance' => -489, 'name' => 'Ангелина Рожкован', 'price_lesson' => 250],
                ['currency' => '4', 'user_id' => 12, 'balance' => 200, 'name' => 'Данил Жогов', 'price_lesson' => 100],
            ]
        );
    }
}
