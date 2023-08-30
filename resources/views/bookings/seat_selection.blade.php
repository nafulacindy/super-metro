@extends('layouts.homepage')

@section('content')

    <h2>Available Seats</h2>
    <p>Bus: {{ $bus->registration_number }} ({{ $bus->bus_model }})</p>
    
    
    <form method="POST" action="{{ route('bookings.enterDetails', ['bus_id' => $bus->bus_id, 'scheduled_time' => $scheduledTime]) }}">


         @csrf
         <input type="hidden" name="bus_id" value="{{ $bus->bus_id }}">
         <input type="hidden" name="scheduled_time" value="{{ $scheduledTime }}">
         <label for="seat_number">Select Seat:</label>
         <select name="seat_number" id="seat_number">
             @for($i = 1; $i <= $bus->seating_capacity; $i++)
                 @if(!$bookedSeats->contains('seat_number', $i))
                     <option value="{{ $i }}">Seat {{ $i }}</option>
                 @endif
             @endfor
         </select>
         <button type="submit" class="btn btn-primary">Reserve Seat</button>
     </form>

@endsection
