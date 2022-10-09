<?php

namespace App\Listeners;

use App\Events\LessonStart;
use App\Helpers\Telegram;
use App\Models\TelegramChat;
use App\Models\User;
use App\Models\UsersProfile;
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
        $professor_profiles = UsersProfile::where('id', $event->calendar->professor_id)->first();
        $student_profiles = UsersProfile::where('id', $event->calendar->student_id)->first();

        $data = [
            'id' => $event->calendar->id,
            'professor' => $professor_profiles->name,
            'student' => $student_profiles->name,
            'day' => $event->calendar->fool_time,
            'time' => $event->calendar->time_start,
            'status' => $event->calendar->status,
        ];
        if($event->calendar->status == 0 || $event->calendar->student_id == 3){
            $type = 0;
        }else{
            $type = 1;
        }
        $reply_markup = $this->webhookRepository->buttons_bot($event->calendar->id, $type);

        $message_telegram = $this->telegram->sendButtons(env('REPORT_TELEGRAM_ID', "324428256"), (string)view('bot_messages.lesson_check', $data), $reply_markup);
        $student = User::where('id', $event->calendar->student_id)->first();
        if ($student) {
            if ($student_telegramId = $student->telegram_id) {
                $message_telegram = $this->telegram->send_message($student_telegramId, (string)view('bot_messages.lesson_check', $data));
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
