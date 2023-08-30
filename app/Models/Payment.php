<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'payment_id'; // Assuming payment_id is the primary key

    protected $fillable = [
        'booking_id', // Add 'booking_id' here
        'passenger_id',
        'amount',
        'payment_method',
        'status',
        'payment_date',
    ];


    public function booking()
    {
        return $this->belongsTo(Bookings::class, 'booking_id', 'booking_id');
    }

    public function passenger()
    {
        return $this->belongsTo(Passenger::class, 'passenger_id', 'passenger_id');
    }

}
