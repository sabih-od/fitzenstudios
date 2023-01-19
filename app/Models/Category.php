<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [
        ''
    ];

    public function parent_category()
    {
        return $this->hasMany(self::class, 'id', 'parent_id');
    }

    public function sub_category()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
