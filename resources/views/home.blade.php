@extends('layouts.homepage')

@section('content')
<style>
    h1 {
        font-size: 50px;
        margin-top: 20px;
        color: white;
        text-align: center;
        
        padding-bottom: 10px;
    }

    p {
        margin: 20px auto;
        font-weight: 100;
        line-height: 25px;
        color: white;
        text-align: center;
    }

    .card {
        margin-top: 20px;
        background-color: rgba(0, 0, 0, 0.75);
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 20px;
        transition: background-color 0.3s ease;
    }

    .card:hover {
        background-color: white;
    }

    .form-label {
        color: white;
    }

    .form-control {
        color: white;
        background-color: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .form-control:focus {
        color: white;
        background-color: rgba(255, 255, 255, 0.1);
        border-color: white;
    }

    .btn-primary {
        background-color: #009688;
        border-color: #009688;
    }

    .btn-primary:hover {
        background-color: #00796b;
        border-color: #00796b;
    }

    /* Adjust styles for hover state */
    .card:hover .form-label {
        color: black;
    }

    .card:hover .form-control {
        color: black;
        background-color: rgba(0, 0, 0, 0.1);
        border-color: rgba(0, 0, 0, 0.3);
    }
</style>

<div class="container">
    <h1>Book affordable Matatu rides.</h1>
    <p>Get on board with CityBus and experience the most convenient way to travel.</p>
    
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('bookings.selectSeats') }}" class="row g-3">
                @csrf

                <div class="col-md-4">
                    <label for="pickup_location" class="form-label">{{ __('Pickup Location') }}</label>
                    <input id="pickup_location" type="text" class="form-control form-control-sm @error('pickup_location') is-invalid @enderror" name="pickup_location" value="{{ old('pickup_location') }}" required autofocus>
                    @error('pickup_location')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="destination" class="form-label">{{ __('Destination') }}</label>
                    <input id="destination" type="text" class="form-control form-control-sm @error('destination') is-invalid @enderror" name="destination" value="{{ old('destination') }}" required>
                    @error('destination')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="scheduled_time" class="form-label">{{ __('Scheduled Time') }}</label>
                    <input id="scheduled_time" type="datetime-local" class="form-control form-control-sm @error('scheduled_time') is-invalid @enderror" name="scheduled_time" value="{{ old('scheduled_time') }}" required>
                    @error('scheduled_time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-2 d-flex align-items-center">
                    <button type="submit" class="btn btn-primary btn-sm px-3 py-2 fs-6">{{ __('Book') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
