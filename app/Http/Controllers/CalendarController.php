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
        $data_month = ['Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'];
        $page = (int)$request->input('page');
//        $naw = Carbon::create(2022, 1, 29);
        $now_data = Carbon::now();
        $now_data->addWeeks($page);
        $year = $now_data->year;
        $week = $now_data->week;

        $data_lesson = Calendar::where([
            ['year', $year],
            ['week', $week],
        ])
            ->orderBy('day_week')
            ->orderBy('time_start')
            ->get();
        $data_navigation = Navigation::whereIn('group', [0, 1, 2])->get();
        $data_lesson = [...$data_lesson];
        return view('pages.calendar')
            ->with('data_navigation', $data_navigation)
            ->with('page', $page)
            ->with('now_data', $now_data->format('Y-m-d'))
            ->with('data_lesson', $data_lesson);
    }
}
