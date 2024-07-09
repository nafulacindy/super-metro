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
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\MpesaPaymentController;
use App\Http\Controllers\FeedbackController;






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



Route::get('/tasks', [TaskController::class, 'showTaskView'])->name('tasks.view');
Route::post('/payment-methods', [PaymentMethodController::class, 'store'])->name('payment-method.store');
Route::post('/apply-promo', [PaymentMethodController::class, 'applyPromo'])->name('payment.apply-promo');

Route::resource('home', \App\Http\Controllers\HomeController::class);
Route::resource('contact', \App\Http\Controllers\ContactController::class);
Route::resource('create', \App\Http\Controllers\BookingController::class);
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::resource('available-bookings', \App\Http\Controllers\BookingController::class);
Route::resource('AdminPanel', \App\Http\Controllers\AdminPanelController::class)->middleware('admin');
Route::resource('bus', \App\Http\Controllers\BusController::class)->middleware('admin');
Route::resource('route', \App\Http\Controllers\RouteController::class)->middleware('admin');
Route::resource('schedules', \App\Http\Controllers\ScheduleController::class)->middleware('admin');
Route::match(['get', 'post'], '/bookings/select-seats', [BookingController::class, 'selectSeats'])->name('bookings.selectSeats');
Route::match(['get', 'post'],'/bookings/seat-selection/{busId}/{scheduledTime}', [BookingController::class, 'seatSelection'])->name('bookings.seatSelection');
Route::match(['get', 'post'],'/bookings/enter-details', [BookingController::class, 'enterDetails'])->name('bookings.enterDetails');
Route::match(['get', 'post'], '/bookings/submit-details', [BookingController::class, 'submitDetails'])->name('bookings.submitDetails');
Route::match(['get', 'post'], '/bookings/payment/{booking_id}', [BookingController::class, 'payment'])->name('bookings.payment');
Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('/paypal/checkout', [PaymentController::class, 'processPayment'])->name('paypal.checkout');

Route::post('/mpesa/initiate-payment', [MpesaPaymentController::class, 'initiatePayment'])->name('mpesa.initiatePayment');
Route::post('/mpesa/callback', [MpesaPaymentController::class, 'handleCallback'])->name('mpesa.callback');


Route::match(['get', 'post'],'/bookings/store-payment/{booking_id}', [BookingController::class, 'storePayment'])->name('bookings.storePayment');
Route::get('/bookings/confirmation/{booking_id}', [BookingController::class, 'confirmation'])->name('bookings.confirmation');
Route::get('/ticket/{booking_id}', [TicketController::class, 'download'])->name('ticket.download');
Route::get('/booking/history', [BookingController::class, 'bookingHistory'])->name('booking.history');
Route::post('/booking/{booking_id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
Route::post('/bookings/{booking_id}/rebook', [BookingController::class, 'rebook'])->name('bookings.rebook');
Route::get('/admin/login', [AdminController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'adminLogin']);

 Route::get('/payment-methods/create', [PaymentMethodController::class, 'create'])->name('payment-methods.create');
Route::post('/payment-methods/store', [PaymentMethodController::class, 'store'])->name('payment-methods.store');
Route::get('/admin/dashboard', [\App\Http\Controllers\AdminPanelController::class, 'show'])->name('admin.dashboard');


Route::get('/admin/feedback', [AdminController::class, 'feedback'])->name('admin.feedback');


Route::get('/approve_bookings', [AdminPanelController::class, 'approveBookings'])->name('approve_bookings');
Route::post('/submit-feedback', [FeedbackController::class, 'submitFeedback'])->name('submitFeedback');
Route::post('/submit-lost-item-report', [FeedbackController::class, 'reportLostItem'])->name('submitLostItemReport');



