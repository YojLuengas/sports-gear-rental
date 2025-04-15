<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin() {
        return view('login');
    }
    
    public function login(Request $request) {
        if ($request->email === 'yojluengas@hcdc.edu.ph' && $request->password === 'password') {
            session(['logged_in' => true]);
            return redirect('/home');
        }
        return back()->with('error', 'Invalid credentials.');
    }
    
    public function logout() {
        session()->forget('logged_in');
        return redirect('/');
    }
    
}
