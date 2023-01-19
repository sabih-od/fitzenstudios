<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\HomePageCMSController;
class HomepageCMS extends Model
{
    protected $table     = "homepage_cms";
    protected $guarded   = [];
    use HasFactory;

}
