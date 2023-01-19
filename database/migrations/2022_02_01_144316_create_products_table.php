<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('manufacturer_id');
            $table->string('name');
            $table->string('short_description')->nullable();
            $table->string('description')->nullable();
            $table->decimal('price', 8, 3)->default(0);
            $table->string('photo')->nullable();
            $table->string('model')->nullable();
            $table->string('year')->nullable();
            $table->string('condition')->nullable();
            $table->string('stock_number')->nullable();
            $table->integer('hours')->nullable();
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
        Schema::dropIfExists('products');
    }
}
