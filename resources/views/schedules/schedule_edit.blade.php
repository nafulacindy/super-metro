@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Schedule</h1>
    <form action="{{ route('schedules.update', ['schedule' => $schedule->schedule_id]) }}" method="post">

        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="route_id">Route</label>
            <select name="route_id" id="route_id" class="form-control">
                @foreach ($routes as $route)
                <option value="{{ $route->route_id }}" @if ($schedule->route_id === $route->route_id) selected @endif>
                    {{ $route->start_location }} to {{ $route->end_location }}
                </option>
                @endforeach
            </select>
    
        </div>

        <div class="form-group">
            <label for="bus_id">Bus</label>
            <select name="bus_id" id="bus_id" class="form-control">
                 @foreach ($buses as $bus)
                 <option value="{{ $bus->bus_id }}" @if ($schedule->bus_id === $bus->bus_id) selected @endif>
                    {{ $bus->registration_number }} - {{ $bus->bus_model }}
                 </option>
                 @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="departure_time">Departure Time</label>
            <input type="time" name="departure_time" id="departure_time" class="form-control" value="{{ $schedule->departure_time }}">
        </div>
        <div class="form-group">
            <label for="arrival_time">Arrival Time</label>
            <input type="time" name="arrival_time" id="arrival_time" class="form-control" value="{{ $schedule->arrival_time }}">
        </div>
        <div class="form-group">
            <label for="schedule_date">Schedule Date</label>
            <input type="date" name="schedule_date" id="schedule_date" class="form-control" value="{{ $schedule->schedule_date }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
