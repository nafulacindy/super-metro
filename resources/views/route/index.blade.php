

@extends('layouts.admin')

@section('content')
    <h1>Manage Routes</h1>
    <a href="{{ route('route.create') }}" class="btn btn-primary">Add New Route</a>
    <table class="table">
        <thead>
            <tr>
                <th>Route ID</th>
                <th>Bus ID</th>
                <th>Start Location</th>
                <th>End Location</th>
                <th>Distance</th>
                <th>Duration</th>
                <th>Fare</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($routes as $route)
                <tr>
                    <td>{{ $route->route_id }}</td>
                    <td>{{ $route->bus_id }}</td>
                    <td>{{ $route->start_location }}</td>
                    <td>{{ $route->end_location }}</td>
                    <td>{{ $route->distance }}</td>
                    <td>{{ $route->duration }}</td>
                    <td>{{ $route->fare }}</td>
                    <td>
                        <a href="{{ route('route.edit', ['route' => $route->route_id]) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('route.destroy', ['route' => $route->route_id]) }}" method="POST" style="display: inline">
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
