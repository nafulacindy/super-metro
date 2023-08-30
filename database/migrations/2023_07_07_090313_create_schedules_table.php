<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('schedule_id');
            $table->unsignedInteger('route_id');
            $table->foreign('route_id')->references('route_id')->on('routes');
            $table->unsignedInteger('bus_id');
            $table->foreign('bus_id')->references('bus_id')->on('buses');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->date('schedule_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
