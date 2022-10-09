<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use App\Models\TelegramSession;
use App\Models\TelegramTemplate;
use App\Models\User;
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
        if ($callback_data) {
            $this->callback_function($callback_data);
        } else {
            $this->message_function($request);
        }
        return response()->json(true, 200);
    }

    private function callback_function($callback_data)
    {
        $data_request = explode('|', $callback_data);
        $this->btn($data_request[0], $data_request[1]);
        Log::debug("callback_function");
    }

    private function message_function($request)
    {
        $message = $request->input('message');
        $message_text = $message['text'] ?? null;
        $message_id = $message['chat']['id'] ?? null;
        $template = TelegramTemplate::where('message', $message_text)->first();

        if ($template) {
            if ($message_text == '/login') {
                $this->webhookRepository->delete_all_session($message_id);
                $telegram_session = new TelegramSession();
                $telegram_session->type = 1;
                $telegram_session->telegram_id = $message_id;
                $telegram_session->text = "start";
                $telegram_session->save();
                $this->telegram->send_message($message_id, 'Введите свой e-mail');
            }
        } elseif ($telegram_session = TelegramSession::where('telegram_id', $message_id)->where('status', 1)->first()) {
            $telegram_session->status = 0;
            $telegram_session->save();
            if ($telegram_session->type == 1) {
                if ($telegram_session->text == "start") {
                    if (User::where('email', $message_text)->first()) {
                        $newTelegramSession = new TelegramSession();
                        $newTelegramSession->type = 1;
                        $newTelegramSession->telegram_id = $message_id;
                        $newTelegramSession->text = $message_text;
                        $newTelegramSession->save();
                        $this->telegram->send_message($message_id, 'Введите пароль');
                    } else {
                        $this->telegram->send_message($message_id, 'e-mail не найден');
                        $this->webhookRepository->delete_all_session($message_id);
                    }
                } else {
                    $user = User::where('email', $telegram_session->text)->first();
                    if (\Hash::check($message_text, $user->password)) {
                        $user->telegram_id = $message_id;
                        $user->save();
                        $this->telegram->send_message($message_id, 'Успешно авторизованно');
                    } else {
                        $this->telegram->send_message($message_id, 'Пароль неверный');
                    }
                    $this->webhookRepository->delete_all_session($message_id);
                }
            }
        }
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
        return response()->json(true, 200);
    }
}

//                $message_bot = ["Я то бот. Но согласись что путин хуйло!", "Сам ты бот ушлёпок.", "кто как обзываеться тот так и называеться", "Ботом меня обозвал пидерком себя назвал.", "Шла саша по шосе а ты гандон.", "Ой всё. Я обиделся", "Я тебя по ip вычислю", "Был бы ты на зоне петухом бы тебя назвали", "Ну не обзывайся", "Нет ты бот", "Нет ты ботяра", "Это чат школы бля. а ты хуйнёй страдаешь"];
