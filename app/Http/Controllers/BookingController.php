<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bookings;
use App\Models\Bus;
use App\Models\Route;
use App\Models\PaymentMethod;
use App\Models\SeatReservation;
use App\Models\Passenger;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;




class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function selectSeats(Request $request)
    {
            $pickupLocation = $request->input('pickup_location');
            $destination = $request->input('destination');
            $scheduledTime = $request->input('scheduled_time');
            session([
                'pickup_location' => $pickupLocation,
                'destination' => $destination,
                'scheduled_time' => $scheduledTime,
            ]);
            $availableBuses = Bus::where('status', 'Active')
              ->with('route')
              ->whereHas('schedules.route', function ($query) use ($pickupLocation, $destination) {
            $query->where('start_location', $pickupLocation)
                ->where('end_location', $destination);
            })
             ->whereDoesntHave('bookings', function ($query) use ($scheduledTime) {
            $query->where('scheduled_time', $scheduledTime);
            })
           
            ->get();
           

            return view('bookings.select_seats', [
             'availableBuses' => $availableBuses,
             'pickupLocation' => $pickupLocation,
             'destination' => $destination,
             'scheduledTime' => $scheduledTime,
            ]);
    }

    public function seatSelection(Request $request, $busId, $scheduledTime)
    {
        $bus = Bus::find($busId);
    
        // Retrieve pickup location and destination from session
        $pickupLocation = session('pickup_location');
        $destination = session('destination');
    
        if ($request->isMethod('post')) {
            $selectedSeatNumber = $request->input('selected_seat');
            \Log::info('Selected Seat Number:', [$selectedSeatNumber]);
    
            // Validate the selected seat number
            // Add your validation logic here
    
            // Store the selected seat in the session
            $request->session()->put('selected_seat', [
                'bus_id' => $busId,
                'scheduled_time' => $scheduledTime,
                'seat_number' =>  $selectedSeatNumber,
            ]);
    
            return redirect()->route('bookings.enterDetails');
        }
    
        // Other logic for displaying available seats
    
        return view('bookings.seat_selection', [
            'bus' => $bus,
            'pickupLocation' => $pickupLocation,
            'destination' => $destination,
            'scheduledTime' => $scheduledTime,
        ]);
    }
    
    
    
    
    
    
    public function enterDetails(Request $request)
    {
        
         // Retrieve the necessary data from the session or input
         $busId = $request->input('bus_id');
         $scheduledTime = $request->input('scheduled_time');
         $selectedSeatNumber = $request->input('seat_number');
         $pickupLocation = session('pickup_location');
         $destination = session('destination');

         

         session([
             'bus_id' => $busId,
             'scheduled_time' => $scheduledTime,
             'seat_number' => $selectedSeatNumber,
         ]);
    
          // Check if seat_number is stored in the session
         
         $bus = Bus::find($busId);
         
         // You can also perform any necessary database queries here
         // For example, retrieve the bus information based on $busId

         // Render the enter_details view with the retrieved data
         return view
         ('bookings.enter_details', [
             'busId' => $busId,
             'bus' => $bus,
             'scheduledTime' => $scheduledTime,
             'selectedSeatNumber' => $selectedSeatNumber,
             // You can pass other data here if needed
         ]);
    }

    public function submitDetails(Request $request)
{
    // Validate the input fields
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'contact_no' => 'required|string',
    ]);

    // Retrieve session data
    $busId = session('bus_id');
    $scheduledTime = session('scheduled_time');
    $selectedSeatNumber = session('seat_number');
    $pickupLocation = session('pickup_location');
    $destination = session('destination');

    // Create a new Passenger record
    $passenger = new Passenger([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'contact_no' => $request->input('contact_no'),
        'user_id' => Auth::id(),
        // Set other attributes here
    ]);
    $passenger->save();

    // Create a new Booking record
    $booking = new Bookings([
        'passenger_id' => $passenger->passenger_id, // Assuming 'id' is the primary key of the Passenger model
        'bus_id' => $busId,
        'pickup_location' => $pickupLocation,
        'destination' => $destination,
        'scheduled_time' => $scheduledTime,
        'status' => 'Approved',
    ]);
    $booking->save();

    // Create a new SeatReservation record
    $seatReservation = new SeatReservation([
        'passenger_id' => $passenger->passenger_id, // Assuming 'id' is the primary key of the Passenger model
        'booking_id' => $booking->booking_id,
        'bus_id' => $busId,
        'seat_number' => $selectedSeatNumber,
        // Set other attributes here
    ]);
    $seatReservation->save();

    // Redirect to a confirmation page or any other desired page
    return redirect(url('bookings/payment/' . $booking->booking_id));


}

public function payment(Request $request, $booking_id)
{
    // $paymentMethods = PaymentMethod::where('user_id', Auth::id())->get();
    // Log::info($paymentMethods);
    // // Retrieve pickup location and destination from session
    $pickupLocation = session('pickup_location');
    $destination = session('destination');
    $selectedSeatNumber = session('seat_number');

    // Retrieve the booking record
    $booking = Bookings::findOrFail($booking_id);

    // Retrieve other related data
    $passenger = Passenger::findOrFail($booking->passenger_id);
    $bus = Bus::findOrFail($booking->bus_id);

    // Calculate fare and other necessary data
    // Retrieve fare from the corresponding route
    $route = Route::where('start_location', $pickupLocation)
        ->where('end_location', $destination)
        ->firstOrFail();
    $fare = $route->fare;

    // Get payment methods for the user
    $paymentMethods = PaymentMethod::where('user_id', Auth::id())->get();

    return view('bookings.payment', [
        'passenger' => $passenger,
        'bus' => $bus,
        'scheduledTime' => $booking->scheduled_time,
        'selectedSeatNumber' => $selectedSeatNumber,
        'fare' => $fare,
        'booking' => $booking,
        'paymentMethods' => $paymentMethods, // Pass the payment methods to the view
    ]);
}

