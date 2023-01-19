<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('customer_details', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->integer('trainer_id')->nullable();
            $table->string('owns_fitness_tracker')->nullable();
            $table->string('time_band')->nullable();
            $table->string('training_type')->nullable();
            $table->string('trainer_assigned')->nullable();
            $table->string('total_sessions_in_week')->nullable();
            $table->string('fitness_type')->nullable();
            $table->string('period')->nullable();
            $table->text('workout_experience')->nullable();
            $table->text('life_style')->nullable();
            $table->string('focus_of_workout')->nullable();
            $table->string('workout_type')->nullable();
            $table->string('injuries')->nullable();
            $table->string('med_conditions')->nullable();
            $table->string('on_medication')->nullable();
            $table->string('medical_condition')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_details');
    }
}
