<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;

class BusController extends Controller
{
    
    public function index()
    {
        $buses = Bus::all();
        return view('bus.bus_index', compact('buses'));
    }

    public function create()
    {
        return view('bus.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'registration_number' => 'required|unique:buses',
            'bus_model' => 'required',
            'seating_capacity' => 'required|integer|min:1',
            'status' => 'required',
        ]);

        Bus::create($data);
        return redirect()->route('bus.index')->with('success', 'Bus created successfully!');
    }

    public function edit($bus)
{
    $bus = Bus::findOrFail($bus);
    return view('bus.edit', compact('bus'));
}

    public function update(Request $request, Bus $bus)
    {
        $data = $request->validate([
            'registration_number' => 'required|unique:buses,registration_number,' . $bus->id,
            'bus_model' => 'required',
            'seating_capacity' => 'required|integer|min:1',
            'status' => 'required',
        ]);

        $bus->update($data);
        return redirect()->route('bus.index')->with('success', 'Bus updated successfully!');
    }

    public function destroy($bus)
    {
        $bus = Bus::findOrFail($bus);
        $bus->delete();
        return redirect()->route('bus.index')->with('success', 'Bus deleted successfully!');
    }
    
}
