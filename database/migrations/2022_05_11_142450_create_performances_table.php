<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformancesTable extends Migration
{
    
    public function up()
    {
        Schema::create('performances', function (Blueprint $table) {
            $table->id();
            $table->integer('session_id')->nullable();
            $table->integer('trainer_id')->nullable();
            $table->string('time_login')->nullable();
            $table->string('time_logout')->nullable();
            $table->string('per_workout_meal')->nullable();
            $table->string('hours_of_sleep_prev_day')->nullable();
            $table->string('step_count_prev_day')->nullable();
            $table->string('prev_day_activity')->nullable();
            $table->string('calories_count_during_session')->nullable();
            $table->string('any_aches_or_pains')->nullable();
            $table->string('mood_and_energy_level')->nullable();
            $table->string('avg_heart_rate_during_session')->nullable();
            $table->string('time_taken')->nullable();
            $table->string('any_difficulty_noticed')->nullable();
            $table->string('no_of_reps_for_each_workout')->nullable();
            $table->string('no_of_laps')->nullable();
            $table->string('stipulated_time')->nullable();
            $table->string('difficulty')->nullable();
            $table->text('additional_comments')->nullable();
            $table->string('agility_workout')->nullable();
            $table->string('agility_no_of_laps')->nullable();
            $table->string('agility_stipulated_time')->nullable();
            $table->string('agility_difficulty_noticed')->nullable();
            $table->text('agility_add_comments')->nullable();
            $table->string('resistance_workout')->nullable();
            $table->string('resistance_no_of_laps')->nullable();
            $table->string('resistance_stipulated_time')->nullable();
            $table->string('resistance_difficulty_noticed')->nullable();
            $table->text('resistance_add_comments')->nullable();
            $table->string('denomination')->nullable();
            $table->string('type_of_props')->nullable();
            $table->string('denomination_stipulated_time')->nullable();
            $table->text('denomination_add_comments')->nullable();
            $table->string('stretches_time_taken')->nullable();
            $table->string('stretches_difficulty_noticed')->nullable();
            $table->string('status')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('performances');
    }
}
