<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('category_id')->unsigned();
            $table->string('discription')->nullable();
            $table->time('open_time');
            $table->time('close_time');
            $table->integer('price_range')->nullable();
            $table->string('postal_code');
            $table->string('address');
            $table->string('phone_number');
            $table->string('holiday')->nullable();
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
        Schema::dropIfExists('stores');
    }
};
