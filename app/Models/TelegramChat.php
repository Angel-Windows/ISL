<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|mixed $calendar_id
 * @property mixed $message_id
 * @property mixed $chat_id
 */
class TelegramChat extends Model
{
    use HasFactory;
}
