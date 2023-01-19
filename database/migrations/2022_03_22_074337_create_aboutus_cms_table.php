<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutusCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aboutus_cms', function (Blueprint $table) {
            $table->id();
            $table->string('banner_heading')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('section_one_heading')->nullable();
            $table->text('section_one_content')->nullable();
            $table->text('section_one_extra_content')->nullable();
            $table->string('section_one_image')->nullable();
            $table->string('section_two_heading')->nullable();
            $table->text('section_two_content')->nullable();
            $table->string('section_two_image')->nullable();
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
        Schema::dropIfExists('aboutus_cms');
    }
}
