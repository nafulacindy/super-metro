<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->increments('route_id');
            $table->unsignedInteger('bus_id');
            $table->foreign('bus_id')->references('bus_id')->on('buses');
            $table->string('start_location');
            $table->string('end_location');
            $table->decimal('distance');
            $table->integer('duration');
            $table->decimal('fare');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('routes');
    }
};
