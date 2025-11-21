<?php

use Illuminate\Support\Facades\Route;

// Controllers Umum & Auth
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Controllers Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KosController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\UserController;

// Controllers User
use App\Http\Controllers\User\BookingController as UserBookingController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;

// Route Home (Publik)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kos/{id}', [HomeController::class, 'show'])->name('kos.show');
Route::get('/cari-kos', [HomeController::class, 'search'])->name('kos.search');

// Routes Auth (Login/Register)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes User
Route::middleware(['auth'])->group(function () {
    Route::get('/my-dashboard', [UserDashboardController::class, 'index'])->name('user.bookings.index');
    Route::get('/booking/{id}', [UserBookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/{id}', [UserBookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{id}/payment', [UserBookingController::class, 'payment'])->name('booking.payment');
    Route::put('/booking/{id}/payment', [UserBookingController::class, 'processPayment'])->name('booking.pay');
});

// Routes Admin
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('kos', KosController::class, ['names' => 'admin.kos']);
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
    Route::put('/bookings/{id}', [AdminBookingController::class, 'update'])->name('admin.bookings.update');
    Route::resource('facilities', FacilityController::class)->only(['index', 'store', 'destroy']);
    Route::resource('users', UserController::class)->only(['index', 'destroy']);
    Route::patch('/kos/{id}/update-status', [KosController::class, 'updateStatus'])->name('admin.kos.updateStatus');
});
