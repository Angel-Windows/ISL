<?php


namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class Telegram
{
    protected $http;
    protected $bot;
    const url = 'https://api.tlgr.org/bot';

    public function __construct(Http $http)
    {
        $this->http = $http;
        $this->bot = config('bots.bot');
    }

    public function send_message($chat_id, $message)
    {
//        dd(self::url.$this->bot.'/sendMessage', [
//            'chat_id' => $chat_id,
//            'text' => (string)$message,
//            'parse_mode' => 'html'
//        ]);
       return $this->http::post(self::url.$this->bot.'/sendMessage', [
            'chat_id' => $chat_id,
            'text' => (string)$message,
            'parse_mode' => 'html'
        ]);
    }
    public function get_button($chat_id, $message, $buttons){
//        dd(self::url . $this->bot . '/sendButtons');
        return $this->http::post(self::url.$this->bot.'/sendMessage', [
            'chat_id' => $chat_id,
            'text' => (string)$message,
            'parse_mode' => 'html',
            'reply_markup' => $buttons,

        ]);
    }
    public function set_button($chat_id, $message, $buttons, $message_id){
        return $this->http::post(self::url.$this->bot.'/editMessageText', [
            'chat_id' => $chat_id,
            'text' => (string)$message,
            'parse_mode' => 'html',
            'reply_markup' => $buttons,
            'message_id' => $message_id,


        ]);
    }
}
