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
        $userPaymentMethods = $user->paymentMethods; // Adjusted variable name

        return view('create', compact('userPaymentMethods')); // Adjusted variable name
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
        $paymentMethod->payment_methodinfo = $request->payment_methodinfo; // Assign the correct value

        $paymentMethod->save();

        return redirect()->route('payment-methods.create')->with('success', 'Payment method added successfully.');
    }
}
