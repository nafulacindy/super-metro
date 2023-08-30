@extends('layouts.homepage')

@section('content')
<div class="container">
    <h1>Select Seat</h1>
    <div>
        <h3>Selected Route Details:</h3>
        <p>Pickup Location: {{ $pickupLocation }}</p>
        <p>Destination: {{ $destination }}</p>
        <p>Scheduled Time: {{ $scheduledTime }}</p>
    </div>

    <h3>Available Buses:</h3>
    @foreach ($availableBuses as $bus)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Bus: {{ $bus->registration_number }}</h5>
            <p class="card-text">Model: {{ $bus->bus_model }}</p>
            <p class="card-text">Capacity: {{ $bus->seating_capacity  }}</p>
            <p>Bus ID: {{ $bus->bus_id }}</p>
            @if ($bus->route)
              <p>Price: ${{ $bus->route->fare }}</p>
              {{$bus->bus_id}} <!-- Display the value of $bus->id -->
              {{$scheduledTime}} <!-- Display the value of $scheduledTime -->

              @if ($bus->bus_id)
              <a href="{{ route('bookings.seatSelection', ['busId' => $bus->bus_id, 'scheduledTime' => $scheduledTime]) }}" class="btn btn-primary">Select Seat</a>


              @endif

            @else
              <p>Price: Not available</p>
              <p>Select Seat: N/A</p>
            @endif
           


        </div>
    </div>
    @endforeach
</div>
@endsection
