<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnInCustomerToTrainersTable extends Migration
{
    public function up()
    {
        Schema::table('customer_to_trainers', function (Blueprint $table) {
            $table->integer('demo_session_id')->after('id');
        });
    }

    public function down()
    {
        Schema::table('customer_to_trainers', function (Blueprint $table) {
            //
        });
    }
}
