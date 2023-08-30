<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Schedule extends Model
{
    use HasFactory;
    protected $primaryKey = 'schedule_id';


    protected $fillable = [
        'route_id',
        'bus_id',
        'departure_time',
        'arrival_time',
        'schedule_date',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id', 'route_id');
    }

    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class, 'bus_id', 'bus_id');
    }


    public function bookings(): HasMany
    {
        return $this->hasMany(Bookings::class);
    }

}
