<?php

namespace App\Repositories;

use App\Models\Calendar;
use App\Models\RegularLesson;
use App\Models\Transactions;
use App\Models\UsersProfile;
use Carbon\Carbon;
use \Auth;
use Illuminate\Database\Eloquent\Model;

class CalendarRepository extends BaseRepository
{
    public function transaction_add($data = [])
    {
        $transactions = new Transactions();
        foreach ($data as $key=>$item) {
            $transactions->$key = $item;
        }
        $transactions->save();
    }

    /**
     * @param $id
     * @return array
     */
    public function success_lesson($id): array
    {
        $lesson = Calendar::where('id', $id)->first();
        if ($lesson->status == 0) {

            return [
                'code' => 2,
                'message' => "This status already exist",
                'data' => []
            ];
        } else {
            $lesson->status = 0;
            $student = UsersProfile::where('id', $lesson->student_id)->first();
            $student->decrement('balance', $student->price_lesson);
            $lesson->save();
            $professor = UsersProfile::where('id', $lesson->professor_id)->first();
            $professor->increment('balance', $student->price_lesson);
            $data = [
                'student_id' => $student->id,
                'professor_id' => $lesson->professor_id,
                'lesson_id' => $lesson->id,
                'new_balance' => $student->balance,
                'amount' => $student->price_lesson,
                'status' => 1,
                'type' => 0,
            ];
            $this->transaction_add($data);
            return [
                'code' => 1,
                'message' => "Success save",
                'data' => [],
            ];
        }
    }
    public function closed_lesson($id): array
    {
        $lesson = Calendar::where('id', $id)->first();
        $student = UsersProfile::where('id', $lesson->student_id)->first();
        if ($lesson->status == 3) {
            return [
                'code' => 2,
                'message' => "Return nothing",
                'data' => []
            ];
        } elseif ($lesson->status != 1 && $lesson->status != 2) {
            return [
                'code' => 2,
                'message' => "Error type",
                'data' => []
            ];
        } else {
            $lesson->status = 3;
            $lesson->save();
            $data = [
                'student_id' => $student->id,
                'professor_id' => $lesson->professor_id,
                'lesson_id' => $lesson->id,
                'new_balance' => $student->balance,
                'amount' => $student->price_lesson,
                'status' => 1,
                'type' => 1,
            ];
            $this->transaction_add($data);
        }


        return [
            'code' => 1,
            'message' => "Успешно отменено",
            'data' => []
        ];
    }

    public function back_lesson($id): array
    {
        $lesson = Calendar::where('id', $id)->first();
        $student = UsersProfile::where('id', $lesson->student_id)->first();
        if ($lesson->status == 0) {
            $student->increment('balance', $student->price_lesson);
        } elseif ($lesson->status == 1 || $lesson->status == 2) {
            return [
                'code' => 2,
                'message' => "Return nothing",
                'data' => []
            ];
        }
        $lesson->status = 2;
        $lesson->save();
        $data = [
            'student_id' => $student->id,
            'professor_id' => $lesson->professor_id,
            'lesson_id' => $lesson->id,
            'new_balance' => $student->balance,
            'amount' => $student->price_lesson,
            'status' => 1,
            'type' => 1,
        ];
        $this->transaction_add($data);
        return [
            'code' => 1,
            'message' => "Success back",
            'data' => []
        ];
    }

    public function fill_regular_transaction($student_id, $professor_id, $date, $time, $length, $is_regular = false)
    {
        $temp_data = 0;
        $temp = 0;
        $naw = Carbon::createFromFormat("Y-m-d", $date);
        $day_week = $naw->dayOfWeek;
        $count_for = 1;
        if ($is_regular) {
            $count_for = 20;
            $regular_lessons_count = RegularLesson::where('student_id', $student_id)
                ->where('day_week', $day_week)
                ->where('time_start', $time)
                ->count();
//            dd($regular_lessons_count);
            if (!$regular_lessons_count) {
                $regular_lessons = new RegularLesson();
                $regular_lessons->student_id = $student_id;
                $regular_lessons->professor_id = $professor_id;
                $regular_lessons->time_start = $time;
                $regular_lessons->day_week = $day_week;
                $regular_lessons->length = $length;
                $regular_lessons->status = 1;
                $regular_lessons->save();
            }
        }


        $data_item = [];
        for ($i = 0; $i < $count_for; $i++) {
            $now_data = Carbon::now();
            $now_data->startOfWeek();
            $now_data->addDays($day_week - 1);
            $now_data->addWeeks($i);
            if (!$day_week) {
                $now_data->addWeek();
            }
            $lessons_count = Calendar::where('student_id', $student_id)
                ->where('week', $now_data->week)
                ->where('day_week', $day_week)
                ->where('time_start', $time)
                ->first();
            if ($lessons_count) {
                $temp++;
            } else {
                $temp++;
                $calendar = new Calendar();
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

        }
        if (!$temp_data) {
            return false;
        } else {
            return $data_item[0];

        }
    }
}
