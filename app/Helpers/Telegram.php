<?php


namespace App\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class Telegram
{
    protected Http $http;
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
        return $this->http::post(self::url . $this->bot . '/sendMessage', [
            'chat_id' => $chat_id,
            'text' => (string)$message,
            'parse_mode' => 'html'
        ]);
    }

    public function get_button($chat_id, $message, $buttons)
    {
//        dd(self::url . $this->bot . '/sendButtons');
        return $this->http::post(self::url . $this->bot . '/sendMessage', [
            'chat_id' => $chat_id,
            'text' => (string)$message,
            'parse_mode' => 'html',
            'reply_markup' => $buttons,

        ]);
    }
    public function ReplyKeyboardMarkup($chat_id, $message, $buttons)
    {
//        dd(self::url . $this->bot . '/sendButtons');
        return $this->http::post(self::url . $this->bot . '/sendMessage', [
            'chat_id' => $chat_id,
            'remove_keyboard'=>true,
            'text' => (string)$message,
            'callback_data' => '1|Test',
//            'parse_mode' => 'html',
            'string' => 'ReplyMarkup',
            'reply_markup' => $buttons,

        ]);
    }

    public function sendButtons($chat_id, $message, $button)
    {
        return $this->http::post(self::url . $this->bot . '/sendMessage', [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html',
            'reply_markup' => $button
        ]);
    }
    public function editMessage($chat_id, $message, $message_id): \Illuminate\Http\Client\Response
    {
        return $this->http::post(self::url . $this->bot . '/editMessageText', [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html',
            'message_id' => $message_id,
        ]);
    }
    public function editButtons($chat_id, $message, $button, $message_id): \Illuminate\Http\Client\Response
    {
        return $this->http::post(self::url . $this->bot . '/editMessageText', [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html',
            'reply_markup' => $button,
            'message_id' => $message_id,
        ]);
    }
}
