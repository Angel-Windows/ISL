<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where()
 */
class UsersProfile extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','name', 'currency', 'balance'];
//    protected $fillable = ['user_id','first_name','last_name', 'currency', 'balance'];
}
