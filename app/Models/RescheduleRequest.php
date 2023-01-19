<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RescheduleRequest extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function sessions() {
        return $this->hasMany(CustomerToTrainer::class,'id','customer_to_trainer_id');
    }
}
