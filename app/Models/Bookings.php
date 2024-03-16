<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Bus;
use App\Models\Passenger;

class Bookings extends Model
{
    use HasFactory;
    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'passenger_id',
        'bus_id',
        'pickup_location',
        'destination',
        'scheduled_time',
        'status',
    ];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'schedule_id');
    }

    public function bus(): BelongsTo
{
    return $this->belongsTo(Bus::class, 'bus_id', 'bus_id');
}
    // public function calculateFare()
    // {
    //     // Retrieve the route assigned to this booking
    //     $route = $this->route;

    //     if (!$route) {
    //         // Handle if route is not found
    //         return 0;
    //     }

    //     // Get the fare of the route
    //     $fare = $route->fare;

    //     return $fare;
    // }
    // public function route()
    // {
    //     return $this->belongsTo(Route::class);
    // }
    public function passenger()
    {
        return $this->belongsTo(Passenger::class, 'passenger_id', 'passenger_id');
    }


}   
