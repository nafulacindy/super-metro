<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\BusController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
});


Route::resource('tasks', \App\Http\Controllers\TaskController::class);
Route::resource('payment', \App\Http\Controllers\PaymentController::class);
Route::resource('AdminPanel', \App\Http\Controllers\AdminPanelController::class);
Route::resource('home', \App\Http\Controllers\HomeController::class);
Route::resource('contact', \App\Http\Controllers\ContactController::class);
Route::resource('create', \App\Http\Controllers\BookingController::class);
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::resource('available-bookings', \App\Http\Controllers\BookingController::class);
Route::resource('bus', \App\Http\Controllers\BusController::class);
Route::resource('route', \App\Http\Controllers\RouteController::class);
Route::resource('schedules', \App\Http\Controllers\ScheduleController::class);
Route::match(['get', 'post'], '/bookings/select-seats', [BookingController::class, 'selectSeats'])->name('bookings.selectSeats');
Route::match(['get', 'post'],'/bookings/seat-selection/{busId}/{scheduledTime}', [BookingController::class, 'seatSelection'])->name('bookings.seatSelection');
Route::match(['get', 'post'],'/bookings/enter-details', [BookingController::class, 'enterDetails'])->name('bookings.enterDetails');
Route::match(['get', 'post'], '/bookings/submit-details', [BookingController::class, 'submitDetails'])->name('bookings.submitDetails');
Route::match(['get', 'post'], '/bookings/payment/{booking_id}', [BookingController::class, 'payment'])->name('bookings.payment');

Route::match(['get', 'post'],'/bookings/store-payment/{booking_id}', [BookingController::class, 'storePayment'])->name('bookings.storePayment');
Route::get('/bookings/confirmation/{booking_id}', [BookingController::class, 'confirmation'])->name('bookings.confirmation');





