<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
