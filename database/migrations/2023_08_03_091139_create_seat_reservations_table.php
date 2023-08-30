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

Schema::create('seat_reservations', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id')->nullable();
    $table->unsignedBigInteger('passenger_id')->nullable();
    $table->unsignedInteger('booking_id');
    $table->unsignedInteger('bus_id');
    $table->integer('seat_number');
    // Add any other columns you may need for seat reservations

    $table->timestamps();

    // Add foreign key constraints
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('passenger_id')->references('passenger_id')->on('passengers')->onDelete('cascade');
    $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
    $table->foreign('bus_id')->references('bus_id')->on('buses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seat_reservations');
    }
};
