<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}