<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemoSessionTable extends Migration
{
    
    public function up()
    {
        Schema::create('demo_session', function (Blueprint $table) {
            $table->id();
            $table->date("session_date")->nullable();
            $table->time("session_time")->nullable();
            $table->text("goals")->nullable();
            $table->text("message")->nullable();
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
        Schema::dropIfExists('demo_session');
    }
}
