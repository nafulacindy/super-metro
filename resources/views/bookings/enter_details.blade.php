@extends('layouts.homepage')

@section('content')
<div class="container">
    <h1>Enter Details</h1>

    <!-- Display card with details -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Booking Details</h5>
            <p class="card-text">Scheduled Time: {{ $scheduledTime }}</p>
            <p class="card-text">Bus Registration Number: {{ $bus->registration_number }}</p>
            <p class="card-text">Chosen Seat Number: {{ $seatNumber }}</p>
        </div>
    </div>

    <h2>Please enter your personal details here</h2>

    <form method="POST" action="{{ route('bookings.submitDetails') }}">
         @csrf
         <input type="hidden" name="bus_id" value="{{ $bus->bus_id }}">
         <input type="hidden" name="scheduled_time" value="{{ $scheduledTime }}">
         <input type="hidden" name="seat_number" value="{{ $seatNumber }}">

         
     
         <div class="form-group">
             <label for="name">Full Name</label>
             <input type="text" name="name" class="form-control" required>
         </div>
         <div class="form-group">
             <label for="email">Email</label>
             <input type="email" name="email" class="form-control" required>
         </div>

        <div class="form-group">
             <label for="contact_no">Phone Number</label>
             <input type="text" name="contact_no" class="form-control" required>
         </div>

        <!-- Add any other input fields for other passenger details -->

         <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
@endsection
