<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bookings;
use App\Models\Bus;
use App\Models\Route;
use App\Models\SeatReservation;
use App\Models\Passenger;
use App\Models\Payment;


class BookingController extends Controller
{
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
        $bookedSeats = SeatReservation::where('bus_id', $busId)
            
        
            ->pluck('seat_number');

    
        
        if ($request->isMethod('post')) {
            $request->validate([
                'seat_number' => [
                    'required',
                    'integer',
                    'min:1',
                    'max:' . $bus->seating_capacity,
                    Rule::notIn($bookedSeats), // Check if the selected seat is not already booked
                ],
            ], [
                'seat_number.not_in' => 'The selected seat is already booked. Please choose another seat.',
            ]);

            $request->session()->put('selected_seat', [
                'bus_id' => $busId,
                'scheduled_time' => $request->input('scheduled_time'),
                'seat_number' => $request->input('seat_number'),
            ]);
    
         // Redirect to the enterDetails view to allow users to fill in their personal details
            return redirect()->route('bookings.enterDetails');
        }
        
        $selectedSeat = $request->session()->get('selected_seat');

        return view('bookings.seat_selection', [
            'bus' => $bus,
            'bookedSeats' => $bookedSeats,
            'scheduledTime' => $scheduledTime,
            'selectedSeat' => $selectedSeat,
    
        ]);
    
    }
    
    public function enterDetails(Request $request)
    {
        
         // Retrieve the necessary data from the session or input
         $busId = $request->input('bus_id');
         $scheduledTime = $request->input('scheduled_time');
         $seatNumber = $request->input('seat_number');
         $pickupLocation = session('pickup_location');
         $destination = session('destination');

         

         session([
             'bus_id' => $busId,
             'scheduled_time' => $scheduledTime,
             'seat_number' => $seatNumber,
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
             'seatNumber' => $seatNumber,
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
    $seatNumber = session('seat_number');
    $pickupLocation = session('pickup_location');
    $destination = session('destination');

    // Create a new Passenger record
    $passenger = new Passenger([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'contact_no' => $request->input('contact_no'),
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
        'status' => 'Pending',
    ]);
    $booking->save();

    // Create a new SeatReservation record
    $seatReservation = new SeatReservation([
        'passenger_id' => $passenger->passenger_id, // Assuming 'id' is the primary key of the Passenger model
        'booking_id' => $booking->booking_id,
        'bus_id' => $busId,
        'seat_number' => $seatNumber,
        // Set other attributes here
    ]);
    $seatReservation->save();

    // Redirect to a confirmation page or any other desired page
    return redirect(url('bookings/payment/' . $booking->booking_id));


}

public function payment(Request $request, $booking_id)
{
     
    
     // Retrieve pickup location and destination from session
     $pickupLocation = session('pickup_location');
     $destination = session('destination');
     $seatNumber = session('seat_number');
    
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

    
    return view('bookings.payment', [
        'passenger' => $passenger,
        'bus' => $bus,
        'scheduledTime' => $booking->scheduled_time,
        'seatNumber' => $seatNumber,
        'fare' => $fare,
        'booking' => $booking,
    ]);
}

public function storePayment(Request $request, $booking_id)
{
    $seatNumber = session('seat_number');
    // Retrieve the booking record
    $booking = Bookings::findOrFail($booking_id);
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
      // Retrieve the associated seat reservations


    

     // Store the payment
     $payment = new Payment([
        'booking_id' => $booking_id,
        'passenger_id' => $passenger_id,
        'amount' => $fare,
        'payment_method' => 'M-Pesa',
        'status' => 'Paid', // Assuming the payment is instantly considered as paid
        'payment_date' => now(), // Assuming the payment is made instantly
     ]);
     $payment->save();

     
     return view('bookings.confirmation', [
            'booking' => $booking,
            'passenger' => $passenger,
            'bus' => $bus,
            'scheduledTime' => $booking->scheduled_time,
            'seatNumber' => $seatNumber, // Pass the seat reservations to the confirmation view
            'fare' => $fare,
            'paymentMethod' => 'M-Pesa', // You can modify this based on your logic
            'paymentDate' => now(), // You can modify this based on your logic
        ]);
    }

    public function confirmation($booking_id)
{
    $seatNumber = session('seat_number');
    // Retrieve necessary data from the database
    $booking = Bookings::findOrFail($booking_id);
    $passenger = Passenger::findOrFail($booking->passenger_id);
    $bus = Bus::findOrFail($booking->bus_id);

    // You can add more logic here if needed

    return view('bookings.confirmation', [
        'booking' => $booking,
        'passenger' => $passenger,
        'bus' => $bus,
        'scheduledTime' => $booking->scheduled_time,
        'seatNumber' => $seatNumber, // Make sure to get the seat number from where it's stored
        'fare' => $fare, // Retrieve fare based on your logic
        'paymentMethod' => 'M-Pesa', // You can modify this based on your logic
        'paymentDate' => now(), // You can modify this based on your logic
    ]);
}

    


    }


       



