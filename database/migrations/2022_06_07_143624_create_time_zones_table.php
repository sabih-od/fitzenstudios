<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeZonesTable extends Migration
{

    public function up()
    {
        Schema::create('time_zones', function (Blueprint $table) {
            $table->id();
            $table->string('abbreviation')->nullable();
            $table->string('zone_name')->nullable();
            $table->string('time_zone')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('time_zones');
    }
}
