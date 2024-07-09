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
        Schema::create('lost_item_reports', function (Blueprint $table) {
            $table->id();
            $table->string('bus_registration');
            $table->date('travel_date');
            $table->text('luggage_description');
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
        Schema::dropIfExists('lost_item_reports');
    }
};
