<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFewColumnsInCustomerToTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_to_trainers', function (Blueprint $table) {
            $table->string('trainer_timezone_date')->nullable();
            $table->string('trainer_timezone_time')->nullable();
            $table->string('customer_timezone_date')->nullable();
            $table->string('customer_timezone_time')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_to_trainers', function (Blueprint $table) {
            //
        });
    }
}
