<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFooterCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_cms', function (Blueprint $table) {
            $table->id();
            $table->string("footer_image")->nullable();
            $table->string("heading_one")->nullable();
            $table->string("link_one")->nullable();
            $table->string("link_two")->nullable();
            $table->string("link_three")->nullable();
            $table->string("link_four")->nullable();
            $table->string("heading_two")->nullable();
            $table->string("heading_three")->nullable();
            $table->string("facebook_link")->nullable();
            $table->string("twitter_link")->nullable();
            $table->string("instagram_link")->nullable();
            $table->string("linkedin_link")->nullable();
            $table->string("note")->nullable();
            $table->string("logo_image")->nullable();
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
        Schema::dropIfExists('footer_cms');
    }
}
