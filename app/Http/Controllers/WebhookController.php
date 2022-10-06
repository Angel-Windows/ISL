<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    private $telegram;
    public function __construct(Telegram $telegram){
        $this->telegram = $telegram;
    }
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $data_request = explode('|', $request->input('callback_query')['data']);
        $action = $data_request[0];
        $lesson_id = $data_request[1];
        $lesson = Calendar::where('id', $lesson_id)->first();

        switch ($action){
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
                $lesson->status = 0;
                $lesson->save();
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
                $lesson->status = 3;
                $lesson->save();
                break;
        }
        $data = [
            'id' => $event->calendar->id,
            'professor' => $event->calendar->professor_id,
            'student' => $event->calendar->student_id,
            'day' => $event->calendar->fool_time,
            'time' => $event->calendar->time_start,
        ];

        $this->telegram->editButtons(env('REPORT_TELEGRAM_ID', "324428256"), (string)view('bot_messages.lesson_check', $data, 1), $reply_markup, explode('|', $request->input('message')['message_id']));
        return response()->json(true, 200);
    }
}
