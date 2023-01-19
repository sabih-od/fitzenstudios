<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [
        ''
    ];

    public function Manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id', 'id')->withDefault();
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
