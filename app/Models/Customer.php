<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

    public function trainer()
    {
        return $this->hasOne(CustomerToTrainer::class, 'customer_id', 'id')->join('trainers', 'trainers.id', 'customer_to_trainers.trainer_id')->withDefault();      
    }
    
    public function timeZone() {
        return $this->belongsTo(TimeZone::class, 'time_zone', 'id');
    }
}
