<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('payment_id');
            $table->unsignedInteger('booking_id');
            $table->foreign('booking_id')->references('booking_id')->on('bookings');
            $table->unsignedBigInteger('passenger_id');
            $table->foreign('passenger_id')->references('passenger_id')->on('passengers');
            $table->decimal('amount', 8, 2);
            $table->string('payment_method');
            $table->string('status');
            $table->timestamp('payment_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
