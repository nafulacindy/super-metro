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
                                <div class="card-body booking-card">
                                    @if ($booking->bus)
                                        <p class="card-text">Registration Number: {{ $booking->bus->registration_number }}</p>
                                        <p class="card-text">Bus Model: {{ $booking->bus->bus_model }}</p>
                                    @endif
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
                                        <form method="post" action="{{ route('booking.cancel', $booking->booking_id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Cancel</button>
                                        </form>
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

@section('styles')
    @parent
    <style>
        .booking-card {
            transition: transform 0.3s;
            background-color: #f9fafb;
        }

        .booking-card:hover {
            transform: scale(1.05);
            background-color: #fff;
        }
    </style>
@endsection
