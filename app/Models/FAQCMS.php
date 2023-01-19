<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQCMS extends Model
{
    protected $table     = "faqs_cms";
    protected $guarded   = [];
    use HasFactory;
}
