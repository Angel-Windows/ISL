<?php

namespace App\Events;

use App\Models\Calendar;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LessonStart
{
    public $calendar;

    public function __construct(Calendar $calendar)
    {
        $this->calendar = $calendar;
    }

}
