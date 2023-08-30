<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller{
    public function index()
    {
        return view('contact\contact');
    }

    public function send(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

    if ($validator->fails()) {
        return redirect()->route('contact')->withErrors($validator)->withInput();
    }

    // Add code to handle the form submission

    // Redirect back to the contact page with a success message
    return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
}
}

