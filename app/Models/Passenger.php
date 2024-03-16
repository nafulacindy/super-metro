<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;
    protected $primaryKey = 'passenger_id';
    protected $fillable = ['name', 'email', 'contact_no','user_id'];

    public function bookings()
    {
        return $this->hasMany(Bookings::class, 'passenger_id');
    }

    public function seatReservations()
    {
        return $this->hasMany(SeatReservation::class, 'passenger_id');
    }

}