public function storePayment(Request $request, $booking_id)
{
    // Retrieve the booking record
    $booking = Bookings::findOrFail($booking_id);

    // Retrieve other related data
    $passenger = Passenger::findOrFail($booking->passenger_id);
    $bus = Bus::findOrFail($booking->bus_id);

    // Retrieve the fare amount from the route
    $pickupLocation = session('pickup_location');
    $destination = session('destination');
    $route = Route::where('start_location', $pickupLocation)
         ->where('end_location', $destination)
         ->firstOrFail();
    $fare = $route->fare;

    // Retrieve the passenger ID from the booking record
    $passenger_id = $booking->passenger_id;

    // Log payment details for debugging
    \Log::info('Payment details:', [
        'booking_id' => $booking_id,
        'passenger_id' => $passenger_id,
        'fare' => $fare,
        'payment_method' => 'PayPal',
        'status' => $request->input('paypal_status'), // Assuming the payment status is passed from PayPal
        'payment_date' => now(), // Assuming the payment is made instantly
    ]);

    // Store the payment
    $payment = new Payment([
        'booking_id' => $booking_id,
        'passenger_id' => $passenger_id,
        'amount' => $fare,
        'payment_method' => 'PayPal',
        'status' => 'Paid', // Assuming the payment status is passed from PayPal
        'payment_date' => now(), // Assuming the payment is made instantly
    ]);
    $payment->save();
   // Store the fare value in the session
    session(['fare' => $fare]);

    // Flash success message
    $request->session()->flash('success_message', 'Payment successful!');

    // Redirect to the confirmation page
    return redirect()->route('bookings.confirmation', [
        'booking_id' => $booking_id,
        'passenger' => $passenger,
        'bus' => $bus,
        'scheduledTime' => $booking->scheduled_time,
        'selectedSeatNumber' => session('seat_number'),
        'fare' => $fare,
        'paymentMethod' => 'PayPal', // You can modify this based on your logic
        'paymentDate' => now(), // You can modify this based on your logic
    ]);
}

    public function confirmation($booking_id)
{
    $selectedSeatNumber = session('seat_number');
    // Retrieve necessary data from the database
    $booking = Bookings::findOrFail($booking_id);
    $passenger = Passenger::findOrFail($booking->passenger_id);
    $bus = Bus::findOrFail($booking->bus_id);
    // Retrieve the fare value from the session
$fare = session('fare');

    // $fare = $booking->calculateFare();
    // You can add more logic here if needed

    return view('bookings.confirmation', [
        'booking' => $booking,
        'passenger' => $passenger,
        'bus' => $bus,
        'scheduledTime' => $booking->scheduled_time,
        'selectedSeatNumber' => $selectedSeatNumber, // Make sure to get the seat number from where it's stored
        'fare' => $fare, // Retrieve fare based on your logic
        'paymentMethod' => 'Paypal', // You can modify this based on your logic
        'paymentDate' => now(), // You can modify this based on your logic
    ]);
    

    
}
public function bookingHistory()
{
    // Get the ID of the logged-in user
    $userId = Auth::id();

    // Find the Passenger based on the user_id
    $passenger = Passenger::where('user_id', $userId)->first();

    // Check if the passenger exists
    if (!$passenger) {
        // Handle case where passenger is not found
        return "No passenger found with the specified user ID.";
    }

    // Retrieve the booking history for the passenger
    $bookings = $passenger->bookings()->with('bus')->orderByDesc('created_at')->get();

    // Check if any bookings were found
    if ($bookings->isEmpty()) {
        // Handle case where no bookings were found
        return "No bookings found for this passenger.";
    }

    // Pass the $bookings variable to the view
    return view('booking_history', compact('bookings'));
}
public function cancel($booking_id)
    {
        try {
            // Find the booking with the passenger relationship
            $booking = Bookings::with('passenger')->find($booking_id);

            // Check if the booking exists
            if (!$booking) {
                return redirect()->back()->with('error', 'Booking not found.');
            }

            // Check if the logged-in user owns the booking
            if ($booking->passenger && $booking->passenger->user_id !== Auth::id()) {
                return redirect()->back()->with('error', 'You are not authorized to cancel this booking.');
            }

            // Update the booking status to "Cancelled"
            $booking->status = 'Cancelled';
            $booking->save();

            // If update was successful, redirect back with a success message
            return redirect()->route('booking.history')->with('success', 'Booking has been cancelled successfully.');
        } catch (\Exception $e) {
            // Handle any exceptions here
            return redirect()->route('booking.history')->with('error', 'Failed to cancel booking. Error: '.$e->getMessage());
        }
    }
    public function rebook($booking_id)
{
    // Find the booking by ID
    $booking = Bookings::find($booking_id);

    // Check if the booking exists
    if (!$booking) {
        return redirect()->back()->with('error', 'Booking not found.');
    }

    // Check if the booking is cancelled
    if ($booking->status !== 'Cancelled') {
        return redirect()->back()->with('error', 'Booking is not cancelled.');
    }

    // Logic for rebooking
    // For simplicity, let's redirect to the beginning of the booking process
    return redirect()->route('bookings.selectSeats')->with('success', 'Booking rebooked successfully.');
}
}




       



