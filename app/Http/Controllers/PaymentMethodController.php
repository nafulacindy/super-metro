<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function create()
{
    $user = Auth::user();
    $paymentMethods = $user->paymentMethods;

    return view('create', compact('paymentMethods'));
}

    public function store(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'payment_method' => 'required',
            // Add more validation rules as needed
        ]);

        // Logic to store the payment method
        $user = Auth::user();
        $paymentMethod = new PaymentMethod();
        $paymentMethod->user_id = $user->id;
        $paymentMethod->payment_method = $request->payment_method;
        

        if ($request->payment_method === 'card') {
            $paymentMethod->payment_methodinfo = $request->card_number;
        } elseif ($request->payment_method === 'mpesa') {
            $paymentMethod->payment_methodinfo = $request->mpesa_phone;
        } elseif ($request->payment_method === 'sasapay') {
            $paymentMethod->payment_methodinfo = $request->sasapay_email;
        }
    
        $paymentMethod->save();// Redirect or do something else after saving

        return redirect()->route('payment-methods.create')->with('success', 'Payment method added successfully.');
    }
}
