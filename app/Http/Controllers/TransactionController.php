<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
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
        if ($transaction->lesson_id){
            $first_transaction = Transactions::where('lesson_id', $transaction->lesson_id)->orderBy('id', 'desc')->first();
            if($first_transaction->id != $transaction->id){
                return json_encode([
                        'code' => 2,
                        'message' => 'Операция уже устарела',
                        'data' => []
                    ]
                );
            }
        }
        switch ($event) {
            case 1: // Success
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
            case 2: // Cancel
            {
                if ($transaction->status == 2) {
                    return json_encode([
                            'code' => 2,
                            'message' => 'Уже отменено',
                            'data' => []
                        ]
                    );
                }
                switch ($transaction->type) {
                    case 0: // Lesson success
                        $calendars = Calendar::where('id', $transaction->lesson_id)->first();
                        if ($calendars->status == 1) {
                            return json_encode([
                                    'code' => 2,
                                    'message' => 'Операция уже устарела',
                                    'data' => []
                                ]
                            );
                        } else {
                            $user_profiles->increment('balance', $transaction->amount);
                            $calendars->status = 1;
                            $calendars->save();
                        }
                        break;
                    case 1: // Lesson cancel
                        $calendars = Calendar::where('id', $transaction->lesson_id)->first();
                        if ($calendars->status == 1) {
                            return json_encode([
                                    'code' => 2,
                                    'message' => 'Операция уже устарела',
                                    'data' => []
                                ]
                            );
                        } else {
                            $calendars->status = 1;
                            $calendars->save();
                        }
                        break;
                    case 2: // Payed
                        $user_profiles->decrement('balance', $transaction->amount);
                        break;
                }
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

    public
    function payed_store(Request $request)
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
