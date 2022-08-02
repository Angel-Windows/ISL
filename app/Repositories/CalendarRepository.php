<?php

namespace App\Repositories;

use App\Models\Calendar;
use App\Models\RegularLesson;
use Carbon\Carbon;
use \Auth;
use Illuminate\Database\Eloquent\Model;

class CalendarRepository extends BaseRepository
{
    public function transaction_add()
    {
        return 23;
    }

    public function fill_regular_transaction($student_id, $professor_id, $date, $time, $length, $is_regular = false)
    {
        $temp_data = 0;
        $naw = Carbon::createFromFormat("Y-m-d", $date);
        $day_week = $naw->dayOfWeek;
        $count_for = 1;
        if($is_regular){
            $regular_lessons_count = RegularLesson::where('student_id', $student_id)
                ->where('day_week', $day_week)
                ->where('time_start', $time)
                ->count();
            if ($regular_lessons_count){
                $regular_lessons = new RegularLesson();
                $regular_lessons->student_id = $student_id;
                $regular_lessons->professor_id = $professor_id;
                $regular_lessons->time_start = $time;
                $regular_lessons->day_week = $day_week;
                $regular_lessons->length = $length;
                $regular_lessons->status = 1;
                $regular_lessons->save();
                $count_for = 20;
            }
        }


        $data_item = [];
        for ($i = 0; $i < $count_for; $i++) {
            $calendar = new Calendar();
            $now_data = Carbon::now();
            $now_data->startOfWeek();
            $now_data->addDays($day_week - 1);
            $now_data->addWeeks($i);
            //fill
            $calendar->student_id = $student_id;
            $calendar->professor_id = $professor_id;
            $calendar->status = 1;
            $calendar->year = $now_data->year;
            $calendar->day_week = $day_week;
            $calendar->week = $now_data->week;
            $calendar->fool_time = $now_data->format('Y-m-d');
            $calendar->time_start = $time;
            $calendar->length = $length;
            $calendar->save();
            $data_item[] = $calendar;
            $temp_data++;
        }
        return $data_item[0];
    }
}
