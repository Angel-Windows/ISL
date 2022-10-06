<?php

namespace App\Http\Controllers;

use App\Events\LessonStart;
use App\Helpers\Telegram;
use App\Models\Calendar;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    protected $telegram;

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
    }

    public function setWebhook()
    {
        $http = Http::get('https://api.tlgr.org/bot' . env('REPORT_TELEGRAM_ID') . config('bots.bot') . '/setWebhook?url=https://new.it-schoollearn.com/webhook');
        dd(json_decode($http->body()));
    }

    public function crone()
    {
        $calendar = Calendar::first();
        event(new LessonStart($calendar));

        $http = Http::get('https://api.tlgr.org/bot' . env('REPORT_TELEGRAM_ID') . config('bots.bot') . '/getWebhookInfo');
        dd(json_decode($http->body()));
    }

    public function webhook()
    {
//        $calendar = Calendar::last();
//        event(new LessonStart($calendar));
        return response()->json(true, 200);
    }
}
