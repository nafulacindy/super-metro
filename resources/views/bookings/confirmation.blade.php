@extends('layouts.homepage')

@section('content')
<div class="container">
    <h1>Payment Confirmation</h1>
    <p>Thank you for your payment!</p>
    
    <p>Passenger: {{ $passenger->name }}</p>
    <p>Bus: {{ $bus->registration_number }}</p>
    <p>Scheduled Time: {{ $scheduledTime }}</p>
    <p>Seat Number: {{ $selectedSeatNumber }}</p>
    <p>Fare: ${{ $fare }}</p>
    <!-- Add other relevant details -->
    <p>Payment Method: {{ $paymentMethod }}</p>
    <p>Payment Date: {{ $paymentDate }}</p>
    <!-- Button to download ticket -->
    <form method="get" action="{{ route('ticket.download', $booking->booking_id) }}">

        @csrf
        <button type="submit" class="btn btn-primary">Download Ticket</button>
    </form>

</div>

@endsection
