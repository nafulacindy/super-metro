<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('booking_id');
            $table->unsignedBigInteger('passenger_id');
            $table->unsignedInteger('bus_id');
            $table->string('pickup_location');
            $table->string('destination');
            $table->dateTime('scheduled_time');
            $table->string('status');
            $table->timestamps();

            $table->foreign('passenger_id')->references('passenger_id')->on('passengers');
            $table->foreign('bus_id')->references('bus_id')->on('buses');
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
