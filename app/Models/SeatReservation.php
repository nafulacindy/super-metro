<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SeatReservation extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'passenger_id',
        'booking_id',
        'bus_id',
        'seat_number',
        // Add any other columns you may need for seat reservations
    ];

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function seatReservations()
{
    return $this->hasMany(SeatReservation::class);
}

    // Add any other relationships you may need
}





