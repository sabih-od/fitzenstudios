<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $guarded   = [];

    use HasFactory;

    public function timeZone() {
        return $this->hasOne(TimeZone::class, 'timezone_value','time_zone');
    }
}
