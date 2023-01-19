<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInHomepageCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('homepage_cms', function (Blueprint $table) {
            $table->string('testimonial_author_one')->nullable();
            $table->string('testimonial_author_two')->nullable();
            $table->string('testimonial_author_three')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('homepage_cms', function (Blueprint $table) {
            //
        });
    }
}
