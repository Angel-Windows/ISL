<?php

namespace App\Repositories;

use App\Models\Calendar;
use App\Models\RegularLesson;
use App\Models\TelegramTemplate;
use Carbon\Carbon;
use \Auth;
use Illuminate\Database\Eloquent\Model;

class WebhookRepository extends BaseRepository
{
    public function buttons_bot($lesson_id, $type)
    {
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
        foreach (explode('|', $telegram_templates->buttons??"") as $item) {
            $buttons['keyboard'][0][] = [
                'text' => $item,
                'callback_data'=>"callback_datacallback_data"
            ];
        }
        if (isset($buttons['keyboard'][0][0])) {
            return [
                'answer' => $telegram_templates->answer??"",
                'buttons' => $buttons
            ];
        }else{
            return false;
        }

//    dd($buttons);

//    $telegram = new Telegram();
    }
}
