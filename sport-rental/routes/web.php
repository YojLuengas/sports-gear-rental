<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Models\Equipment;
use App\Models\Rental;


Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/home', function () {
    if (!session('logged_in')) return redirect('/');
    $equipment = Equipment::all();
    return view('home', compact('equipment'));
});

Route::get('/rent/{id}', function($id) {
    if (!session('logged_in')) return redirect('/');
    $equipment = Equipment::findOrFail($id);
    return view('rent', compact('equipment'));
});

Route::post('/rent/{id}', function(Request $request, $id) {
    Rental::create([
        'equipment_id' => $id,
        'student_name' => $request->name,
        'year_level' => $request->year,
        'rental_date' => $request->date,
    ]);
    $equipment = Equipment::find($id);
    $equipment->increment('rented_quantity');
    return redirect('/home');
});
