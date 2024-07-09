<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;
use App\Models\LostItemReport;

class AdminController extends Controller
{
        // Show the admin login form
        public function showAdminLoginForm()
        {
            return view('auth.admin-login');
        }
    
        // Process admin login
        public function adminLogin(Request $request)
        {
            // Validate the admin's credentials
            $credentials = $request->only('email', 'password');
    
            if (Auth::attempt($credentials)) {
                // The admin is logged in, redirect them to the admin dashboard
                return redirect()->route('AdminPanel.index');
            } else {
                // If the admin's login attempt fails, redirect them back to the admin login page with an error message
                return redirect()->route('admin.login')->with('error', 'Admin login failed. Please check your credentials.');
            }
}
    public function feedback()
    {
                // Retrieve feedback details from the database
                $feedbacks = Feedback::all();

                // Retrieve lost item report details from the database
                $lostItemReports = LostItemReport::all();
        
                // Pass the data to the view
                return view('admin.feedback', compact('feedbacks', 'lostItemReports'));
        
    }


}