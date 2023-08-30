@extends('layouts.homepage')

@section('content')
<div class="container">
    <h1>Payment Confirmation</h1>
    <p>Thank you for your payment!</p>
    
    <p>Passenger: {{ $passenger->name }}</p>
    <p>Bus: {{ $bus->registration_number }}</p>
    <p>Scheduled Time: {{ $scheduledTime }}</p>
    <p>Seat Number: {{ $seatNumber }}</p>
    <p>Fare: ${{ $fare }}</p>
    <!-- Add other relevant details -->
    <p>Payment Method: {{ $paymentMethod }}</p>
    <p>Payment Date: {{ $paymentDate }}</p>
</div>

@endsection
