<!-- resources/views/route/create.blade.php -->

@extends('layouts.admin')

@section('content')
    <h1>Create New Route</h1>
    <form action="{{ route('route.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="bus_id">Bus ID</label>
            <select name="bus_id" class="form-control">
                @foreach ($buses as $bus)
                    <option value="{{ $bus->bus_id }}">{{ $bus->bus_id }} - {{ $bus->registration_number }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="start_location">Start Location</label>
            <input type="text" name="start_location" class="form-control">
        </div>
        <div class="form-group">
            <label for="end_location">End Location</label>
            <input type="text" name="end_location" class="form-control">
        </div>
        <div class="form-group">
            <label for="distance">Distance</label>
            <input type="number" name="distance" class="form-control" step="0.01">
        </div>
        <div class="form-group">
            <label for="duration">Duration</label>
            <input type="number" name="duration" class="form-control">
        </div>
        <div class="form-group">
            <label for="fare">Fare</label>
            <input type="number" name="fare" class="form-control" step="0.01">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
