<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms_cms', function (Blueprint $table) {
            $table->id();
            $table->string('banner_heading')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('section_heading')->nullable();
            $table->longText('section_content')->nullable();
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
        Schema::dropIfExists('terms_cms');
    }
}
