<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSllerVehicleTypeReviewsVehicle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('sellers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->integer('seller_type_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->date('year');
            $table->string('make');
            $table->string('model');
            $table->double('price', 8, 2);
            $table->longText('meta_deta')->nullable();;
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('types');
            $table->integer('seller_id')->unsigned();
            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->timestamps();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path')->unique();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('image_vehicle', function (Blueprint $table) {
            $table->integer('vehicle_id')->unsigned();
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->integer('image_id')->unsigned();
            $table->foreign('image_id')->references('id')->on('images');
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('comment');
            $table->integer('seller_id')->unsigned();
            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->integer('vehicle_id')->unsigned();
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
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
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('vehicle_image');
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('types');
        Schema::dropIfExists('sellers');
        Schema::dropIfExists('images');
        Schema::dropIfExists('sellers');
        Schema::dropIfExists('seller_type');
    }
}
