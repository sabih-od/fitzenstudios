<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentToTrainersTable extends Migration
{
    public function up()
    {
        Schema::create('payment_to_trainers', function (Blueprint $table) {
            $table->id();
            $table->integer('trainer_id');
            $table->string('slip');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_to_trainers');
    }
}
