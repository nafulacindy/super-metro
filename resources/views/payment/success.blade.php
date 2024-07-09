@extends('layouts.homepage')

@section('content')

    <h1>Payment Successful!</h1>
    <p>Thank you for your payment. Below are the payment details:</p>
    <ul>
        <li>Payment ID: {{ $paymentDetails['payment_id'] }}</li>
        <li>Amount: {{ $paymentDetails['amount'] }}</li>
        <!-- Add other payment details here -->
    </ul>
@endsection
