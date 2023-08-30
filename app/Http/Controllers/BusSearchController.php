<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use Carbon\Carbon;

class BusSearchController extends Controller
{
    public function index()
    {
        return view('bus.search');
    }

    public function searchBuses(Request $request)
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $travelDate = Carbon::createFromFormat('Y-m-d H:i:s', $request->input('travel_date'));

        // Fetch available buses based on the user's search criteria
        $availableBuses = Bus::where('origin', $origin)
            ->where('destination', $destination)
            ->where('departure_time', '>=', $travelDate)
            ->get();

        return view('bus.search-results', compact('availableBuses', 'origin', 'destination', 'travelDate'));
    }
}
