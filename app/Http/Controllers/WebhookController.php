<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use App\Models\Calendar;
use App\Repositories\CalendarRepository;
use App\Repositories\GlobalRepository;
use App\Repositories\WebhookRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{

    private $telegram;
//    private $globalRepository;
    private $calendarRepository;
    private $webhookRepository;

    /**
     * @param Telegram $telegram
     */

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
//        $this->globalRepository = app(GlobalRepository::class);
        $this->calendarRepository = app(CalendarRepository::class);
        $this->webhookRepository = app(WebhookRepository::class);
    }

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        Log::debug($request->all());
        $callback_data = $request->input('callback_query')['data'] ?? null;
        $message = $request->input('message') ?? null;

        if (strripos($callback_data, '|')) {
            $data_request = explode('|', $callback_data);
            $action = $data_request[0] ?? 0;
            $lesson_id = $data_request[1] ?? 0;
            $calendar = Calendar::where('id', $lesson_id)->first();
            if (!$calendar){
                Log::debug("data_request:" . $callback_data);
                return response()->json(true, 200);
            }

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

            $data = [
                'id' => $calendar->id,
                'professor' => $calendar->professor_id,
                'student' => $calendar->student_id,
                'day' => $calendar->fool_time,
                'time' => $calendar->time_start,
            ];
            $this->telegram->editButtons(
                env('REPORT_TELEGRAM_ID', "324428256"),
                (string)view('bot_messages.lesson_check', $data),
                $reply_markup,
                $request->input('callback_query')['message']['message_id']
            );
            return response()->json(true, 200);
        } elseif ($message) {
            $message_id = $message['chat']['id'];
            $message_text = $message['text'];
            $message = "Привет пупсик. пообщаемся?";
            if ($message_text == "бот") {
                $message_bot = ["Я то бот. Но согласись что путин хуйло!", "Сам ты бот ушлёпок.", "кто как обзываеться тот так и называеться", "Ботом меня обозвал пидерком себя назвал.", "Шла саша по шосе а ты гандон.","Ой всё. Я обиделся", "Я тебя по ip вычислю","Был бы ты на зоне петухом бы тебя назвали", "Ну не обзывайся", "Нет ты бот", "Нет ты ботяра"];
//                $message = ""
                $message = array_rand($message_bot);
            }
            $this->telegram->send_message($message_id, $message);

            Log::debug("Message id:" . $message_id);
            Log::debug("Message text:" . $message_text);
            Log::debug("Message text:" . json_encode($message_text));
            Log::debug("Message text:" . json_decode($message_text));
        }
        return response()->json(true, 200);
    }
}
