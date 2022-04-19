<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\UsersProfile;
use Auth;
use App\Models\Calendar;
use App\Models\Config;
use App\Models\Navigation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use function Sodium\add;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $route_name = Route::getFacadeRoot()->current()->uri();
            $data_navigation = Navigation::whereIn('group', [0, 1, 2])->get();
            $data_students = UsersProfile::where('id', "!=", Auth::id())->get();

            view()->share('data_students', $data_students);
            view()->share('data_navigation', $data_navigation);
            view()->share('route_name', $route_name);
            view()->share('date_now', Carbon::now());
            return $next($request);
        });
        //            $user_site_profile = Users_profiles::where('user_id', Auth::id())->first();
        //            $currency = CurrencyConverter::isCurrency(1, $user_site_profile->currency, $user_site_profile->currency);
        //            view()->share('user_site_profile', $user_site_profile);
        //            view()->share('currency', $currency['result_need']);
    }

    public function index(Request $request)
    {
        $now_data = Carbon::now();

        $page = (int)$request->input('page');
        $count_day_week = ($request->input('count_day_week'));
        $start_day_week = ($request->input('start')) ?? 1;

        if (isset($count_day_week)) {
            session(['count_day_week' => $count_day_week]);
        } else if ($count_day_week !== null && ($count_day_week < 1 || $count_day_week > 7)) {
            session(['count_day_week' => 7]);
        }
        $data_lesson = $this->get_lesson($page, $start_day_week);
        $filters = Config::where('group_name', 'filters')->get();
        $filter = [];

        foreach ($filters as $key => $item) {
            if (!session()->has('filter')) {
                $display = true;
            } else if (in_array($item->id, session("filter"))) {
                $display = true;
            } else {
                $display = false;
            }
            $filter[$key] = json_decode($item['value']);
            $filter[$key]->display = $display;
        }

        return view('pages.calendar')
            ->with('page', $page)
            ->with('now_data', $now_data->format('Y-m-d'))
            ->with('start_day_week', $start_day_week)
            ->with('filter', $filter)
            ->with('data_lesson', $data_lesson);
    }

    private function get_lesson($page, $start_day_week): array
    {
        $now_data = Carbon::now();
        $now_data->addWeeks($page);
        $year = $now_data->year;
        $week = $now_data->week;
        $data_filter = [
            ['year', $year],
            ['week', $week],
        ];
        switch (session('count_day_week')) {
            case 1:
                $data_filter[] = [[
                    'day_week' => $start_day_week
                ]];
                break;
            case 4:
                switch ($start_day_week) {
                    case 1:
                        $day_week_select = [0, 5, 6];
                        break;
                    case 2:
                        break;
                }
                break;
            default:
                $start_day_week = 1;
        }
        $data_lesson = Calendar::where(
            $data_filter
        )
            ->whereNotIn('day_week', $day_week_select ?? [])
            ->leftJoin('users_profiles', 'users_profiles.user_id', 'calendars.student_id')
            ->orderBy('day_week')
            ->orderBy('time_start')
            ->select('calendars.*', 'users_profiles.first_name', 'users_profiles.last_name',)
            ->get();
        $oldTime = strtotime($data_lesson[0]->time_start);
        return [...$data_lesson];
    }

    private function get_table($page, $start_day_week)
    {

        $get_lesson = $this->get_lesson($page, $start_day_week);
        $count_day_week = session('count_day_week') ?? 7;
        return view(('components.calendar.table'))
            ->with('page', $page)
            ->with('count_day_week', $count_day_week)
            ->with('start_day_week', $start_day_week)
            ->with('data_lesson', $get_lesson);
    }

    public function ajax_filters(Request $request)
    {
        $id = $request['id'];
        $filter = session('filter') ?? [];
        $arr_s = array_search($id, $filter);
        if ($arr_s === false) {
            array_push($filter, $id);
        } else {
            unset($filter[$arr_s]);
        }
        session(['filter' => $filter]);
        return json_encode([
                'code' => $arr_s,
            ]
        );
    }

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
        return json_encode([
                'code' => 1,
                'message' => "",
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
                break;
            case "1":
                $return = $this->success_lesson($id);
                break;
            case "2":
                break;
            default:
                break;
        }
        $data = [];
        return $return;
    }

    private function success_lesson($id)
    {
        $lesson = Calendar::where('id', $id)->first();
        if ($lesson->status == 0) {
            return json_encode([
                    'code' => 2,
                    'message' => "This status already exist",
                    'data' => []
                ]
            );
        } else {
            $lesson->status = 0;
            $student = UsersProfile::where('id', $lesson->student_id)->first();
            $student->decrement('balance', $student->price_lesson);
            $lesson->save();

            $transactions = new Transactions();
            $transactions->student_id = $student->id;
            $transactions->professor_id = $lesson->professor_id;
            $transactions->lesson_id = $lesson->id;
            $transactions->new_balance = $student->balance;
            $transactions->amount = $student->price_lesson;
            $transactions->status = 0;
            $transactions->type = 0;
            $transactions->save();

            return json_encode([
                    'code' => 1,
                    'message' => "Success save",
                    'data' => []
                ]
            );
        }
    }

    public function get_lesson_info(Request $request)
    {
        $id = $request->input('id');
        $lesson = DB::table('calendars')
            ->where("calendars.id", $id)
            ->leftJoin('users_profiles', 'users_profiles.user_id', 'calendars.student_id')
            ->select('calendars.*', 'users_profiles.first_name', 'users_profiles.last_name', 'users_profiles.balance', 'users_profiles.price_lesson')
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
                    "name" => $lesson->first_name . " " . $lesson->last_name,
                    "date" => $time->format("Y-m-d"),
                    "time" => $time->format("H:m"),
                    "balance" => $lesson->balance,
                    "price_lesson" => $lesson->price_lesson,
                ]
            ]
        );
    }
}
