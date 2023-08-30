@extends('layouts.homepage')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Payment Details</h5>
            <p class="card-text">Passenger: {{ $passenger->name }}</p>
            <p class="card-text">Bus: {{ $bus->registration_number }}</p>
            <p class="card-text">Scheduled Time: {{ $scheduledTime }}</p>
            <p class="card-text">Seat Number: {{ $seatNumber }}</p>
            <p class="card-text">Fare: {{ $fare }}</p>
            
            
         <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="mpesaDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Pay with Mpesa
            </button>
            <ul class="dropdown-menu" aria-labelledby="mpesaDropdown">
                <li>
                    <form method="POST" action="{{ route('bookings.storePayment', ['booking_id' => $booking->booking_id]) }}">
                         @csrf
                         <div class="mb-3">
                             <label for="mpesaNumber" class="form-label">Enter Mpesa Number</label>
                             <input type="text" class="form-control" id="mpesaNumber" placeholder="Mpesa Number">
                         </div>
                         <button type="submit">Confirm Payment</button>
                    </form>
                </li>
               
    

            </ul>
            <div class="mt-2">
                     <a href="{{ route('register') }}">Sign Up for Other Payment Methods</a>
                </div>

            
        </div>
    </div>
</div>
            
            
@endsection


