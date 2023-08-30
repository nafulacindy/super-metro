<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'route_id';
    
    protected $fillable = [
        'bus_id',
        'start_location',
        'end_location',
        'distance',
        'duration',
        'fare',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
