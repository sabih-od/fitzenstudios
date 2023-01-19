<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInTrainersTable extends Migration
{
    public function up()
    {
        Schema::table('trainers', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('age')->nullable();
            $table->string('weight')->nullable();
            $table->string('nationality')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('days_available')->nullable();
            $table->string('no_of_session_in_week')->nullable();
            $table->text('description')->nullable();
        });
    }

    public function down()
    {
        Schema::table('trainers', function (Blueprint $table) {
            //
        });
    }
}
