<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|mixed student_id
 * @property int|mixed professor_id
 * @property int|mixed time_start
 * @property int|mixed day_week
 * @property int|mixed length
 * @property int|mixed status
 * @method static where()
 */
class RegularLesson extends Model
{
    use HasFactory;
}
