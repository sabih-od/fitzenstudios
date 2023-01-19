<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerToTrainer extends Model
{
    // protected $fillable = ['customer_id', 'trainer_id', 'trainer_date', 'trainer_time', 'notes', 'session_type', 'status'];
    use HasFactory;
    protected $guarded = [];
    
    public function customer(){
        return $this->hasOne(Customer::class, 'id', 'customer_id')->withDefault();  
    }

    public function trainer(){
        return $this->hasOne(Trainer::class, 'id', 'trainer_id')->withDefault();  
    }

    public function sessions() {
        return $this->hasOne(BookDemoSession::class, 'id', 'demo_session_id');
    }
    public function reviews() {
        return $this->belongsTo(Review::class, 'id','cust_to_trainer_id');
    }
}
