<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where()
 * @method static get()
 * @method static first()
 * @property int|mixed $status
 * @property mixed $new_balance
 * @property mixed $professor_id
 * @property mixed $student_id
 * @property mixed $lesson_id
 * @property mixed $amount
 * @property int|mixed $type
 */
class Transactions extends Model
{
    use HasFactory;
}
