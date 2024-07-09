<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\LostItemReport;

class FeedbackController extends Controller
{
    public function submitFeedback(Request $request)
    {
        $feedback = new Feedback();
        $feedback->feedback = $request->input('feedback');
        $feedback->save();
    
        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }
    
    public function reportLostItem(Request $request)
    {
        $lostItemReport = new LostItemReport();
        $lostItemReport->bus_registration = $request->input('bus_registration');
        $lostItemReport->travel_date = $request->input('travel_date');
        $lostItemReport->luggage_description = $request->input('luggage_description');
        $lostItemReport->save();
    
        return redirect()->back()->with('success', 'Lost item report submitted successfully!');
    }
}
