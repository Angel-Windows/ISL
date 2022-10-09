<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use App\Repositories\CalendarRepository;
use App\Repositories\WebhookRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class WebhookController extends Controller
{

    private Telegram $telegram;
//    private $globalRepository;
    private $calendarRepository;
    private $webhookRepository;

    /**
     * @param Telegram $telegram
     */

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
        $this->calendarRepository = app(CalendarRepository::class);
        $this->webhookRepository = app(WebhookRepository::class);
    }

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {

        Log::debug($request->all());
        $callback_data = $request->input('callback_query')['data'] ?? null;



        if ($callback_data){
            $this->callback_function($callback_data);
        }else{
            $this->message_function($request);
        }
        return response()->json(true, 200);
    }
    private function callback_function($callback_data){
        $data_request = explode('|', $callback_data);
    }

    private function message_function($request)
    {
//        $message_text = $message['text'] ?? null;
//        $message_id = $message['chat']['id'] ?? null;
    }


    private function btn($action, $lesson_id)
    {
        switch ($action) {
            case "1":
                $reply_markup = $this->webhookRepository->buttons_bot($lesson_id, 0);
                $this->calendarRepository->success_lesson($lesson_id);
                break;
            case "2":
                $reply_markup = $this->webhookRepository->buttons_bot($lesson_id, 0);
                $this->calendarRepository->closed_lesson($lesson_id);
                break;
            case "3":
                $reply_markup = $this->webhookRepository->buttons_bot($lesson_id, 1);
                $this->calendarRepository->back_lesson($lesson_id);
                break;
            default:
                return response()->json(true, 200);
        }
    }
}

//                $message_bot = ["Я то бот. Но согласись что путин хуйло!", "Сам ты бот ушлёпок.", "кто как обзываеться тот так и называеться", "Ботом меня обозвал пидерком себя назвал.", "Шла саша по шосе а ты гандон.", "Ой всё. Я обиделся", "Я тебя по ip вычислю", "Был бы ты на зоне петухом бы тебя назвали", "Ну не обзывайся", "Нет ты бот", "Нет ты ботяра", "Это чат школы бля. а ты хуйнёй страдаешь"];
