<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $guarded   = [];

    use HasFactory;

    public function timeZone() {
        return $this->hasOne(TimeZone::class, 'id', 'time_zone');
    }

    public function sessions()
    {
        return $this->hasMany(CustomerToTrainer::class)->onDelete('cascade');
    }
}

