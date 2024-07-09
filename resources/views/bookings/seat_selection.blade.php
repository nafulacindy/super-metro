@extends('layouts.homepage')

@section('content')

    <!-- <h1 class="text-center text-white">Select Seat</h1> -->

    
        <div class="card-body">
            <h3>Selected Route Details:</h3>
            <p>Pickup Location: <strong>{{ $pickupLocation }}</strong></p>
            <p>Destination: <strong>{{ $destination }}</strong></p>
            <p>Scheduled Time: <strong>{{ $scheduledTime }}</strong></p>
        </div>
    

    <h3 class= "text-center text-white"><br>Seat Chart</h3>

    <div class="seat-chart">
        @for ($i = 1; $i <= $bus->seating_capacity; $i++)
            <div class="seat" data-seat="{{ $i }}">
                S{{ $i }}
            </div>
        @endfor
    </div>

    <form id="seatSelectionForm" method="POST" action="{{ route('bookings.enterDetails', ['busId' => $bus->bus_id, 'scheduledTime' => $scheduledTime]) }}">
        @csrf
        <input type="hidden" name="bus_id" value="{{ $bus->bus_id }}">
        <input type="hidden" name="scheduled_time" value="{{ $scheduledTime }}">
        <input type="hidden" name="seat_number" id="selectedSeatInput">

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Reserve Seat</button>
        </div>
    </form>

@endsection

@section('styles')
    <style>
        .seat-chart {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .seat {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(0, 150, 136, 0.5);
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .seat:hover {
            background-color: #009688;
            color: white;
        }

        .selected {
            background-color: #6495ed; /* Cornflower Blue */
            color: white;
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
        .card-body {
            background-color: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            padding: 20px;
            transition: background-color 0.3s;
            color: white;
            padding bottom: 40px;
        }

        .card-body:hover {
            background-color: rgba(0, 0, 0, 0.8);
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
