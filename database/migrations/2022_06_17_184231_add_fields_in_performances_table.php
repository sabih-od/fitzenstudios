<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInPerformancesTable extends Migration
{
    public function up()
    {
        Schema::table('performances', function (Blueprint $table) {
            $table->integer('demo_session_id')->after('id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('performances', function (Blueprint $table) {
            //
        });
    }
}
