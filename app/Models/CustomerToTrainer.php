<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerToTrainer extends Model
{
     protected $fillable = ['customer_id', 'trainer_id', 'trainer_date', 'trainer_time', 'notes', 'session_type', 'status'];
    use HasFactory;
    protected $guarded = [];

    public function getFormattedStatusAttribute() {
        return ucfirst($this->status);
    }

//    public function customer()
//    {
//        return $this->belongsTo(Customer::class)->withTrashed();
//    }
//
//    public function trainer()
//    {
//        return $this->belongsTo(Trainer::class)->withTrashed();
//    }
    public function customer(){
        return $this->hasOne(Customer::class, 'id', 'customer_id')->withTrashed();
    }

    public function trainer(){
        return $this->hasOne(Trainer::class, 'id', 'trainer_id')->withTrashed();
    }

    public function sessions() {
        return $this->hasOne(BookDemoSession::class, 'id', 'demo_session_id');
    }

    public function reviews() {
        return $this->belongsTo(Review::class, 'id','cust_to_trainer_id');
    }

    public function request_session() {
        return $this->hasOne(RescheduleRequest::class, 'customer_to_trainer_id', 'id');
    }

    // public function timeZone() {
    //     return $this->hasOne(TimeZone::class, 'timezone_value','time_zone');
    // }

    public function timeZone() {
        return $this->hasOne(TimeZone::class, 'id','time_zone');
    }

}
