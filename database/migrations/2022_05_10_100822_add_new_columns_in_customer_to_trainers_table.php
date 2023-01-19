<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsInCustomerToTrainersTable extends Migration
{
    public function up()
    {
        Schema::table('customer_to_trainers', function (Blueprint $table) {
            $table->string('session_type')->nullable();
            $table->string('status')->default('upcoming');
        });
    }

    public function down()
    {
        Schema::table('customer_to_trainers', function (Blueprint $table) {
            //
        });
    }
}
