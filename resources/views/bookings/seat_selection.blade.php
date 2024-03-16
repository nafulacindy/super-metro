@extends('layouts.homepage')

@section('content')

    <h1>Select Seat</h1>

    <div>
        <h3>Selected Route Details:</h3>
        <p>Pickup Location: <strong>{{ $pickupLocation }}</strong></p>
        <p>Destination: <strong>{{ $destination }}</strong></p>
        <p>Scheduled Time: <strong>{{ $scheduledTime }}</strong></p>
    </div>

    <h3>Seat Chart</h3>

    <div class="seat-chart">
        @for ($i = 1; $i <= $bus->seating_capacity; $i++)
            <div class="seat" data-seat="{{ $i }}">
                <span>Seat {{ $i }}</span>
            </div>
        @endfor
    </div>

    <form id="seatSelectionForm" method="POST" action="{{ route('bookings.enterDetails', ['busId' => $bus->bus_id, 'scheduledTime' => $scheduledTime]) }}">
        @csrf
        <input type="hidden" name="bus_id" value="{{ $bus->bus_id }}">
        <input type="hidden" name="scheduled_time" value="{{ $scheduledTime }}">
        <input type="hidden" name="seat_number" id="selectedSeatInput">

        <button type="submit" class="btn btn-primary">Reserve Seat</button>
    </form>

@endsection

@section('styles')
    <style>
        .seat-chart {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(50px, 1fr));
            gap: 10px;
        }

        .seat {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f0f0f0;
            font-weight: bold;
            cursor: pointer;
        }

        .selected {
                background-color: #6495ed; /* Cornflower Blue */
                  color: white;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const seats = document.querySelectorAll('.seat');
            const selectedSeatInput = document.getElementById('selectedSeatInput');

            seats.forEach(seat => {
                seat.addEventListener('click', function() {
                    const seatNumber = this.getAttribute('data-seat');
                    console.log('Clicked Seat Number:', seatNumber);

                    // Toggle the 'selected' class for visual indication
                    this.classList.toggle('selected');

                    // Update hidden input with selected seats
                    updateSelectedSeatsInput();
                });
            });

            function updateSelectedSeatsInput() {
                const selectedSeats = Array.from(document.querySelectorAll('.seat.selected')).map(seat => seat.getAttribute('data-seat'));
                selectedSeatInput.value = selectedSeats.join(',');
                console.log('Selected Seats:', selectedSeatInput.value); // Debug statement
            }
        });
    </script>
@endsection
