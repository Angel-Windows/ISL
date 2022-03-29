<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(array|array[] $data_filter)
 * @property int|mixed student_id
 * @property int|mixed year
 * @property int|mixed week
 * @property int|mixed day_week
 * @property mixed fool_time
 * @property mixed time_start
 * @property mixed length
 * @property int|mixed|string|null professor_id
 */
class Calendar extends Model
{
    use HasFactory;
    public function getStudentNameAttribute()
    {
        $get_name = UsersProfile::where('user_id' , $this->student_id)
            ->select([
                'first_name',
                'last_name'
            ])
            ->first();
        return $get_name->first_name . ' ' . $get_name->last_name;
    }
}
