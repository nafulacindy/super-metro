<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Route;
use App\Models\Bus;


class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::with('route', 'bus')->get();
        return view('schedules.schedule_index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    $routes = Route::all();
    $buses = Bus::all();
    return view('schedules.schedule_create', compact('routes', 'buses'));
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'route_id' => 'required|exists:routes,route_id',
        'bus_id' => 'required|exists:buses,bus_id',
        'departure_time' => 'required|date_format:H:i',
        'arrival_time' => 'required|date_format:H:i|after:departure_time',
        'schedule_date' => 'required|date_format:Y-m-d|after_or_equal:today',
    ]);

    Schedule::create($data);

    return redirect()->route('schedules.index')->with('success', 'Schedule created successfully!');

}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    $schedule = Schedule::findOrFail($id);
    $routes = Route::all();
    $buses = Bus::all(); // Fetch all buses to pass to the view
    return view('schedules.schedule_edit', compact('schedule', 'routes', 'buses'));
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
        try {
        // Find the schedule by ID
        $schedule = Schedule::findOrFail($id);
    
        // Validate the request data
        $data = $request->validate([
            'route_id' => 'required|exists:routes,route_id',
            'bus_id' => 'required|exists:buses,bus_id',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i|after:departure_time',
            'schedule_date' => 'required|date_format:Y-m-d|after_or_equal:today',
        ]);
    
        // Update the schedule with the validated data
        // Update the schedule with the validated data
        $schedule->update($data);

        // Redirect back to the schedule index page
        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully!');
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
}
    
     

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    $schedule = Schedule::findOrFail($id);
    $schedule->delete();

    return redirect()->route('schedules.index')->with('success', 'Schedule created successfully!');

}

}
