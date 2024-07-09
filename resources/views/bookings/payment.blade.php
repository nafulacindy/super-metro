@extends('layouts.homepage')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Payment Details</h5>
            <p class="card-text">Passenger: {{ $passenger->name }}</p>
            <p class="card-text">Bus: {{ $bus->registration_number }}</p>
            <p class="card-text">Scheduled Time: {{ $scheduledTime }}</p>
            <p class="card-text">Seat Number: {{ $selectedSeatNumber }}</p>
            <p class="card-text">Fare: {{ $fare }}</p>
            <p>Booking ID: {{ $booking->booking_id }}</p>

            <!-- PayPal Checkout Button -->
            <div id="paypal-button-container"></div>
            <div class="container">
    <div class="card">
        <div class="card-body">
            <!-- Other card content -->
            
            <!-- M-Pesa Button Form -->
            <form id="mpesa-form" method="post" action="{{ route('mpesa.initiatePayment') }}">
                @csrf
                <!-- Hidden fields for booking ID and fare -->
                <input type="hidden" name="booking_id" value="{{ $booking->booking_id }}">
                <input type="hidden" name="fare" value="{{ $fare }}">
                <!-- M-Pesa button -->
                <button type="button" id="mpesa-button">Pay with M-Pesa</button>
            </form>
        </div>
    </div>
</div>


        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Include the PayPal SDK JavaScript library -->
<script src="https://www.paypal.com/sdk/js?client-id=AS2Dq7hPHdxgAXDLmWk-Oj11WZDGGtj7f-GoG-uljYeJbmdoXe9zB8C87GDd_5muPCW1JtyPXd0OJf40"></script>
<!-- Add this script tag in your HTML file to include Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    
    paypal.Buttons({
        createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and currency code.
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{ $fare }}', // The total amount to charge the customer
                        currency_code: 'USD' // The currency code (e.g., USD)
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction and executes the payment.
            return actions.order.capture().then(function(details) {
                // Get the booking ID from the backend or include it in the HTML template
                var bookingId = '{{ $booking->booking_id }}';
                var paymentId = details.id; // Get the payment ID from the details
                var amount = details.purchase_units[0].amount.value; // Get the amount from the details
                
                // Call your backend endpoint to save the transaction details in your database
                axios.post('/paypal/checkout', {
                    orderID: data.orderID,
                    payerID: data.payerID,
                    booking_id: bookingId, // Include the booking ID in the request
                    payment_id: paymentId, // Include the payment ID in the request
                    amount: amount, // Include the amount in the request
                    payment_method: 'paypal' // Include the payment method
                }).then(function(response) {
                    // Redirect the user to the confirmation page
                    window.location.href = '/bookings/confirmation/{{ $booking->booking_id }}';
                }).catch(function(error) {
                    // Handle errors or display error messages
                    console.error('Error:', error);
                });
            });
        },
        onError: function(error) {
            // Handle errors or display error messages
            console.error('Error:', error);
        }
    }).render('#paypal-button-container');
    document.getElementById('mpesa-button').addEventListener('click', function() {
        // Get form data
        var formData = new FormData(document.getElementById('mpesa-form'));

        // Send AJAX request
        axios.post('/mpesa/initiate-payment', formData)
            .then(function(response) {
                // Handle success response
                console.log('M-Pesa initiation successful:', response.data);
                // Redirect to payment success page or handle as needed
            })
            .catch(function(error) {
                // Handle error
                console.error('M-Pesa initiation failed:', error);
            });
    });
</script>

@endsection

@section('styles')
<style>
     .btn-primary {
        background-color: black;
        border-color: #009688;
    }

    .btn-primary:hover {
        background-color: #00796b;
        border-color: #00796b;
    }
    .btn-success {
        background-color: #009688;
        border-color: #009688;
    }

    .btn-success:hover {
        background-color: #00796b;
        border-color: #00796b;
    }
    .dropdown-menu {
        min-width: 200px;
    }

    .dropdown-menu form {
        padding: 15px;
    }

    .dropdown-menu input {
        margin-bottom: 10px;
    }
</style>
@endsection
