<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerReportsTable extends Migration
{
    public function up()
    {
        Schema::create('customer_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('generic_time_loging_in');
            $table->string('generic_time_loging_out');
            $table->string('generic_pre_workout_meal');
            $table->string('generic_hours_sleep_prev_day');
            $table->string('generic_count_prev_day');
            $table->string('generic_activity_done_prev_day');
            $table->string('generic_count_during_session');
            $table->string('generic_pains_mindful');
            $table->string('generic_mood_energy_level');
            $table->string('generic_average_during_session');
            $table->string('mobility_time_taken');
            $table->string('mobility_difficulty_notice');
            $table->string('core_reps_workout');
            $table->string('core_number_laps');
            $table->string('core_count_prev_day');
            $table->string('core_difficulty_notice');
            $table->longText('core_comments');
            $table->string('speed_agility_reps_workout');
            $table->string('speed_agility_number_laps');
            $table->string('speed_agility_count_prev_day');
            $table->string('speed_agility_difficulty_notice');
            $table->longText('speed_agility_comments');
            $table->string('speed_reps_workout');
            $table->string('speed_number_laps');
            $table->string('speed_count_prev_day');
            $table->string('speed_difficulty_notice');
            $table->longText('speed_comments');
            $table->string('denomination');
            $table->string('kind_weights');
            $table->string('porps');
            $table->longText('comments');
            $table->string('cool_time_taken');
            $table->string('cool_difficulty_notice');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_reports');
    }
}
