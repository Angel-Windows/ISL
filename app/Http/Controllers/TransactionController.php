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

    }



    public function transaction_info_event(Request $request)
    {
        $id = $request['id'];
        $event = $request['event'];
        $return = [];
        switch ($event) {
            case 0: {

            }
        }
        return json_encode([
                'code' => 1,
            ]
        );
    }
}
