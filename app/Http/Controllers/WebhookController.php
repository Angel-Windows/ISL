<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use App\Models\Calendar;
use App\Models\TelegramChat;
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
            $this->callback_function($callback_data, $request);
        } else {

            $this->message_function($request);
        }
        return response()->json(true, 200);
    }

    private function callback_function($callback_data, $request)
    {
        $data_request = explode('|', $callback_data);
        $callback_id = $request->input('callback_query')['message']['message_id'];
        $chat_id = $request->input('callback_query')['message']['chat']['id'];
        switch ($data_request[1]) {
            case 'add_balance' :
                $this->webhookRepository->add_session(2, $chat_id, $data_request[0]);
                $this->telegram->send_message($callback_id, 'Введите суму');
                break;
            default :
                $this->btn($chat_id, $data_request[0], $data_request[1], $callback_id);
                break;
        }
        Log::debug("callback_function " . $data_request[1]);
    }

    private function message_function($request)
    {
        $message = $request->input('message');
        $message_text = $message['text'] ?? null;
        $message_id = $message['chat']['id'] ?? null;
        $template = TelegramTemplate::where('message', $message_text)->first();
        $user = User::where('telegram_id', $message_id)->first() ?? null;
        Log::debug($message_id);
        if ($template) {
            Log::debug("Telegramtemplate");
            switch ($message_text) {
                case '/login':
                    $this->webhookRepository->delete_all_session($message_id);

                    $this->telegram->send_message($message_id, 'Введите свой e-mail');
                    break;
                case '/add_balance':
                    $this->webhookRepository->delete_all_session($message_id);
                    $students = \App\Models\Referal::where('user_1', $user->id)
                        ->leftJoin('users_profiles', 'users_profiles.id', 'referals.id')
                        ->get();
                    $buttonds = ['keyboard' => [[]]];

                    foreach ($students as $item) {
                        $buttons['inline_keyboard'][][] = [
                            'text' => $item->name,
                            'callback_data' => $item->user_1 . "|add_balance"
                        ];
                    }
                    $this->telegram->sendButtons(324428256, "Ученику", $buttonds);
                    break;
            }
        } elseif ($telegram_session = TelegramSession::where('telegram_id', $message_id)->where('status', 1)->first()) {
            $telegram_session->status = 0;
            $telegram_session->save();
            if ($telegram_session->type == 1) { //Login
                if ($telegram_session->text == "start") {
                    if (User::where('email', $message_text)->first()) {
                        $this->webhookRepository->add_session(1, $message_id, $message_text);
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
            }else if($telegram_session->type == 2) { // add_balance
                $get_session = $this->webhookRepository->get_session(2) ?? null;
                if ($get_session) {
                    $this->calendarRepository->add_balance($get_session->text, $message);
                }
            }
        }
        else{
            Log::debug($message_id);
        }
    }

    private function btn($cht_id,$action, $lesson_id, $message_id)
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
        $lesson = Calendar::where('id', $lesson_id)->first();
        $reply_markup = $this->webhookRepository->buttons_bot($lesson_id, $lesson->status);
        $templates_lesson = $this->webhookRepository->templates_lesson($lesson);

        $this->telegram->editButtons($cht_id, $templates_lesson, $reply_markup, $message_id);
        $telegram_chats = TelegramChat::where('calendar_id', $lesson_id)->first();
        if ($telegram_chats){
            $this->telegram->editMessage($telegram_chats->chat_id, $templates_lesson, $telegram_chats->message_id);
        }

        return response()->json(true, 200);
    }
}

//                $message_bot = ["Я то бот. Но согласись что путин хуйло!", "Сам ты бот ушлёпок.", "кто как обзываеться тот так и называеться", "Ботом меня обозвал пидерком себя назвал.", "Шла саша по шосе а ты гандон.", "Ой всё. Я обиделся", "Я тебя по ip вычислю", "Был бы ты на зоне петухом бы тебя назвали", "Ну не обзывайся", "Нет ты бот", "Нет ты ботяра", "Это чат школы бля. а ты хуйнёй страдаешь"];
