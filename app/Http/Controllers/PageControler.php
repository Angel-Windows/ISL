<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Navigation;
use App\Models\Referal;
use App\Models\User;
use App\Models\UsersProfile;
use App\Repositories\GlobalRepository;
use App\Repositories\TransactionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Auth;

class PageControler extends Controller
{
    private $transactionRepository;
    private $globalRepository;
    public function __construct()
    {
        $this->transactionRepository = app(TransactionRepository::class);
        $this->globalRepository = app(GlobalRepository::class);
        $this->middleware(function ($request, $next) {
            $id = Auth::id();
            $route_name = Route::getFacadeRoot()->current()->uri();
            $data_navigation = Navigation::whereIn('group', [0, 1, 2])->get();
            $data_students = Referal::where('user_1', $id)
                ->leftJoin('users_profiles', 'users_profiles.user_id', 'referals.user_2')
                ->get();
            $count_lesson = Calendar::where('student_id', $id)
                ->where('status', 0)
                ->orWhere('professor_id', $id)
                ->where('status', 0)
                ->count();
            $user = User::where('users.id', $id)
                ->leftJoin('users_profiles', 'users_profiles.user_id', 'users.id')
                ->first();
            $now_data = Carbon::now();
            view()->share('count_lesson', $count_lesson);
            view()->share('data_students', $data_students);
            view()->share('data_navigation', $data_navigation);
            view()->share('route_name', $route_name);
            view()->share('user', $user);
            view()->share('now_data', $now_data->format('Y-m-d'));
            view()->share('date_now', Carbon::now());
            return $next($request);
        });
        //            $user_site_profile = Users_profiles::where('user_id', Auth::id())->first();
        //            $currency = CurrencyConverter::isCurrency(1, $user_site_profile->currency, $user_site_profile->currency);
        //            view()->share('user_site_profile', $user_site_profile);
        //            view()->share('currency', $currency['result_need']);
    }

    public function home(Request $request){
        return view('pages.home')
//        return view('pages.calendar')
        ;
    }
    public function calendar(Request $request)
    {
        $page = (int)$request->input('page');

        $data_day_time = [];
        $day_time__ = Carbon::now();
        $day_time__->addWeeks($page);
        $day_time__->startOfWeek();
        for ($i = 0; $i < 7; $i++) {
            $data_day_time[] = $day_time__->format('m-d');
            $day_time__->addDay();
        }

        $count_day_week = ($request->input('count_day_week'));
        $start_day_week = ($request->input('start')) ?? 1;

        if (isset($count_day_week)) {
            session(['count_day_week' => $count_day_week]);
        } else if ($count_day_week !== null && ($count_day_week < 1 || $count_day_week > 7)) {
            session(['count_day_week' => 7]);
        }
        $data_lesson = $this->get_lesson($page, $start_day_week, $data_day_time);
        $filter = $this->globalRepository->get_filter('filters_calendar');

        return view('rozetka')
//        return view('pages.calendar')
            ->with('page', $page)
            ->with('data_day_time', $data_day_time)
            ->with('start_day_week', $start_day_week)
            ->with('filter', $filter)
            ->with('data_lesson', json_encode($data_lesson));
    }

    public function transaction()
    {
        $filter = $this->globalRepository->get_filter('filters_transaction');
        $data_transactions = $this->transactionRepository->get_list($filter);
        return view('pages.transactions')
            ->with('data_transactions', $data_transactions)
            ->with('filter', $filter);
    }


    private function get_lesson($page, $start_day_week, $data_day_time): array
    {
        $now_data = Carbon::now();
        $now_data->addWeeks($page);
        $year = $now_data->year;
        for ($i = 0; $i < count($data_day_time); $i++) {
            $data_day_time[$i] = $year . "-" . $data_day_time[$i];
        }
        $data_filter = [];
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
        $data_lesson = Calendar::whereIn('fool_time', $data_day_time)
//            ->whereNotIn('day_week', $day_week_select ?? [])
            ->leftJoin('users_profiles', 'users_profiles.user_id', 'calendars.student_id')
            ->orderBy('calendars.id')
//            ->orderBy('fool_time')
//            ->orderBy('time_start')
            ->select('calendars.*', 'users_profiles.name')
//            ->select('calendars.*', 'users_profiles.first_name', 'users_profiles.last_name',)
            ->get();
        return [...$data_lesson];
    }
    public function payed(Request $request){
        return view('pages.payed');
    }

}
