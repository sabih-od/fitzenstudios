<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
    protected $guarded = [
        ''
    ];

    public function customers() {
        return $this->hasOne(Customer::class,'id','customer_id');
    }
}
