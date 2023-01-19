<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInCustomerDetailsTable extends Migration
{
  
    public function up()
    {
        Schema::table('customer_details', function (Blueprint $table) {
            $table->string('customer_name')->after('id')->nullable();
            $table->string('trainer_name')->after('customer_name')->nullable();
            $table->text('feedback')->after('trainer_name')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_details', function (Blueprint $table) {
            //
        });
    }
}
