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
        DB::statement('truncate table calendars');
        $regular_lessons = RegularLesson::all();
        $data_regular = [];
        $now_data = Carbon::now();
        $data_endOfYear = Carbon::now()->endOfYear()->addWeeks(-1);
        $temps = 0;
        for ($i = 0; $i < 20; $i++) {
            foreach ($regular_lessons as $item) {
                if ($data_endOfYear->week == $now_data->week + $i) {
                    $temps = $data_endOfYear->week;
                }
                $data_regular[] = ['student_id' => $item->student_id, 'professor_id' => $item->professor_id, 'status' => rand(0, 3), 'year' => $now_data->year, 'day_week' => $item->day_week, 'week' => $now_data->week + $i - $temps, 'fool_time' => '2022-01-05', 'time_start' => $item->time_start, 'length' => $item->length];
            }
        }

        DB::table('calendars')->insert($data_regular);
    }
}
