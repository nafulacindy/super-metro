@extends('layouts.homepage')

@section('content')
<style>
    /* Custom Styles for Select Seat Page */
    .content-wrapper {
        padding: 20px;
        color: #fff;
    }

    .route-details {
        margin-bottom: 20px;
    }

    .route-details h1 {
        font-size: 50px;
        margin-bottom: 20px;
        color: #fff;
    }

    .route-details p {
        font-size: 20px;
        margin-bottom: 10px;
        color: #fff;
    }

    .buses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }

    .bus-card {
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .bus-card h5 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #fff;
    }

    .bus-card p {
        font-size: 16px;
        margin-bottom: 5px;
        color: #fff;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
        padding: 8px 20px;
        font-size: 16px;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

</style>

<div class="content-wrapper">
    <div class="route-details">
        <h1>Select Seat</h1>
        <p><strong>Selected Route Details:</strong></p>
        <p><strong>Pickup Location:</strong> {{ $pickupLocation }}</p>
        <p><strong>Destination:</strong> {{ $destination }}</p>
        <p><strong>Scheduled Time:</strong> {{ $scheduledTime }}</p>
    </div>

    <div class="buses-grid">
        <h3>Available Buses:</h3>
        @foreach ($availableBuses as $bus)
        <div class="bus-card">
            <h5>Bus: {{ $bus->registration_number }}</h5>
            <p>Model: {{ $bus->bus_model }}</p>
            <p>Capacity: {{ $bus->seating_capacity }}</p>
            <p>Bus ID: {{ $bus->bus_id }}</p>
            @if ($bus->route)
            <p>Price: ${{ $bus->route->fare }}</p>
            <a href="{{ route('bookings.seatSelection', ['busId' => $bus->bus_id, 'scheduledTime' => $scheduledTime]) }}" class="btn btn-primary">Select Seat</a>
            @else
            <p>Price: Not available</p>
            <p>Select Seat: N/A</p>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
