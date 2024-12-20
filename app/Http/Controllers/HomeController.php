<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
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

    public function index()
    {
        return view('rozetka');

//        $data = Navigation::whereIn('group', [0, 1, 2])->get();
//        return view('pages.calendar')
//            ->with('data', $data);
    }
}
