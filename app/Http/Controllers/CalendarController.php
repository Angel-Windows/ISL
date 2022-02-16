<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Navigation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $route_name = Route::getFacadeRoot()->current()->uri();
            $data_navigation = Navigation::whereIn('group', [0, 1, 2])->get();
            view()->share('data_navigation', $data_navigation);
            view()->share('route_name', $route_name);
            return $next($request);
        });
        //            $user_site_profile = Users_profiles::where('user_id', Auth::id())->first();
        //            $currency = CurrencyConverter::isCurrency(1, $user_site_profile->currency, $user_site_profile->currency);
        //            view()->share('user_site_profile', $user_site_profile);
        //            view()->share('currency', $currency['result_need']);
    }

    public function index(Request $request)
    {
//        $naw = Carbon::create(2022, 1, 29);
//        $data_month = ['Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];
        $page = (int)$request->input('page');
        $date = Carbon::parse($request->input('date')) ?? null;

        $count_day_week = ($request->input('count_day_week'));
        $start_day_week = ($request->input('start')) ?? 1;
        $filter = ($request->input('filter')) ?? "0,1,2,3,4,5,6";
        $filter = preg_replace('/[^0-9,","]/', '', $filter);
        $filter = explode(",", $filter);
        if (isset($date)) {
            $now_data = $date;
        } else {
            $now_data = Carbon::now(); //Добавить поиск по дате
        }
        $now_data->addWeeks($page);
        $year = $now_data->year;
        $week = $now_data->week;
        $data_filter = [
            ['year', $year],
            ['week', $week],
        ];

        if (isset($count_day_week)) {
            session(['count_day_week' => $count_day_week]);
        } else if ($count_day_week !== null && ($count_day_week < 1 || $count_day_week > 7)) {
            session(['count_day_week' => 7]);
        }
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
            ->whereIn('status', $filter)
            ->orderBy('day_week')
            ->orderBy('time_start')
            ->get();
        $data_lesson = [...$data_lesson];
        return view('pages.calendar')
            ->with('page', $page)
            ->with('now_data', $now_data->format('Y-m-d'))
            ->with('start_day_week', $start_day_week)
            ->with('filter', $filter)
            ->with('data_lesson', $data_lesson);
    }
}
