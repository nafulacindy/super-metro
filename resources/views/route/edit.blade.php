<!-- resources/views/route/edit.blade.php -->

@extends('layouts.admin')

@section('content')
    <h1>Edit Route</h1>
    <form action="{{ route('route.update', ['route' => $route->route_id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="bus_id">Bus ID</label>
            <select name="bus_id" class="form-control">
                @foreach ($buses as $bus)
                    <option value="{{ $bus->bus_id }}" @if ($bus->bus_id === $route->bus_id) selected @endif>{{ $bus->bus_id }} - {{ $bus->registration_number }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="start_location">Start Location</label>
            <input type="text" name="start_location" class="form-control" value="{{ $route->start_location }}">
        </div>
        <div class="form-group">
            <label for="end_location">End Location</label>
            <input type="text" name="end_location" class="form-control" value="{{ $route->end_location }}">
        </div>
        <div class="form-group">
            <label for="distance">Distance</label>
            <input type="number" name="distance" class="form-control" step="0.01" value="{{ $route->distance }}">
        </div>
        <div class="form-group">
            <label for="duration">Duration</label>
            <input type="number" name="duration" class="form-control" value="{{ $route->duration }}">
        </div>
        <div class="form-group">
            <label for="fare">Fare</label>
            <input type="number" name="fare" class="form-control" step="0.01" value="{{ $route->fare }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
