<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('field1')->nullable();
            $table->string('field2')->nullable();
            $table->string('field3')->nullable();
            $table->string('field4')->nullable();
            $table->string('field5')->nullable();
            $table->string('session_duration')->nullable();
            $table->string('total_sessions')->nullable();
            $table->string('session_price')->nullable();
            $table->string('discounted_price')->nullable();
            $table->string('no_of_days')->nullable();
            $table->string('client_name')->nullable();
            $table->date('client_date')->nullable();
            $table->string('client_siganture')->nullable();
            $table->string('company_name')->nullable();
            $table->date('company_date')->nullable();
            $table->string('company_signature')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
