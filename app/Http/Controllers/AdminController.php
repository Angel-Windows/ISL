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

    public function crone()
    {
        $calendar = Calendar::first();
        $http = Http::get('https://api.tlgr.org/bot'.env('REPORT_TELEGRAM_ID') .config('bots.bot') . '/setWebhook?url=https://new.it-schoollearn.com/crone');
        dd(json_decode($http->body()));
        event(new LessonStart($calendar));
    }
}
