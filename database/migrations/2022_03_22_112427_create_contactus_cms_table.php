<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactusCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactus_cms', function (Blueprint $table) {
            $table->id();
            $table->string("banner_heading")->nullable();
            $table->string("banner_image")->nullable();
            $table->string("section_heading")->nullable();
            $table->string("section_sub_heading")->nullable();
            $table->string("location_heading")->nullable();
            $table->string("location")->nullable();
            $table->string("email_heading")->nullable();
            $table->string("email")->nullable();
            $table->string("phone_heading")->nullable();
            $table->string("phone")->nullable();
            $table->text("map")->nullable();
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
        Schema::dropIfExists('contactus_cms');
    }
}
