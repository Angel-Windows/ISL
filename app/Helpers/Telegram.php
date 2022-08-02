<?php


namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class Telegram
{
    protected $http;
    protected $bot;
    const url = 'https://api.tlgr.org/bot';

    public function __construct(Http $http, $bbb)
    {
        $this->http = $http;
        $this->bot = $bbb;
    }

    public function send_message($chat_id, $message)
    {
        $this->http::post(self::url.$this->bot.'/sendMessage', [
            'chat_id' => $chat_id,
            'text' => (string)$message,
            'parse_mode' => 'html'
        ]);
    }
    public function set_button($chat_id, $message, $buttons){
        $this->http::post(self::url.$this->bot.'/sendMessage', [
            'chat_id' => $chat_id,
            'text' => (string)$message,
            'parse_mode' => 'html',
            'replay_markup' => $buttons,

        ]);
    }
}
