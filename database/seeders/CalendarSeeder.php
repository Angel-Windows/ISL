<?php

namespace Database\Seeders;

use App\Models\RegularLesson;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temp_data = 0;
        DB::statement('truncate table calendars');
        $regular_lessons = RegularLesson::all();
        $data_regular = [];
        for ($i = 0; $i < 20; $i++) {
            foreach ($regular_lessons as $item) {
                $now_data = Carbon::now();
                $now_data->startOfWeek();
                $now_data->addDays($item->day_week - 1);
                $now_data->addWeeks($i);
                $data_regular[] = [
                    'student_id' => $item->student_id,
                    'professor_id' => $item->professor_id,
                    'status' => rand(0, 3), 'year' => $now_data->year,
                    'day_week' => $item->day_week,
                    'week' => $now_data->week,
                    'fool_time' => $now_data->format('Y-m-d'),
                    'time_start' => $item->time_start,
                    'length' => $item->length,
                ];
            }
            $temp_data++;
        }
        DB::table('calendars')->insert($data_regular);
    }
}
