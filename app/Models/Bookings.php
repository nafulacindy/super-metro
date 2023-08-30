<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


}   
