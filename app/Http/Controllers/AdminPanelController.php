<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\User;
use ConsoleTVs\Charts\Facades\Charts;
use App\Models\Bookings;
use Carbon\Carbon;

class AdminPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $totalBuses = Bus::count();
        $totalUsers = User::count(); 
        $totalBookings = Bookings::count();
        
        return view('AdminPanel', compact('totalBuses','totalUsers','totalBookings'));
    }
       public function approveBookings()
    {
        $bookings = Bookings::where('status', 'approved')->get();
        return view('approve_bookings', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id

     */
//     public function show()
// {
//      // Fetch bookings data
//      try {
//         $bookings = Bookings::all();
//     } catch (\Exception $e) {
//         dd($e->getMessage());
//     }
//      // Check if there are bookings
//      if ($bookings->isEmpty()) {
//          // No bookings, return an empty chart
//          $chart = null;
//      } else {
//          // Create the chart
//          $chart = Charts::database($bookings, 'bar', 'highcharts')
//              ->title('Weekly Bookings')
//              ->elementLabel('Bookings')
//              ->dimensions(1000, 500)
//              ->responsive(false)
//              ->groupByWeek();
          
//              dd($chart);

//      }
 
//      // Pass the chart data to the view
//      return view('AdminPanel', compact('chart'));
// }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}


