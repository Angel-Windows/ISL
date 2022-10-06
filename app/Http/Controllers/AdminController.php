<?php

namespace App\Http\Controllers;

use App\Events\LessonStart;
use App\Helpers\Telegram;
use App\Models\Calendar;
use Illuminate\Contracts\Container\Container;

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
        dd($calendar);
        event(new LessonStart($calendar));
    }
}
