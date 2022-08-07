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
        $transaction = Transactions::where('id', $id)->first();
        $user_profiles = UsersProfile::where('user_id', $transaction->student_id)->first();
        switch ($event) {
            case 1:
            {
                if ($transaction->status == 1) {
                    return json_encode([
                            'code' => 2,
                            'message' => 'Уже подтверждено',
                            'data' => []
                        ]
                    );
                } elseif ($transaction->type == 2) {
                    $user_profiles->increment('balance', $transaction->amount);
                    $transaction->status = 1;
                    $transaction->save();
                    return json_encode([
                            'code' => 1,
                            'message' => 'Оплата подтверждена </br> Текущий баланс ' . $user_profiles->balance,
                            'data' => []
                        ]
                    );
                }
                break;
            }
            case 2:
            {
                $transaction->status = 2;
                $transaction->save();
                break;
            }
        }

        return json_encode([
                'code' => 1,
                'message' => 'Успешно',
                'data' => []
            ]
        );
    }

    public function payed_store(Request $request)
    {
        $user_id = Auth::id();
        $amount = $request->input("amount");
        $user_payed = $request->input("user_payed") ?? $user_id;
        $transaction = new Transactions();
        $transaction->student_id = $user_payed;
        $transaction->professor_id = 1;
        $transaction->amount = $amount;
        $transaction->status = 0;
        $transaction->type = 2;
        $transaction->save();
        return json_encode([
                'code' => 1,
                'message' => 'False',
                'data' => []
            ]
        );
    }
}
