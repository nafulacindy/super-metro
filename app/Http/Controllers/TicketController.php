<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;  
use App\Models\Passenger; 
use App\Models\Bus; 
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;


class TicketController extends Controller
{
    public function download($booking_id)
    {
        // dd("Inside downloadTicket method");
        $seatNumber = session('seat_number');
    
        // Retrieve necessary data from the database
        $booking = Bookings::findOrFail($booking_id);
        $passenger = Passenger::findOrFail($booking->passenger_id);
        $bus = Bus::findOrFail($booking->bus_id);
    
        // Retrieve fare based on your logic
        $fare = $booking->fare;

        $pdf = new Dompdf();
        // Generate PDF using the view file 'pdf.ticket
        $pdf->loadHtml(View::make('pdf.ticket', [
            'passenger' => $passenger->name,
            'bus' => $bus->registration_number,
            'scheduledTime' => $booking->scheduled_time,
            'seatNumber' => $seatNumber,
            'fare' => $fare,
            'paymentMethod' => 'M-Pesa',
            'paymentDate' => now(),
        ])->render());

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('defaultFont', 'Arial');

        // Set the options
        $pdf->setOptions($options);

        // Render the PDF
        $pdf->render();

        // Return the PDF as a stream for download
        return $pdf->stream('ticket.pdf');
        
    }
   
}
