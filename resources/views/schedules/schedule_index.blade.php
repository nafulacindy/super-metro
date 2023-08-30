@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Schedules</h1>
    <a href="{{ route('schedules.create') }}" class="btn btn-primary">Create Schedule</a>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Route</th>
                <th>Bus</th>
                <th>Departure Time</th>
                <th>Arrival Time</th>
                <th>Schedule Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $schedule)
                <tr>
                    <td>@if($schedule->route)
                        {{ $schedule->route->start_location }} to {{ $schedule->route->end_location }}

                        @endif
                    </td>
                    <td>
                         @if($schedule->bus)
                         {{ $schedule->bus->registration_number }} ({{ $schedule->bus->bus_model }})                       
                         @endif
                    </td>
                    <td>{{ $schedule->departure_time }}</td>
                    <td>{{ $schedule->arrival_time }}</td>
                    <td>{{ $schedule->schedule_date }}</td>
                    <td>
                        <a href="{{ route('schedules.edit', $schedule->schedule_id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('schedules.destroy', $schedule->schedule_id) }}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this schedule?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
