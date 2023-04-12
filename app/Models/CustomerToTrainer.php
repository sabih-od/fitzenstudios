<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerToTrainer extends Model
{
    // protected $fillable = ['customer_id', 'trainer_id', 'trainer_date', 'trainer_time', 'notes', 'session_type', 'status'];
    use HasFactory;
    use SoftDeletes;

    protected $softDelete = true;
    protected $guarded = [];

    public function getFormattedStatusAttribute() {
        return ucfirst($this->status);
    }

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

    public function request_session() {
        return $this->hasOne(RescheduleRequest::class, 'customer_to_trainer_id', 'id');
    }

    // public function timeZone() {
    //     return $this->hasOne(TimeZone::class, 'timezone_value','time_zone');
    // }

    public function timeZone() {
        return $this->hasOne(TimeZone::class, 'id','time_zone');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($customerToTrainer) {
            $customerToTrainer->request_session->delete();
        });
    }

}
