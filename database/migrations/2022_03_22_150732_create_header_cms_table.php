<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_cms', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('link_one')->nullable();
            $table->string('link_two')->nullable();
            $table->string('link_three')->nullable();
            $table->string('link_four')->nullable();
            $table->string('link_five')->nullable();
            $table->string('link_six')->nullable();
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
        Schema::dropIfExists('header_cms');
    }
}
