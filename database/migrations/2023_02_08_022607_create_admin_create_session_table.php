<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminCreateSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_create_sessions', function (Blueprint $table) {
            $table->string('trainer');
            $table->string('customers');
            $table->string('session_type');
            $table->string('time_zone');
            $table->string('trainer');
            $table->string('message');
            $table->string('session_date');
            $table->string('session_time');
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
        Schema::dropIfExists('admin_create_session');
    }
}
