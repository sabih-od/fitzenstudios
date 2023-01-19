<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function CustomerToTrainer() {
        return $this->hasOne(CustomerToTrainer::class, 'id','cust_to_trainer_id');
    }
}
