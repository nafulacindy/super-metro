<!-- {{ dd($bus) }} -->
@extends('layouts.admin')

@section('content')
    <h1>Edit Bus</h1>
    <form action="{{ route('bus.update', ['bu' => $bus->bus_id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="registration_number">Registration Number</label>
            <input type="text" name="registration_number" class="form-control" value="{{ $bus->registration_number }}">
        </div>
        <div class="form-group">
            <label for="bus_model">Bus Model</label>
            <input type="text" name="bus_model" class="form-control" value="{{ $bus->bus_model }}">
        </div>
        <div class="form-group">
            <label for="seating_capacity">Seating Capacity</label>
            <input type="number" name="seating_capacity" class="form-control" value="{{ $bus->seating_capacity }}">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" class="form-control" value="{{ $bus->status }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
