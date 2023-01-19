<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOneColumnInCustomerToTrainersTable extends Migration
{
   
    public function up()
    {
        Schema::table('customer_to_trainers', function (Blueprint $table) {
            $table->text('start_url')->nullable();
            $table->string('join_url')->nullable();
            $table->string('meeting_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('customer_to_trainers', function (Blueprint $table) {
            //
        });
    }
}
