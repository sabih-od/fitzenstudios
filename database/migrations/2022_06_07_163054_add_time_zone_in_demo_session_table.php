<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimeZoneInDemoSessionTable extends Migration
{
    
    public function up()
    {
        Schema::table('demo_session', function (Blueprint $table) {
            $table->string('time_zone')->after('id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('demo_session', function (Blueprint $table) {
            //
        });
    }
}
