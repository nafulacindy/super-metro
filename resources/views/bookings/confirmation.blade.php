@extends('layouts.homepage')

@section('content')
<div class="container">
    <div class="card  text-white shadow-lg mb-4">
        <div class="card-body">
            <h1 class="card-title">Payment Confirmation</h1>
            <p class="card-text">Thank you for your payment!</p>
            
            <p class="card-text">Passenger: {{ $passenger->name }}</p>
            <p class="card-text">Bus: {{ $bus->registration_number }}</p>
            <p class="card-text">Scheduled Time: {{ $scheduledTime }}</p>
            <p class="card-text">Seat Number: {{ $selectedSeatNumber }}</p>
            <p class="card-text">Fare: ${{ $fare }}</p>
            <!-- Add other relevant details -->
            <!-- <p class="card-text">Payment Method: {{ $paymentMethod }}</p> -->
            <p class="card-text">Payment Date: {{ $paymentDate }}</p>
            <!-- Button to download ticket -->
            <form method="get" action="{{ route('ticket.download', $booking->booking_id) }}">
                @csrf
                <button type="submit" class="btn btn-primary">Download Ticket</button>
            </form>
        </div>
    </div>
</div>

<!-- Custom CSS -->
@endsection
@section('styles')

<style>
    .card {
        transition: background-color 0.3s, color 0.3s;
        border: none;
    }

    .card {
        background-color:rgba(0, 0, 0, 0.75) ;
    }

    .card:hover {
        background-color: rgba(0, 0, 0, 0.9);
        color: black;
    }

    .card-body {
        color: white;
    }

    .card-title {
        font-size: 1.5rem;
    }

    .card-text {
        font-size: 1.1rem;
    }

    .btn-primary {
        background-color: #009688;
        border-color: #009688;
    }

    .btn-primary:hover {
        background-color: #00796b;
        border-color: #00796b;
    }
</style>


@endsection