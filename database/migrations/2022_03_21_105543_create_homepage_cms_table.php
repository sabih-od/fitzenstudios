<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepageCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage_cms', function (Blueprint $table) {
            $table->id();
            $table->string('banner_heading')->nullable();
            $table->string('banner_sub_heading')->nullable();
            $table->text('banner_content')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('about_heading')->nullable();
            $table->string('about_sub_heading')->nullable();
            $table->text('about_content')->nullable();
            $table->string('about_image')->nullable();
            $table->string('categories_heading')->nullable();
            $table->string('categories_sub_heading')->nullable();
            $table->text('categories_content_one')->nullable();
            $table->string('categories_image_one')->nullable();
            $table->text('categories_content_two')->nullable();
            $table->string('categories_image_two')->nullable();
            $table->text('categories_content_three')->nullable();
            $table->string('categories_image_three')->nullable();
            $table->text('categories_content_four')->nullable();
            $table->string('categories_image_four')->nullable();
            $table->text('categories_content_five')->nullable();
            $table->string('categories_image_five')->nullable();
            $table->text('categories_content_six')->nullable();
            $table->string('categories_image_six')->nullable();
            $table->string('workout_heading')->nullable();
            $table->string('workout_sub_heading')->nullable();
            $table->string('workout_image_one')->nullable();
            $table->string('workout_url_one')->nullable();
            $table->string('workout_image_two')->nullable();
            $table->string('workout_url_two')->nullable();
            $table->string('workout_image_three')->nullable();
            $table->string('workout_url_three')->nullable();
            $table->string('workout_image_four')->nullable();
            $table->string('workout_url_four')->nullable();
            $table->string('testimonial_heading')->nullable();
            $table->string('testimonial_sub_heading')->nullable();
            $table->text('testimonial_content_one')->nullable();
            $table->text('testimonial_content_two')->nullable();
            $table->text('testimonial_content_three')->nullable();
            $table->string('gallery_image_one')->nullable();
            $table->string('gallery_image_two')->nullable();
            $table->string('gallery_image_three')->nullable();
            $table->string('gallery_image_four')->nullable();
            $table->string('gallery_image_five')->nullable();
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
        Schema::dropIfExists('homepage_cms');
    }
}
