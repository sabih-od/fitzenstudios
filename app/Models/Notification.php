<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function receiver_user()
    {
        return $this->hasOne(User::class, 'id', 'receiver_id');
    }

    public function sender_user()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }
}
