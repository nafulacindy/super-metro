<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\Bus;




class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::all();
        return view('route.index', compact('routes'));
    }

    public function create()
    {
        $buses = Bus::all();
        return view('route.create', compact('buses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'bus_id' => 'required|exists:buses,bus_id',
            'start_location' => 'required',
            'end_location' => 'required',
            'distance' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:0',
            'fare' => 'required|numeric|min:0',
        ]);

        Route::create($data);
        return redirect()->route('route.index')->with('success', 'Route created successfully!');
    }

    public function edit(Route $route)
    {
        $buses = Bus::all();
        return view('route.edit', compact('route', 'buses'));
    }

    

    public function update(Request $request, Route $route)
    {
        $data = $request->validate([
            'bus_id' => 'required|exists:buses,bus_id',
            'start_location' => 'required',
            'end_location' => 'required',
            'distance' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:0',
            'fare' => 'required|numeric|min:0',
        ]);

        $route->update($data);
        return redirect()->route('route.index')->with('success', 'Route updated successfully!');
    }

    public function destroy(Route $route)
    {
        $route->delete();
        return redirect()->route('route.index')->with('success', 'Route deleted successfully!');
    }
}
