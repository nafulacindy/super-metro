@extends('layouts.homepage')

@section('content')
<style>
    h1 {
        font-size: 50px;
        margin-top: 20px;
        color: white;
        text-align: center;
        padding-bottom: 10px;
    }

    p {
        margin: 20px auto;
        font-weight: 100;
        line-height: 25px;
        color: white;
        text-align: center;
    }

    .card {
        margin-top: 20px;
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 20px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .card h5{
        color: white;
        text-align: center;
    }
    /* .card p{
        color: white;
        text-align: center; */
    /* } */
    .card-body.card-text{
        color: white;
    }
    
    .card-header{
        color: white;
        text-align: center;

    }

    .card:hover {
        background-color: white;
        color: black;
    }

    .form-label {
        color: white;
    }

    .form-control {
        color: white;
        background-color: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .form-control:focus {
        color: white;
        background-color: rgba(255, 255, 255, 0.1);
        border-color: white;
    }

    .btn-primary {
        background-color: #009688;
        border-color: #009688;
    }

    .btn-primary:hover {
        background-color: #00796b;
        border-color: #00796b;
    }

    /* Adjust styles for hover state */
    .card:hover .card-body h5 {
        color: black;
        
    }
    :hover .card-body p {
        color: black;
        
    }
    .card:hover .card-header{
        color: black;
    }
    .card:hover .form-label {
        color: black;
    }

    .card:hover .form-control {
        color: black;
        background-color: rgba(0, 0, 0, 0.1);
        border-color: rgba(0, 0, 0, 0.3);
    }
</style>

<div class="container">
    <h1>Enter Personal Details</h1>

    <div class="row">
        <!-- Display card with booking details -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Booking Details</h5>
                    <p class="card-text"><strong>Scheduled Time:</strong> {{ $scheduledTime }}</p>
                    <p class="card-text"><strong>Bus Registration Number:</strong> {{ $bus->registration_number }}</p>
                    <p class="card-text"><strong>Chosen Seat Number:</strong> {{ $selectedSeatNumber }}</p>
                </div>
            </div>
        </div>

        <!-- Enter Details Form -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Enter Personal Details</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('bookings.submitDetails') }}">
                        @csrf
                        <input type="hidden" name="bus_id" value="{{ $bus->bus_id }}">
                        <input type="hidden" name="scheduled_time" value="{{ $scheduledTime }}">
                        <input type="hidden" name="seat_number" value="{{ $selectedSeatNumber }}">
                     
                        <div class="form-group">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="contact_no" class="form-label">Phone Number</label>
                            <input type="text" name="contact_no" class="form-control" required>
                        </div>

                        <!-- You can add more form fields here for additional passenger details -->

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
