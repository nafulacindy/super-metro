<?php

namespace App\Http\Controllers;

use App\Models\PaypalTransaction;
use App\Models\Payment;
use Illuminate\Http\Request;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use GuzzleHttp\Client;
use App\Models\Bookings;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    // Checkout page
    public function checkout()
    {
        // Logic to create an order or calculate total amount
        return view('checkout');
    }
    public function processPayment(Request $request)
{
    // Process PayPal payment and retrieve relevant data
    $paypalPaymentId = $request->input('paypal_payment_id');
    $paypalPayerId = $request->input('paypal_payer_id');
    $paypalStatus = $request->input('paypal_status');
    $amount = $request->input('amount');
    $bookingId = $request->input('booking_id');

    // Log the values for debugging
    \Log::info('PayPal Payment ID: ' . $paypalPaymentId);
    \Log::info('PayPal Payer ID: ' . $paypalPayerId);
    \Log::info('PayPal Status: ' . $paypalStatus);
    \Log::info('Payment Amount: ' . $amount);
    \Log::info('Booking ID: ' . $bookingId); // Log the value of booking_id

    // Create a new record in the paypal_transactions table
    $paypalTransaction = new PaypalTransaction();
    $paypalTransaction->paypal_payment_id = $paypalPaymentId;
    $paypalTransaction->paypal_payer_id = $paypalPayerId;
    $paypalTransaction->paypal_status = $paypalStatus;
    $paypalTransaction->amount = $amount;
    $paypalTransaction->save();

    // Log the saved PayPal transaction
    \Log::info('PayPal transaction saved: ' . $paypalTransaction);

    // Pass the PayPal status as a variable
    $data['paypal_status'] = $paypalStatus;

    // Redirect to the storePayment route with the booking ID
    return redirect()->route('bookings.storePayment', ['booking_id' => $bookingId]);
}
 
  }  
  // Process payment
//     public function processPayment(Request $request)
//     {
//         \Log::info('Request Payload: ' . json_encode($request->all()));
//         // Process PayPal payment and retrieve relevant data
//         $paypalPaymentId = $request->input('paypal_payment_id');
//         $paypalPayerId = $request->input('paypal_payer_id');
//         $paypalStatus = $request->input('paypal_status');
//         $amount = $request->input('amount');
//         $bookingId = $request->input('booking_id');
    
//         \Log::info('Booking ID received: ' . $bookingId);
//         // Log the values for debugging
//         \Log::info('PayPal Payment ID: ' . $paypalPaymentId);
//         \Log::info('PayPal Payer ID: ' . $paypalPayerId);
//         \Log::info('PayPal Status: ' . $paypalStatus);
//         \Log::info('Payment Amount: ' . $amount);
//         \Log::info('Booking ID: ' . $bookingId); // Log the value of booking_id
    
//         // Create a new record in the paypal_transactions table
//         $paypalTransaction = new PaypalTransaction();
//         $paypalTransaction->paypal_payment_id = $paypalPaymentId;
//         $paypalTransaction->paypal_payer_id = $paypalPayerId;
//         $paypalTransaction->paypal_status = $paypalStatus;
//         $paypalTransaction->amount = $amount;
//         $paypalTransaction->save();
    
//         // Log the saved PayPal transaction
//         \Log::info('PayPal transaction saved: ' . $paypalTransaction);
    
//         // Pass the PayPal status as a variable
//         $data['paypal_status'] = $paypalStatus;
    
//         // Redirect to the storePayment route with the booking ID
//         return redirect()->route('bookings.storePayment', ['booking_id' => $bookingId]);
//     }
    
//     public function success(Request $request)
// {
//     // Retrieve the booking ID from the request, assuming it's passed as a query parameter
//     $bookingId = $request->query('booking_id');

//     // Redirect to the storePayment route with the booking ID
//     return Redirect::route('bookings.confirmation', ['booking_id' => $bookingId]);
// }

//     // Payment cancelation page
//     public function cancel(Request $request)
//     {
//         // Logic to handle payment cancelation
//         return view('payment.cancel');
//     }
// }
