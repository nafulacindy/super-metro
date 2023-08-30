@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Available Buses for {{ $origin }} to {{ $destination }} on {{ $travelDate->format('d/m/Y H:i') }}</h2>

        @foreach ($availableBuses as $bus)
            <div>
                <h3>Bus Number: {{ $bus->bus_number }}</h3>
                <p>Departure Time: {{ $bus->departure_time }}</p>
                <!-- Add more bus details here as needed -->
                <form action="{{ route('bus.book', $bus->id) }}" method="POST">
                    @csrf
                    <button type="submit">Book this bus</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
