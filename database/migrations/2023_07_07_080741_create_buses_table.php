<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->increments('bus_id');
            $table->string('registration_number')->unique();
            $table->string('bus_model');
            $table->unsignedInteger('seating_capacity');
            $table->string('status');
            $table->timestamps();

            
        });
    }

    public function down()
    {
        Schema::dropIfExists('buses');
    }
}
