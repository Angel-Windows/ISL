<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegularLessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('truncate table regular_lessons');
        DB::table('regular_lessons')->insert([
                //Герман Трапицын
                ['student_id' => 2, 'professor_id' => 1, 'day_week' => 6, 'time_start' => '19:00:00', 'length' => 60],
                ['student_id' => 2, 'professor_id' => 1, 'day_week' => 0, 'time_start' => '10:00:00', 'length' => 60],
                //Марк Аганбегян
                ['student_id' => 4, 'professor_id' => 1, 'day_week' => 3, 'time_start' => '18:00:00', 'length' => 60],
                ['student_id' => 4, 'professor_id' => 1, 'day_week' => 6, 'time_start' => '17:00:00', 'length' => 60],
                ['student_id' => 4, 'professor_id' => 1, 'day_week' => 0, 'time_start' => '15:00:00', 'length' => 60],
                //Артем Шарапов
                ['student_id' => 6, 'professor_id' => 1, 'day_week' => 3, 'time_start' => '19:00:00', 'length' => 60],
                ['student_id' => 6, 'professor_id' => 1, 'day_week' => 6, 'time_start' => '18:00:00', 'length' => 60],
                ['student_id' => 6, 'professor_id' => 1, 'day_week' => 0, 'time_start' => '22:00:00', 'length' => 60],
                //Максим Семиполец
                ['student_id' => 7, 'professor_id' => 1, 'day_week' => 1, 'time_start' => '20:00:00', 'length' => 60],
                ['student_id' => 7, 'professor_id' => 1, 'day_week' => 4, 'time_start' => '20:00:00', 'length' => 60],
                //Дарья Шарапова
                ['student_id' => 8, 'professor_id' => 1, 'day_week' => 3, 'time_start' => '20:00:00', 'length' => 60],
                ['student_id' => 8, 'professor_id' => 1, 'day_week' => 0, 'time_start' => '14:00:00', 'length' => 60],
                //Максим Дімура
                ['student_id' => 9, 'professor_id' => 1, 'day_week' => 4, 'time_start' => '19:00:00', 'length' => 60],
                ['student_id' => 9, 'professor_id' => 1, 'day_week' => 6, 'time_start' => '13:00:00', 'length' => 60],
                //Макс Елин
                ['student_id' => 10, 'professor_id' => 1, 'day_week' => 0, 'time_start' => '17:00:00', 'length' => 60],
                //Ангелина Рожкован
                ['student_id' => 11, 'professor_id' => 1, 'day_week' => 0, 'time_start' => '18:00:00', 'length' => 60],
                ['student_id' => 11, 'professor_id' => 1, 'day_week' => 4, 'time_start' => '19:00:00', 'length' => 60],



                //fool_day
                //Ангелина
                ['student_id' => 11, 'professor_id' => 1, 'day_week' => 1, 'time_start' => '17:00:00', 'length' => 60],
                ['student_id' => 11, 'professor_id' => 1, 'day_week' => 2, 'time_start' => '17:00:00', 'length' => 60],
                ['student_id' => 11, 'professor_id' => 1, 'day_week' => 3, 'time_start' => '17:00:00', 'length' => 60],
                ['student_id' => 11, 'professor_id' => 1, 'day_week' => 5, 'time_start' => '17:00:00', 'length' => 60],
                ['student_id' => 11, 'professor_id' => 1, 'day_week' => 6, 'time_start' => '17:00:00', 'length' => 60],
                //Данил
                ['student_id' => 12, 'professor_id' => 1, 'day_week' => 0, 'time_start' => '19:00:00', 'length' => 60],
                ['student_id' => 12, 'professor_id' => 1, 'day_week' => 1, 'time_start' => '19:00:00', 'length' => 60],
                ['student_id' => 12, 'professor_id' => 1, 'day_week' => 2, 'time_start' => '19:00:00', 'length' => 60],
                ['student_id' => 12, 'professor_id' => 1, 'day_week' => 3, 'time_start' => '19:00:00', 'length' => 60],
                ['student_id' => 12, 'professor_id' => 1, 'day_week' => 4, 'time_start' => '19:00:00', 'length' => 60],
                ['student_id' => 12, 'professor_id' => 1, 'day_week' => 5, 'time_start' => '19:00:00', 'length' => 60],
                ['student_id' => 12, 'professor_id' => 1, 'day_week' => 6, 'time_start' => '19:00:00', 'length' => 60],

            ]
        );
    }
}
