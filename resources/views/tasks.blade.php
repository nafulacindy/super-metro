@extends('layouts.user')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Add Payment Method</h2>
            </div>
            <div class="card-body">
                <!-- Add payment method form -->
                <form method="POST" action="#">
                    @csrf
                    <!-- Payment method fields here -->
                    <!-- <label for="card_number">Card Number</label>
                    <input type="text" name="card_number" id="card_number" required> -->
                    <!-- Other payment method fields -->

                    <button type="submit" class="btn btn-primary">Add Payment Method</button>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h2>Saved Payment Methods</h2>
            </div>
            <div class="card-body">
                <ul>
                    <!-- Static saved payment methods -->
                    <li>Visa ending in **** 1234</li>
                    <li>MasterCard ending in **** 5678</li>
                </ul>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h2>Promo Codes</h2>
            </div>
            <div class="card-body">
                <!-- Promo code form -->
                <form method="POST" action="#">
                    @csrf
                    <label for="promo_code">Enter Promo Code</label>
                    <input type="text" name="promo_code" id="promo_code" required>

                    <button type="submit" class="btn btn-primary">Apply Promo Code</button>
                </form>

                <!-- Display applied promo codes -->
                <h3>Applied Promo Codes</h3>
                <ul>
                    <!-- Static applied promo codes -->
                    <li>Promo Code 1 - Description 1</li>
                    <li>Promo Code 2 - Description 2</li>
                </ul>
            </div>
        </div>
    </div>
@endsection