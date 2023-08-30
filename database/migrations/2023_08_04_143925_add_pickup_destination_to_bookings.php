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
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedInteger('pickup_route_id')->nullable();
            $table->unsignedInteger('destination_route_id')->nullable();
    
            // Add foreign keys to the 'routes' table
            $table->foreign('pickup_route_id')->references('route_id')->on('routes');
            $table->foreign('destination_route_id')->references('route_id')->on('routes');
        });
    }
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['pickup_route_id']);
            $table->dropForeign(['destination_route_id']);
    
            $table->dropColumn('pickup_route_id');
            $table->dropColumn('destination_route_id');
        });
    }

};
