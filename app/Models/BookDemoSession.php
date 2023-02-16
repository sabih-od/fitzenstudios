<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookDemoSession extends Model
{
    use HasFactory;
    protected $table     = "demo_session";
    protected $guarded   = [];
    
    public function Customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id')->withDefault();
    }
    public function reviews() {
        return $this->hasMany(Review::class, 'id','session_id')->withDefault();
    }
    
    public function timeZone() {
        return $this->belongsTo(TimeZone::class, 'time_zone', 'id');
    }
}
