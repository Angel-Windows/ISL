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
                ['currency' => '2', 'user_id' => 1,  'balance' => 0, 'name' => 'Сергей Никитченко', 'price_lesson' => 1],
                ['currency' => '1', 'user_id' => 2,  'balance' => -18440, 'name' => 'Герман Трапицын', 'price_lesson' => 700],
                ['currency' => '2', 'user_id' => 3,  'balance' => -1200.00, 'name' => '-x- х-', 'price_lesson' => 700],
                ['currency' => '3', 'user_id' => 4,  'balance' => -19420, 'name' => 'Марк Аганбегян', 'price_lesson' => 700],
                ['currency' => '1', 'user_id' => 5,  'balance' => 0, 'name' => 'Admin Admin', 'price_lesson' => 1],
                ['currency' => '1', 'user_id' => 6,  'balance' => -22200, 'name' => 'Артем Шарапов', 'price_lesson' => 600],
                ['currency' => '3', 'user_id' => 7,  'balance' => -1500.00, 'name' => 'Семиполец Максим', 'price_lesson' => 250],
                ['currency' => '4', 'user_id' => 8,  'balance' => 0, 'name' => 'Дарья Шарапова', 'price_lesson' => 600],
                ['currency' => '2', 'user_id' => 9,  'balance' => 24, 'name' => 'Максим Дімура', 'price_lesson' => 8],
                ['currency' => '1', 'user_id' => 10, 'balance' => 250, 'name' => 'Максим Елин', 'price_lesson' => 700],
                ['currency' => '4', 'user_id' => 11, 'balance' => 0, 'name' => 'Ангелина Рожкован', 'price_lesson' => 700],
                ['currency' => '4', 'user_id' => 12, 'balance' => 0, 'name' => 'Данил Жогов', 'price_lesson' => 100],
                ['currency' => '2', 'user_id' => 12, 'balance' => -250, 'name' => 'Дима Онуфриев', 'price_lesson' => 250],
                ['currency' => '2', 'user_id' => 12, 'balance' => 1105, 'name' => 'Костя Вегреновский', 'price_lesson' => 180],
            ]
        );
    }
}
