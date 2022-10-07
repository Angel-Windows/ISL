<?php

namespace App\Listeners;

use App\Events\LessonStart;
use App\Helpers\Telegram;
use App\Repositories\WebhookRepository;


class TelegramSubscriber
{

    protected $telegram;
    private $webhookRepository;
    public function __construct(Telegram $telegram)
    {
        $this->webhookRepository = app(WebhookRepository::class);
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
        if($event->calendar->status == 0 || $event->calendar->student_id == 3){
            $type = 0;
        }else{
            $type = 1;
        }
        $reply_markup = $this->webhookRepository->buttons_bot($event->calendar->id, $type);
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
