<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('age')->nullable();
            $table->string('weight')->nullable();
            $table->string('nationality')->nullable();
            $table->string('residence')->nullable();
            $table->string('city')->nullable();
            $table->string('timezone')->nullable();
            $table->string('photo')->nullable();
            $table->string('days')->nullable();
            $table->string('sessions_in_week')->nullable();
            $table->string('training_type')->nullable();
            $table->integer('tariner_id')->nullable();            
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
        Schema::dropIfExists('customers');
    }
}
