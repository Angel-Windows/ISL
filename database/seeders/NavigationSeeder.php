<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('truncate table navigations');
        DB::table('navigations')->insert([
                ['group'=> 0,'name'=> 'Главная', 'link' => 'home', 'icon' => 'fas fa-home', 'sort' => 10],
                ['group'=> 1,'name'=> 'Календарь', 'link' => 'calendar', 'icon' => 'far fa-calendar-alt', 'sort' => 20],
                ['group'=> 0,'name'=> 'Прогресс', 'link' => 'progress', 'icon' => 'far fa-list-alt', 'sort' => 30],
                ['group'=> 3,'name'=> 'Админ', 'link' => 'admin', 'icon' => 'fas fa-laptop-house', 'sort' => 40],
            ]
        );
    }
}
