<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\User;
use App\Models\UsersProfile;
use App\Repositories\LessonRepository;
use Auth;
use App\Models\Calendar;
use App\Models\Config;
use App\Models\Navigation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use function Sodium\add;

class CalendarController extends Controller
{
    private $lessonsRepository;
//    public function __construct()
//    {
//        $this->lessonsRepository = app(LessonRepository::class);
//
//        $this->middleware(function ($request, $next) {
//            $this->lessonsRepository = app(LessonRepository::class);
//            $id = Auth::id();
//            $route_name = Route::getFacadeRoot()->current()->uri();
//            $data_navigation = Navigation::whereIn('group', [0, 1, 2])->get();
//            $data_students = UsersProfile::where('id', "!=", $id)->get();
//            $count_lesson = Calendar::where('student_id', $id)
//                ->where('status', 0)
//                ->orWhere('professor_id', $id)
//                ->where('status', 0)
//                ->count();
//            $user = User::where('users.id', $id)
//                ->leftJoin('users_profiles', 'users_profiles.user_id', 'users.id')
//                ->first();
//            view()->share('count_lesson', $count_lesson);
//            view()->share('data_students', $data_students);
//            view()->share('data_navigation', $data_navigation);
//            view()->share('route_name', $route_name);
//            view()->share('user', $user);
//            view()->share('date_now', Carbon::now());
//            return $next($request);
//        });
//        //            $user_site_profile = Users_profiles::where('user_id', Auth::id())->first();
//        //            $currency = CurrencyConverter::isCurrency(1, $user_site_profile->currency, $user_site_profile->currency);
//        //            view()->share('user_site_profile', $user_site_profile);
//        //            view()->share('currency', $currency['result_need']);
//    }




    public function add_lesson(Request $request)
    {

        $student_id = $request['student_id'];
        $date = $request['date'];
        $time = $request['time'];
        $length = $request['length'];
        $naw = Carbon::createFromFormat("Y-m-d", $date);
        $calendar = new Calendar;
        $calendar->student_id = $student_id;
        $calendar->professor_id = Auth::id();
        $calendar->year = $naw->year;

        $calendar->week = $naw->week;
        $calendar->day_week = $naw->dayOfWeek;
        $calendar->fool_time = $date;
        $calendar->time_start = $time;
        $calendar->length = $length;

        $calendar->save();
        $data = [];
//        $filters = $this->get_filters();
//        $data["filters"] = $filters;


        $data_lesson = Calendar::where('calendars.id', $calendar->id)
//            ->whereNotIn('day_week', $day_week_select ?? [])
            ->leftJoin('users_profiles', 'users_profiles.user_id', 'calendars.student_id')
            ->orderBy('fool_time')
            ->orderBy('time_start')
//            ->select('calendars.*', 'users_profiles.first_name', 'users_profiles.last_name',)
            ->select('calendars.*', 'users_profiles.name')
            ->first();
        $data["item"] = $data_lesson;
        return json_encode([
                'code' => 1,
                'message' => "",
                'data' => $data
            ]
        );
    }

//    private function get_filters()
//    {
//        $filters = Config::where('group_name', 'filters_calendar')->get();
//        $filter = [];
//
//        foreach ($filters as $key => $item) {
//            if (!session()->has('filters_calendar')) {
//                $display = true;
//            } else if (in_array($item->id, session('filters_calendar'))) {
//                $display = true;
//            } else {
//                $display = false;
//            }
//            $filter[$key] = json_decode($item['value']);
//            $filter[$key]->display = $display;
//        }
//        return $filter;
//    }

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
                $return = $this->success_lesson($id);
                break;
            case "2":
                $return = $this->closed_lesson($id);
                break;
            case "3":
                $return = $this->back_lesson($id);
                break;
            default:
                break;
        }
        $return['type'] = (int)$event;
        return json_encode($return);
    }

    private function closed_lesson($id): array
    {
        $lesson = Calendar::where('id', $id)->first();
        $student = UsersProfile::where('id', $lesson->student_id)->first();
        if ($lesson->status == 3) {
            return [
                'code' => 2,
                'message' => "Return nothing",
                'data' => []
            ];
        }elseif ($lesson->status != 1 && $lesson->status != 2){
            return [
                'code' => 2,
                'message' => "Error type",
                'data' => []
            ];
        }else{
            $lesson->status = 3;
            $lesson->save();
            $transactions = new Transactions();
            $transactions->student_id = $student->id;
            $transactions->professor_id = $lesson->professor_id;
            $transactions->lesson_id = $lesson->id;
            $transactions->new_balance = $student->balance;
            $transactions->amount = $student->price_lesson;
            $transactions->status = 1;
            $transactions->type = 1;
            $transactions->save();
        }


        return [
            'code' => 1,
            'message' => "Успешно отменено",
            'data' => []
        ];
    }

    private function back_lesson($id): array
    {
        $lesson = Calendar::where('id', $id)->first();
        $student = UsersProfile::where('id', $lesson->student_id)->first();
        $transactions = new Transactions();
        if ($lesson->status == 0) {
            $student->increment('balance', $student->price_lesson);
        } elseif ($lesson->status == 1 || $lesson->status == 2) {
            return [
                'code' => 2,
                'message' => "Return nothing",
                'data' => []
            ];
        } elseif ($lesson->status == 3) {

        }
        $lesson->status = 2;
        $lesson->save();
        $transactions->student_id = $student->id;
        $transactions->professor_id = $lesson->professor_id;
        $transactions->lesson_id = $lesson->id;
        $transactions->new_balance = $student->balance;
        $transactions->amount = $student->price_lesson;
        $transactions->status = 1;
        $transactions->type = 1;
        $transactions->save();

        return [
            'code' => 1,
            'message' => "Success back",
            'data' => []
        ];
    }

    private function success_lesson($id): array
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
            $transactions = new Transactions();
            $transactions->student_id = $student->id;
            $transactions->professor_id = $lesson->professor_id;
            $transactions->lesson_id = $lesson->id;
            $transactions->new_balance = $student->balance;
            $transactions->amount = $student->price_lesson;
            $transactions->status = 1;
            $transactions->type = 0;
            $transactions->save();

            return [
                'code' => 1,
                'message' => "Success save",
                'data' => []
            ];
        }
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
                    "time" => $time->format("H:m"),
                    "balance" => $lesson->balance,
                    "price_lesson" => $lesson->price_lesson,
                ]
            ]
        );
    }
}
