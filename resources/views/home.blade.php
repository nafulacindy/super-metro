@extends('layouts.homepage')
@section('content')
<div class="container">
    <h1>Book Now</h1>
    <form method="POST" action="{{ route('bookings.selectSeats') }}">
        @csrf
        <div class="form-group row mb-3">
            <label for="pickup_location" class="col-md-4 col-form-label text-md-right">{{ __('Pickup Location') }}</label>

            <div class="col-md-6">
                <input id="pickup_location" type="text" class="form-control @error('pickup_location') is-invalid @enderror" name="pickup_location" value="{{ old('pickup_location') }}" required autofocus>

                @error('pickup_location')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="destination" class="col-md-4 col-form-label text-md-right">{{ __('Destination') }}</label>

            <div class="col-md-6">
                <input id="destination" type="text" class="form-control @error('destination') is-invalid @enderror" name="destination" value="{{ old('destination') }}" required>

                @error('destination')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="scheduled_time" class="col-md-4 col-form-label text-md-right">{{ __('Scheduled Time') }}</label>

            <div class="col-md-6">
                <input id="scheduled_time" type="datetime-local" class="form-control @error('scheduled_time') is-invalid @enderror" name="scheduled_time" value="{{ old('scheduled_time') }}" required>

                @error('scheduled_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Search Buses') }}
                    </button>
                </div>
            </div>
    </form>
</div>

<div class="hero-section">
         <div class="hero-section bg-light">
            
            <p>Get on board with Super Metro and experience the most convenient way to travel.</p>
            <ul>
                <li><i class="material-icons">schedule</i> Easy Online Booking</li>
                <li><i class="material-icons">directions_bus</i> Safe and Comfortable Rides</li>
                <li><i class="material-icons">headset_mic</i> 24/7 Customer Support</li>
            </ul>
            
         </div>

    </div>

    <section class="top-destinations">
    <h2>Top Destinations</h2>
    <div class="destination-grid">
        <div class="destination-item">
            <img src="{{ asset('images/juja.jpg') }}" alt="Juja">
            <h3>Juja</h3>
        </div>
        <div class="destination-item">
            <img src="{{ asset('images/thika.jpg') }}" alt="Thika">
            <h3>Thika</h3>
        </div>
        <div class="destination-item">
            <img src="{{ asset('images/kahawa west.jpg') }}" alt="Kahawa West">
            <h3>Kahawa West</h3>
        </div>
        <div class="destination-item">
            <img src="{{ asset('images/ngong.jpg') }}" alt="Ngong">
            <h3>Ngong</h3>
        </div>
        <div class="destination-item">
            <img src="{{ asset('images/kikuyu.jpg') }}" alt="Kikuyu">
            <h3>Kikuyu</h3>
        </div>
    </div>
</section>

<!-- Bus Service Information Section -->
<div class="bus-info-section bg-light">
    <!-- <h2>Our Bus Service</h2> -->
    <div class="bus-info-grid">
        <!-- Bus Info Item 1 -->
        <div class="bus-info-item">
            <p class="info-label">Number of Customers</p>
            <p class="info-value">10,000+</p>
        </div>

        <!-- Bus Info Item 2 -->
        <div class="bus-info-item">
            <p class="info-label">Total Routes</p>
            <p class="info-value">50+</p>
        </div>

        <!-- Bus Info Item 3 -->
        <div class="bus-info-item">
            <p class="info-label">Number of Buses</p>
            <p class="info-value">100+</p>
        </div>

       
    </div>
</div>

    <main>
        <h1></h1>
        <!-- Other content specific to your home page -->
    </main>

    <footer class="bg-light">
    <div class="footer-content">
            <!-- Contact Information -->
            <div class="contact-info">
                <h3>Contact Us</h3>
                <p>For customer support, please call: +1-123-456-7890</p>
                <p>Email: support@supermetro.com</p>
            </div>

            <!-- Top Routes -->
            <div class="top-routes">
                <h3>Top Routes</h3>
                <ul>
                    <li>Nairobi-Kikuyu</li>
                    <li>Nairobi-Juja</li>
                    <li>Nairobi-Ngong</li>
                    <li>Nairobi-Makongeni</li>
                </ul>
            </div>

        </div>

    </footer>

@endsection