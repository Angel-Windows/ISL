<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    private $telegram;

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
    }

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $data_request = explode('|', $request->input('callback_query')['data']);
        $action = $data_request[0];
        $lesson_id = $data_request[1];
        $calendar = Calendar::where('id', $lesson_id)->first();

        switch ($action) {
            case "1":
                $reply_markup = [
                    'inline_keyboard' =>
                        [
                            [
                                [
                                    'text' => '✓ Принять',
                                    'callback_data' => '1|' . $lesson_id,
                                ],
                                [
                                    'text' => 'Отклонить',
                                    'callback_data' => '2|' . $lesson_id,
                                ],
                            ]
                        ]
                ];
                $calendar->status = 0;
                $calendar->save();
                break;
            case "2":
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
                $calendar->status = 3;
                $calendar->save();
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
//        $this->telegram->editButtons(
//            env('REPORT_TELEGRAM_ID', "324428256"),
//            (string)view('bot_messages.lesson_check', $data),
//            $reply_markup,
//            explode('|', $request->input('callback_query')['message']['message_id'])
//        );
        $this->telegram->get_button(env('REPORT_TELEGRAM_ID', "324428256"), 'test', (string)view('bot_messages.lesson_check', $data));
        return response()->json(true, 200);
    }
}
