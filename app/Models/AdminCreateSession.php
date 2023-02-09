<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCreateSession extends Model
{
    use HasFactory;

    protected  $table = 'admin_create_sessions';
//    protected $fillable =[
//        'trainer',
//        'customers',
//        'session_type',
//        'time_zone',
//        'trainer',
//        'message',
//        'session_date',
//        'session_time',
//    ];

}
