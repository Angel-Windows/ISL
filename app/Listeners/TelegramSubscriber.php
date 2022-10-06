<?php

namespace App\Listeners;

use App\Events\LessonStart;
use App\Helpers\Telegram;


class TelegramSubscriber
{

    protected $telegram;

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * Create the event listener.
     *
     * @param LessonStart $event
     * @return void
     */
    public function lessonsStore(LessonStart $event)
    {
        $data = [
            'id' => $event->calendar->id,
            'professor' => $event->calendar->professor_id,
            'student' => $event->calendar->student_id,
            'day' => $event->calendar->fool_time,
            'time' => $event->calendar->time_start,
        ];
        $reply_markup = [
            'inline_keyboard' =>
                [
                    [
                        [
                            'text' => 'Принять',
                            'callback_data' => '1|' . $event->calendar->id,
                        ],
                        [
                            'text' => 'Отклонить',
                            'callback_data' => '2|' . $event->calendar->id,
                        ],
                    ]
                ]
        ];
        $this->telegram->sendButtons(env('REPORT_TELEGRAM_ID', "324428256"), (string)view('bot_messages.lesson_check', $data), $reply_markup);
    }

    public function subscribe($events)
    {
        $events->listen(
            LessonStart::class, [
                TelegramSubscriber::class, 'lessonsStore'
            ]
        );

    }
}
