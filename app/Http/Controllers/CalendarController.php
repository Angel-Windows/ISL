<?php

namespace App\Http\Controllers;

use App\Models\TelegramSession;
use App\Models\Transactions;
use App\Models\UsersProfile;
use App\Repositories\CalendarRepository;
use App\Repositories\GlobalRepository;
use Auth;
use App\Models\Calendar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    private $globalRepository;
    private $calendarRepository;

    public function __construct()
    {
        $this->globalRepository = app(GlobalRepository::class);
        $this->calendarRepository = app(CalendarRepository::class);
    }
    private function transaction_add($data = [])
    {
        $transactions = new Transactions();
        foreach ($data as $key=>$item) {
            $transactions->$key = $item;
        }
        $transactions->save();
    }
    public function add_lesson(Request $request)
    {
        $is_regular = $request->input('is_regular');
        $student_id = $request['student_id'];
        $date = $request['date'];
        $time = $request['time'];
        $length = $request['length'];
        $professor_id = Auth::id();
        $calendar = $this->calendarRepository->fill_regular_transaction($student_id, $professor_id, $date, $time, $length, $is_regular);
        if (!$calendar) {
            return json_encode([
                    'code' => 2,
                    'message' => 'False',
                    'data' => []
                ]
            );
        }
        $data = [];

        $data_lesson = Calendar::where('calendars.id', $calendar->id)
//            ->whereNotIn('day_week', $day_week_select ?? [])
            ->leftJoin('users_profiles', 'users_profiles.user_id', 'calendars.student_id')
            ->orderBy('fool_time')
            ->orderBy('time_start')
//            ->select('calendars.*', 'users_profiles.first_name', 'users_profiles.last_name',)
            ->select('calendars.*', 'users_profiles.name')
            ->first();

        $data["item"] = $data_lesson;
        $data["filters"] = $this->globalRepository->get_filter('filters_calendar');
        return json_encode([
                'code' => 1,
                'message' => 'Успешно.' .
                    "$data_lesson->name <br/>" .
                    "$date $time",
                'data' => $data
            ]
        );
    }

    public function lesson_info_event(Request $request)
    {
        $id = $request['id'];
        $event = $request['event'];
        $return = [];
        switch ($event) {
            case "0":
                $return = 0;
                break;
            case "1":
                $return = $this->calendarRepository->success_lesson($id);
//                $return = $this->success_lesson($id);
                break;
            case "2":
                $return = $this->calendarRepository->closed_lesson($id);
//                $return = $this->closed_lesson($id);
                break;
            case "3":
                $return = $this->calendarRepository->back_lesson($id);
//                $return = $this->back_lesson($id);
                break;
            default:
                break;
        }
        $return['type'] = (int)$event;
        return json_encode($return);
//        dd(\Hash::check('1232', '$2y$10$hIYmpSpbEMtyRz11IJLK7.zRmGFdKWXQil8l0C1Tf72cC/x62Rv1i'));
//        TelegramSession::where('telegram_id', 1232)->delete();
    }

    public function get_lesson_info(Request $request)
    {
        $id = $request->input('id');
        $lesson = DB::table('calendars')
            ->where("calendars.id", $id)
            ->leftJoin('users_profiles', 'users_profiles.user_id', 'calendars.student_id')
            ->select('calendars.*', 'users_profiles.name', 'users_profiles.balance', 'users_profiles.price_lesson')
//            ->select('calendars.*', 'users_profiles.first_name', 'users_profiles.last_name', 'users_profiles.balance', 'users_profiles.price_lesson')
            ->first();
        $time = Carbon::createFromFormat('Y-m-d H:i:s', "2022-01-01 09:00:00");
        $time->week = $lesson->week;
        if ($time->dayOfWeek > $lesson->day_week) {
            $time->addDays($lesson->day_week - $time->dayOfWeek);

        } elseif ($time->dayOfWeek < $lesson->day_week) {
            $time->addDays($time->dayOfWeek - $lesson->day_week);
        }


        return json_encode([
                'code' => 1,
                'message' => "",
                'data' => [
                    "id" => $lesson->id,
                    "student_id" => $lesson->student_id,
                    "name" => $lesson->name,
//                    "name" => $lesson->first_name . " " . $lesson->last_name,
//                    "date" => $time->format("Y-m-d"),
                    "date" => $lesson->fool_time,
                    "status" => $lesson->status,
                    "time" => $time->format("H:m"),
                    "balance" => $lesson->balance,
                    "price_lesson" => $lesson->price_lesson,
                ]
            ]
        );
    }

}
