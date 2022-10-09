<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|mixed $type
 * @property int|mixed $status
 * @property int|mixed $telegram_id
 * @property mixed|string $text
 * @method static where()
 */
class TelegramSession extends Model
{
    use HasFactory;
}
