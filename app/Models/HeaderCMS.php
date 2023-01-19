<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderCMS extends Model
{
    use HasFactory;
    protected $table     = "header_cms";
    protected $guarded   = [];
}
