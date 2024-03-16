@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Booking History</div>

                    <div class="card-body">
                        @foreach ($bookings as $booking)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <!-- <h5 class="card-title">Booking ID: {{ $booking->booking_id }}</h5> -->
                                    <p class="card-text">Pickup Location: {{ $booking->pickup_location }}</p>
                                    <p class="card-text">Destination: {{ $booking->destination }}</p>
                                    <p class="card-text">Scheduled Time: {{ $booking->scheduled_time }}</p>
                                    @if ($booking->status === 'Cancelled')
                                        <p class="card-text text-danger">Status: Cancelled</p>
                                        <form method="post" action="{{ route('bookings.rebook', $booking->booking_id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Rebook</button>
                                        </form>
                                    @else
                                        <p class="card-text">Status: {{ $booking->status }}</p>
                                    @endif
                                    @if ($booking->bus)
                                        <!-- <p class="card-text">Bus ID: {{ $booking->bus->bus_id }}</p> -->
                                        <p class="card-text">Registration Number: {{ $booking->bus->registration_number }}</p>
                                        <p class="card-text">Bus Model: {{ $booking->bus->bus_model }}</p>
                                        <!-- <p class="card-text">Seating Capacity: {{ $booking->bus->seating_capacity }}</p> -->
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
