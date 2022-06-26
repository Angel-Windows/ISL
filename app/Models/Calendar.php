<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(mixed $data_filter)
 * @method static whereIn(string $string, $data_day_time)
 * @property int|mixed student_id
 * @property int|mixed year
 * @property int|mixed week
 * @property int|mixed|string|null day_week
 * @property mixed fool_time
 * @property mixed time_start
 * @property mixed length
 * @property int|mixed|string|null professor_id
 */
class Calendar extends Model
{
    protected $guarded = array('*');
    use HasFactory;
    public function getStudentNameAttribute()
    {
        $get_name = UsersProfile::where('user_id' , $this->student_id)
            ->select([
                'name',
//                'last_name'
            ])
            ->first();
        return $get_name->name;
//        return $get_name->first_name . ' ' . $get_name->last_name;
    }
}
