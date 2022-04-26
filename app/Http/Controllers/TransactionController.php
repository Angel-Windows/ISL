<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use App\Models\Transactions;
use App\Models\UsersProfile;
use Auth;
use Carbon\Carbon;
use Composer\DependencyResolver\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $route_name = Route::getFacadeRoot()->current()->uri();
            $data_navigation = Navigation::whereIn('group', [0, 1, 2])->get();
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

    public function index()
    {
        $data_transactions = Transactions::where('status', '>', -1)
            ->leftJoin('users_profiles AS student', 'student.user_id', 'transactions.student_id')
            ->leftJoin('users_profiles AS professor', 'professor.user_id', 'transactions.professor_id')
            ->select('transactions.*',
                "student.first_name as student_first_name", "student.last_name as student_last_name",
                "professor.first_name as professor_first_name", "professor.last_name as professor_last_name",
            )
            ->orderBy('transactions.id', 'desc')
            ->paginate(10);
        $data_students = UsersProfile::where('id', "!=", Auth::id())->get();
        return view('pages.transactions')
            ->with('data_transactions', $data_transactions)
            ->with('data_students', $data_students);
    }

    public function get_info()
    {

    }
}
