<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Show login form
    public function showLogin() {
        return view('login');
    }
    
    // Handle login logic
    public function login(Request $request) {
        // Validate the input data
        $request->validate([
            'email' => 'required|email|ends_with:@hcdc.edu.ph',
            'password' => 'required|min:6',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            // If authentication is successful, redirect to the home page
            return redirect('/home');
        }

        // If authentication fails, redirect back with an error
        return back()->with('error', 'Invalid credentials or unverified email.');
    }
    
    // Handle logout logic
    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
