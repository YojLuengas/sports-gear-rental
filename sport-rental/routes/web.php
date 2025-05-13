<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Models\Equipment;
use App\Models\Rental;
use App\Models\RentalHistory; // 🔥 NEW for history
use App\Models\User;

// --- Authentication Routes ---
Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

// --- Registration Routes ---
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// --- Home Page ---
Route::get('/home', function () {
    if (!Auth::check()) return redirect('/'); // ✅ Auth check instead of session
    $equipment = Equipment::all();
    return view('home', compact('equipment'));
});

// --- Renting Equipment ---
Route::get('/rent/{id}', function($id) {
    if (!Auth::check()) return redirect('/');
    $equipment = Equipment::findOrFail($id);
    return view('rent', compact('equipment'));
});

Route::post('/rent/{id}', function(Request $request, $id) {
    Rental::create([
        'equipment_id' => $id,
        'student_name' => $request->student_name,  // Fix here, use 'student_name' instead of 'name'
        'year_level' => $request->year_level,      // Fix here, use 'year_level' instead of 'year'
        'rental_date' => $request->rental_date,
    ]);
    $equipment = Equipment::find($id);
    $equipment->increment('rented_quantity');
    return redirect('/home');
});

// --- Rental Records ---
Route::get('/records', function () {
    if (!Auth::check()) return redirect('/');
    $rentals = Rental::with('equipment')->get();
    return view('records', compact('rentals'));
});

// --- Return Equipment ---
Route::post('/return/{id}', function ($id) {
    $rental = Rental::findOrFail($id);
    $equipment = Equipment::findOrFail($rental->equipment_id);

    // Decrease rented quantity
    $equipment->decrement('rented_quantity');

    // Move rental to rental_histories
    RentalHistory::create([
        'equipment_id' => $rental->equipment_id,
        'student_name' => $rental->student_name,
        'year_level' => $rental->year_level,
        'rental_date' => $rental->rental_date,
        'returned_date' => now(),
    ]);

    // Delete from rentals
    $rental->delete();

    return redirect('/records');
});

// --- Update Rental Details ---
Route::put('/update/{id}', function(Request $request, $id) {
    $rental = Rental::findOrFail($id);
    $rental->update([
        'student_name' => $request->student_name,
        'year_level' => $request->year_level,
        'rental_date' => $request->rental_date,
    ]);
    return redirect('/records');
});

// --- Rental History Page ---
Route::get('/history', function(Request $request) {
    if (!Auth::check()) return redirect('/');

    $query = RentalHistory::query();

    if ($request->equipment_name) {
        $query->whereHas('equipment', function($q) use ($request) {
            $q->where('name', 'LIKE', '%' . $request->equipment_name . '%');
        });
    }

    if ($request->year_level) {
        $query->where('year_level', $request->year_level);
    }

    if ($request->rental_date) {
        $query->whereDate('rental_date', $request->rental_date);
    }

    $rentals = $query->with('equipment')->orderBy('rental_date', 'desc')->get();

    return view('history', compact('rentals'));
});

Route::delete('/delete/{id}', function ($id) {
    $rental = \App\Models\Rental::findOrFail($id);

    // Decrement the rented quantity of the equipment
    $equipment = \App\Models\Equipment::findOrFail($rental->equipment_id);
    $equipment->decrement('rented_quantity');

    // Delete the rental record
    $rental->delete();

    return redirect('/records')->with('success', 'Rental record deleted.');
});
