@extends('layouts.admin')

@section('content')
    <h1>Create New Bus</h1>
    <form action="{{ route('bus.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="registration_number">Registration Number</label>
            <input type="text" name="registration_number" class="form-control">
        </div>
        <div class="form-group">
            <label for="bus_model">Bus Model</label>
            <input type="text" name="bus_model" class="form-control">
        </div>
        <div class="form-group">
            <label for="seating_capacity">Seating Capacity</label>
            <input type="number" name="seating_capacity" class="form-control">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
