@extends('layouts.user')

@section('content')
<div class="container">
    <!-- Add Payment Method Card -->
    <div class="card">
        <div class="card-header">
            <h2>Add Payment Method</h2>
        </div>
        <div class="card-body">
            <!-- Add payment method form -->
            <form method="POST" action="{{ route('payment-methods.store') }}" id="paymentMethodForm">
                @csrf
                <div class="form-group">
                    <label for="payment_method">Select Payment Method:</label>
                    <select name="payment_method" id="payment_method" class="form-control" required>
                        <option value="card">Credit/Debit Card</option>
                        <option value="mpesa">M-Pesa</option>
                        <option value="sasapay">SasaPay</option>
                        <!-- Add more payment methods -->
                    </select>
                </div>

                <!-- Additional fields based on payment method -->
                <div id="card_fields" style="display: none;">
                    <!-- Card details fields -->
                    <label for="card_number">Card Number:</label>
                    <input type="text" name="card_number" id="card_number" class="form-control" placeholder="Card Number">
                    <!-- Add more card details fields as needed -->
                </div>

                <div id="mpesa_fields" style="display: none;">
                    <!-- M-Pesa details fields -->
                    <label for="mpesa_phone">M-Pesa Phone Number:</label>
                    <input type="text" name="mpesa_phone" id="mpesa_phone" class="form-control" placeholder="M-Pesa Phone Number">
                    <!-- Add more M-Pesa details fields as needed -->
                </div>

                <div id="sasapay_fields" style="display: none;">
                    <!-- SasaPay details fields -->
                    <label for="sasapay_email">SasaPay Email:</label>
                    <input type="email" name="sasapay_email" id="sasapay_email" class="form-control" placeholder="SasaPay Email">
                    <!-- Add more SasaPay details fields as needed -->
                </div>

                <input type="hidden" name="payment_methodinfo" id="payment_methodinfo">

                <button type="submit" class="btn btn-primary">Add Payment Method</button>
            </form>

        </div>
    </div>

    <!-- Saved Payment Methods Card -->
    <div class="card mt-4">
        <div class="card-header">
            <h2>Saved Payment Methods</h2>
        </div>
        <div class="card-body">
            <ul>
                @foreach($userPaymentMethods as $userPaymentMethod) <!-- Adjusted variable name -->
                <li>{{ $userPaymentMethod->payment_method }} - 
                    <?php 
                        $paymentInfo = $userPaymentMethod->payment_methodinfo; // Adjusted variable name
                        $visibleLength = max(round(strlen($paymentInfo) * 0.4), 4);
                        $maskedString = substr($paymentInfo, 0, $visibleLength) . str_repeat('*', strlen($paymentInfo) - $visibleLength);
                        echo $maskedString;
                    ?>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="card mt-4">
            <div class="card-header">
                <h2>Add Promo Code</h2>
            </div>
            <div class="card-body">
                <!-- Simple form for adding promo codes -->
                <form method="POST" action="#">
                    @csrf
                    <div class="form-group">
                        <label for="promo_code">Enter Promo Code:</label>
                        <input type="text" name="promo_code" id="promo_code" class="form-control" placeholder="Enter Promo Code">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
</div>

@endsection


@section('scripts')
<script>
    $(document).ready(function() {
    $('#payment_method').change(function() {
        var selectedMethod = $(this).val();

        // Hide all fields first and remove the 'required' attribute
        $('#card_fields, #mpesa_fields, #sasapay_fields').hide().find('input').removeAttr('required');

        // Show fields based on selected payment method
        if (selectedMethod === 'card') {
            $('#card_fields').show().find('input').attr('required', true);
        } else if (selectedMethod === 'mpesa') {
            $('#mpesa_fields').show().find('input').attr('required', true);
        } else if (selectedMethod === 'sasapay') {
            $('#sasapay_fields').show().find('input').attr('required', true);
        }
    });

    // Submit form
    $('#paymentMethodForm').submit(function(event) {
        // Get the selected payment method
        var selectedMethod = $('#payment_method').val();

        // Set the corresponding payment method info field
        if (selectedMethod === 'card') {
            $('#payment_methodinfo').val($('#card_number').val());
        } else if (selectedMethod === 'mpesa') {
            $('#payment_methodinfo').val($('#mpesa_phone').val());
        } else if (selectedMethod === 'sasapay') {
            $('#payment_methodinfo').val($('#sasapay_email').val());
        }
    });
});

</script>
@endsection
