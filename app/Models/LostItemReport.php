<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostItemReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'bus_registration',
        'travel_date',
        'luggage_description',
    ];
}
