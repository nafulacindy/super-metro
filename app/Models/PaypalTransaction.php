<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaypalTransaction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'payment_id',
        'paypal_payment_id',
        'paypal_payer_id',
        'paypal_status',
        'amount',
    ];
}
