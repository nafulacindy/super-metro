<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bus extends Model
{
    use HasFactory;
    protected $fillable = [
        'registration_number',
        'bus_model',
        'seating_capacity',
        'status',
    ];
    protected $primaryKey = 'bus_id'; 

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'bus_id', 'bus_id');
    }
    

    public function bookings(): HasMany
    {
        return $this->hasMany(Bookings::class, 'bus_id', 'bus_id');
    }



    public function route()
    {
        return $this->belongsTo(Route::class, 'bus_id', 'bus_id');
    }

    


    
}
