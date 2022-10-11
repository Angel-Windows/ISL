<?php

namespace App\Http\Controllers;

use App\Events\LessonStart;
use App\Helpers\Telegram;
use App\Models\Calendar;
use Carbon\Carbon;
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
        dd($http);
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


}
