<?php

namespace App\Http\Controllers;

use App\Events\LessonStart;
use App\Helpers\Telegram;
use App\Models\Calendar;
use App\Models\Referal;
use App\Models\User;
use App\Models\UsersProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    protected Telegram $telegram;

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
    }

    public function setWebhook()
    {
        $http = Http::get('https://api.tlgr.org/bot' . env('REPORT_TELEGRAM_ID') . config('bots.bot') . '/setWebhook?url=https://new.it-schoollearn.com/webhook');
        print_r($http);
//        dd($http);
    }

    public function crone()
    {
        $now_data = Carbon::now();
        $now_data->timezone(3)->addHour()->setMinutes(0)->setSecond(0);
        $calendar = Calendar::where('fool_time', $now_data->format('Y-m-d'))
            ->where('time_start', '>=', $now_data->format('H:i:s'))
            ->where('time_start', '<', $now_data->addHour()->format('H:i:s'))
            ->get();

        foreach ($calendar as $item) {
            event(new LessonStart($item));
        }
    }

    public function create_student_store(Request $request){
        $user = new User();
        $user->hash = $this->create_hash();
        $user->telegram_id = null;
        $user->email = $request->input('email');
        $user->password = Hash::make(1232);
        $user->save();

        $user_profile = new UsersProfile();
        $user_profile->currency = "2";
        $user_profile->user_id = $user->id;
        $user_profile->balance = 0;
        $user_profile->name = $request->input('name');
        $user_profile->price_lesson = $request->input('price');
        $user_profile->save();
        $referral = new Referal();
        $referral->user_1 = 1;
        $referral->user_2 = $user->id;
        $referral->save();
    }
    private function create_hash()
    {
        do {
            $hash = "";
            $symbol = ['Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P', 'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Z', 'X', 'C', 'V', 'B', 'N', 'M'];
            for ($i = 0; $i < 7; $i++) {
                $hash .= $symbol[rand(0, count($symbol) - 1)];
            }
        } while (User::where('hash', $hash)->first());
        return $hash;
    }

}
