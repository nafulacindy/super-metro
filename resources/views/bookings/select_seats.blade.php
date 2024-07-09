@extends('layouts.homepage')

@section('content')
<div class="container">
    <!-- Background Image -->

    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6">
            <!-- Route Details Card -->
            <div class="card mb-4">
                <div class="card-body ">
                    <h5 class="card-title">Select Seat</h5>
                    <p><strong>Selected Route Details:</strong></p>
                    <p><strong>Pickup Location:</strong> {{ $pickupLocation }}</p>
                    <p><strong>Destination:</strong> {{ $destination }}</p>
                    <p><strong>Scheduled Time:</strong> {{ $scheduledTime }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Buses Grid -->
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class= >Available Buses:</h3>
                    <div class="row">
                        @foreach ($availableBuses as $bus)
                        <div class="col-md-4 mb-3">
                            <div class="card w-100">
                                <div class="card-template">
                                    <h5 class="card-title">Bus: {{ $bus->registration_number }}</h5>
                                    <p class="card-text">Model: {{ $bus->bus_model }}</p>
                                    <p class="card-text">Capacity: {{ $bus->seating_capacity }}</p>
                                    <p class="card-text">Bus ID: {{ $bus->bus_id }}</p>
                                    @if ($bus->route)
                                    <p class="card-text">Price: ${{ $bus->route->fare }}</p>
                                    <a href="{{ route('bookings.seatSelection', ['busId' => $bus->bus_id, 'scheduledTime' => $scheduledTime]) }}" class="btn btn-primary btn-sm">Select Seat</a>
                                    @else
                                    <p class="card-text">Price: Not available</p>
                                    <p class="card-text">Select Seat: N/A</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        background-color: rgba(0, 0, 0, 0.75);
        border: 1px solid rgba(255, 255, 255, 0.3);

    }
    .card:hover{
        background-color:(0, 0, 0, 0.75) ;
    }

    .card-body {
        margin-top: 20px;
        background-color: rgba(0, 0, 0, 0.75);
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 20px;
        color: white;
        transition: background-color 0.3s ease;
    }
    
    .card-body:hover{
        background-color: rgba(0, 0, 0, 0.9);
        color:white;
    }
    .card-template{margin-top: 20px;
        background-color: rgba(0, 0, 0, 0.9);
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 20px;
        color: white;
        transition: background-color 0.3s ease;} 

    .card-title {
        font-size: 1.25rem; /* Larger font for title */
    }

    .card-text {
        font-size: 1rem; /* Medium font for text */
        white-space: pre-line; /* Allow text to wrap */
    }

    .btn-primary {
        background-color: #009688; /* Blue primary button color */
        border-color: #009688;
    }

    .btn-primary:hover {
        background-color:  #00796b; /* Darker blue on hover */
        border-color:  #00796b;
    }
</style>

@endsection
