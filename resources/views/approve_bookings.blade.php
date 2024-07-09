@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Pending Bookings</h5>
            </div>
            <div class="card-body">
                @if ($bookings->isEmpty())
                    <p>No pending bookings at the moment.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Passenger ID</th>
                                <th>Bus</th>
                                <th>Scheduled Time</th>
                                <th>Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->booking_id }}</td>
                                    <td>{{ $booking->passenger_id }}</td>
                                    <td>{{ $booking->bus_id }}</td>
                                    <td>{{ $booking->scheduled_time }}</td>
                                    <td>{{ $booking->status }}</td>
                                    <td>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
