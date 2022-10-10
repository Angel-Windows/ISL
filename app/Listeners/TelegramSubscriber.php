<?php

namespace App\Listeners;

use App\Events\LessonStart;
use App\Helpers\Telegram;
use App\Models\User;
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
        $reply_markup = $this->webhookRepository->buttons_bot($event->calendar->id, $event->calendar->status);
        $templates_lesson = $this->webhookRepository->templates_lesson($event->calendar);

        $message_telegram = $this->telegram->sendButtons(env('REPORT_TELEGRAM_ID', "324428256"), $templates_lesson, $reply_markup);
        $student = User::where('id', $event->calendar->student_id)->first();
        if ($student) {
            if ($student_telegramId = $student->telegram_id) {
                $message_telegram = $this->telegram->send_message($student_telegramId, $templates_lesson);
                $this->webhookRepository->add_telegram_chats($message_telegram, $event->calendar->id);
            }
        }
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
