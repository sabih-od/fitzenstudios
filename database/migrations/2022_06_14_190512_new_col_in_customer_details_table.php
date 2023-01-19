<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewColInCustomerDetailsTable extends Migration
{

    public function up()
    {
        Schema::table('customer_details', function (Blueprint $table) {
            $table->time('detail_time')->after('time_band')->nullable();
        });
    }

    public function down()
    {
        Schema::table('customer_details', function (Blueprint $table) {
            //
        });
    }
}
