<?php

namespace App\Repositories;

use App\Models\Calendar;
use App\Models\RegularLesson;
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
}
