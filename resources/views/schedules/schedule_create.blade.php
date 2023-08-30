@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create Schedule</h1>
    <form action="{{ route('schedules.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="route_id">Route</label>
            <select name="route_id" id="route_id" class="form-control">
                @foreach ($routes as $route)
                    <option value="{{ $route->route_id }}">{{ $route->start_location }} to {{ $route->end_location }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="bus_id">Bus</label>
            <select name="bus_id" id="bus_id" class="form-control">
                @foreach ($buses as $bus)
                    <option value="{{ $bus->bus_id }}">{{ $bus->registration_number }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="departure_time">Departure Time</label>
            <input type="time" name="departure_time" id="departure_time" class="form-control">
        </div>
        <div class="form-group">
            <label for="arrival_time">Arrival Time</label>
            <input type="time" name="arrival_time" id="arrival_time" class="form-control">
        </div>
        <div class="form-group">
            <label for="schedule_date">Schedule Date</label>
            <input type="date" name="schedule_date" id="schedule_date" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
