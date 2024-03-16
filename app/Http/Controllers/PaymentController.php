<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request)
{
    // Validate the form data (you can add your validation rules)
    $request->validate([
        // Define your validation rules here
    ]);

    // Create and save the payment method
    $paymentMethod = new PaymentMethod();
    // Populate and save payment method attributes based on the form input
    $paymentMethod->name = $request->input('name');
    // Add more attributes as needed
    $paymentMethod->save();

    // Redirect or respond as needed
    return redirect()->route('payment-methods.index')->with('success', 'Payment method added successfully');
}
public function applyPromo()
{
    // Placeholder method for applying promo code
    // You can leave it empty for now
}

}
