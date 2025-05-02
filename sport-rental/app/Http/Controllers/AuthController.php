<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the registration form
    public function showRegister()
    {
        return view('auth.register');  // Ensure this view exists in resources/views/auth/register.blade.php
    }

    // Handle the registration logic
    public function register(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|ends_with:@hcdc.edu.ph',
            'password' => 'required|string|min:8|confirmed',  // Ensure 'password_confirmation' exists in the form
        ]);

        // Create the new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Hash the password
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to the home page
        return redirect('/home');
    }
}
