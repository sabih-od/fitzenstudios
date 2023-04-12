<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RescheduleRequest extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $softDelete = true;
    protected $guarded = [];

    public function sessions() {
        return $this->hasMany(CustomerToTrainer::class,'id','customer_to_trainer_id');
    }

    //  public function timeZone() {
    //     return $this->belongsTo(TimeZone::class, 'id','time_zone');
    // }

     public function timeZone() {
        return $this->hasOne(TimeZone::class, 'id','time_zone');
    }
}
