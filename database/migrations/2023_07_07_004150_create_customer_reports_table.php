<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_reports', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->string('generic_time_loging_in')->nullable();
            $table->string('generic_time_loging_out')->nullable();
            $table->string('generic_pre_workout_meal')->nullable();
            $table->string('generic_hours_sleep_prev_day')->nullable();
            $table->string('generic_count_prev_day')->nullable();
            $table->string('generic_count_during_session')->nullable();
            $table->string('mobility_time_taken')->nullable();
            $table->string('mobility_difficulty_notice')->nullable();
            $table->string('core_reps_workout')->nullable();
            $table->string('core_number_laps')->nullable();
            $table->string('core_count_prev_day')->nullable();
            $table->string('core_difficulty_notice')->nullable();
            $table->longText('core_comments')->nullable();
            $table->string('speed_agility_reps_workout')->nullable();
            $table->string('speed_agility_number_laps')->nullable();
            $table->string('speed_agility_count_prev_day')->nullable();
            $table->string('speed_agility_difficulty_notice')->nullable();
            $table->longText('speed_agility_comments')->nullable();
            $table->string('speed_reps_workout')->nullable();
            $table->string('speed_number_laps')->nullable();
            $table->string('speed_count_prev_day')->nullable();
            $table->string('speed_difficulty_notice')->nullable();
            $table->longText('speed_comments')->nullable();
            $table->string('denomination')->nullable();
            $table->string('kind_weights')->nullable();
            $table->string('porps')->nullable();
            $table->longText('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_reports');
    }
}
