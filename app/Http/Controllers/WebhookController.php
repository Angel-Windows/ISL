<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use App\Models\Calendar;
use App\Repositories\CalendarRepository;
use App\Repositories\GlobalRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class WebhookController extends Controller
{
    private $telegram;
    private $globalRepository;
    private $calendarRepository;

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
        $this->globalRepository = app(GlobalRepository::class);
        $this->calendarRepository = app(CalendarRepository::class);
    }

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $callback_data = $request->input('callback_query')['data']??"";
        if (strripos($callback_data, '|')) {
            $data_request = explode('|', $callback_data);
            $action = $data_request[0] ?? 0;
            $lesson_id = $data_request[1] ?? 0;
            $calendar = Calendar::where('id', $lesson_id)->first();
            switch ($action) {
                case "1":
                    $reply_markup = [
                        'inline_keyboard' =>
                            [
                                [
                                    [
                                        'text' => 'Отменить',
                                        'callback_data' => '3|' . $lesson_id,
                                    ],
                                ]
                            ]
                    ];
                    $this->calendarRepository->success_lesson();
                    break;
                case "2":
                    $reply_markup = [
                        'inline_keyboard' =>
                            [
                                [
                                    [
                                        'text' => 'Отменить',
                                        'callback_data' => '3|' . $lesson_id,
                                    ],
                                ]
                            ]
                    ];
                    $this->calendarRepository->closed_lesson();
                    break;
                case "3":
                    $reply_markup = [
                        'inline_keyboard' =>
                            [
                                [
                                    [
                                        'text' => 'Принять',
                                        'callback_data' => '1|' . $lesson_id,
                                    ],
                                    [
                                        'text' => '✓ Отклонить',
                                        'callback_data' => '2|' . $lesson_id,
                                    ],
                                ]
                            ]
                    ];
                    $this->calendarRepository->back_lesson();
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
        }
        return response()->json(true, 200);
    }
}
