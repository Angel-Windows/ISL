<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
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
        $data = ['description' => "Crone start",
            'file' => $_SERVER['REMOTE_ADDR'],
            'line' => 23];
        $this->telegram->send_message(324428256, view('templates.report', $data));
    }
}
