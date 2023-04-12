<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColounInCustomerToTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_to_trainers', function (Blueprint $table) {
            $table->unsignedBigInteger('trainer_id')->change();
            $table->unsignedBigInteger('customer_id')->change();
            $table->foreign('trainer_id')
                ->references('id')
                ->on('trainers')
                ->onDelete('cascade');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
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
