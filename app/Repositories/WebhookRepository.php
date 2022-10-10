<?php

namespace App\Repositories;


use App\Models\TelegramChat;
use App\Models\TelegramSession;
use App\Models\TelegramTemplate;
use App\Models\UsersProfile;

class WebhookRepository extends BaseRepository
{
    public function buttons_bot($lesson_id, $status)
    {
        if ($status == 0 || $status == 3) {
            $type = 0;
        } else {
            $type = 1;
        }
        switch ($type) {
            case 0:
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
                break;
            case 1:
                $reply_markup = [
                    'inline_keyboard' =>
                        [
                            [
                                [
                                    'text' => 'Принять',
                                    'callback_data' => '1|' . $lesson_id,
                                ],
                                [
                                    'text' => 'Отклонить',
                                    'callback_data' => '2|' . $lesson_id,
                                ],
                            ]
                        ]
                ];
                break;
            default :
                return 0;
        }
        return $reply_markup;
    }

    public function bd_answer_templates($message)
    {
        $telegram_templates = TelegramTemplate::where('message', $message)->first();
        $buttons = ['keyboard' => [[]]];
        foreach (explode('|', $telegram_templates->buttons ?? "") as $item) {
            $buttons['keyboard'][0][] = [
                'text' => $item,
                'callback_data' => "callback_datas"
            ];
        }
        if (isset($buttons['keyboard'][0][0])) {
            return [
                'answer' => $telegram_templates->answer ?? "",
                'buttons' => $buttons
            ];
        } else {
            return false;
        }

//    dd($buttons);

//    $telegram = new Telegram();
    }

    public function add_telegram_chats($message_telegram, $calendar_id)
    {
        $message_request = json_decode($message_telegram->body());
        $chat_id = $message_request->result->chat->id;
        $telegram_chats = new TelegramChat();
        $telegram_chats->message_id = $message_request->result->message_id;
        $telegram_chats->calendar_id = $calendar_id;
        $telegram_chats->chat_id = $chat_id;
        $telegram_chats->save();
    }

    public function delete_all_session($telegram_id)
    {
        $telegramSession = TelegramSession::where('telegram_id', $telegram_id)->delete();
    }

    public function templates_lesson($calendar): string
    {
        $professor_profiles = UsersProfile::where('id', $calendar->professor_id)->first();
        $student_profiles = UsersProfile::where('id', $calendar->student_id)->first();
        $status = ['Проведенно', 'Запланированно', 'Пернеос', 'Отменен'];
        $data = [
            'id' => $calendar->id,
            'professor' => $professor_profiles->name,
            'student' => $student_profiles->name,
            'day' => $calendar->fool_time,
            'time' => $calendar->time_start,
            'status' => $status[$calendar->status],
            'balance' => $student_profiles->balance,
        ];

        return (string)view('bot_messages.lesson_check', $data);
    }
}
