@extends('layouts.admin')

@section('content')
    <h1>Manage buses</h1>
    <a href="{{ route('bus.create') }}" class="btn btn-primary">Add New Bus</a>
    <table class="table">
        <thead>
            <tr>
                <th>Registration Number</th>
                <th>Bus Model</th>
                <th>Seating Capacity</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($buses as $bus)
                <tr>
                    <td>{{ $bus->registration_number }}</td>
                    <td>{{ $bus->bus_model }}</td>
                    <td>{{ $bus->seating_capacity }}</td>
                    <td>{{ $bus->status }}</td>
                    <td>
                        <a href="{{ route('bus.edit', ['bu' => $bus->bus_id]) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('bus.destroy', ['bu' => $bus->bus_id]) }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
