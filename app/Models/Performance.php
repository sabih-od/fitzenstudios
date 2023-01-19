<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $guarded = [
        ''
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');      
    }
    public function trainer() {
        
        return $this->hasMany(Trainer::class, 'id', 'trainer_id');
    }

    public function session() {
        return $this->hasOne(CustomerToTrainer::class, 'id', 'session_id');
    }
}
