<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\DriverDashboardController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\VehiclesController;
use App\Http\Controllers\BookingController;

Route::get('/otp/verify/{user_id}', [OtpController::class, 'showVerifyForm'])->name('otp.verify');
Route::post('/otp/verify', [OtpController::class, 'verify'])->name('otp.verify.submit');

Route::get('register', [RegisterController::class, 'indexRegister'])->name('register.index');
Route::get('register/driver', [RegisterController::class, 'showDriverRegisterForm'])->name('register.driver');
Route::get('register/customer', [RegisterController::class, 'showCustomerRegisterForm'])->name('register.customer');
Route::post('register/customer', [RegisterController::class, 'registerCustomer'])->name('register.customerform');
Route::post('register/driver', [RegisterController::class, 'registerDriver'])->name('register.driverform');

//Route::get('register/driver', [RegisterController::class, 'showDriverRegisterForm'])->name('register.driver');
//Route::post('register/driver', [RegisterController::class, 'registerDriver']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.index');
Route::post('login', [LoginController::class, 'login'])->name('login.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/vehicle-models/{type_id}', [VehiclesController::class, 'getModelsByType'])->name('vehicle.models');


// booking taxi in the front page
Route::post('booking-frontpage', [BookingController::class, 'frontBooking'])->name('booking.frontpage');
Route::post('booking-checkuser', [BookingController::class, 'frontCheckUser'])->name('booking.checkuser');
Route::post('booking-loginuser', [BookingController::class, 'frontLoginUser'])->name('booking.loginuser');
Route::post('booking-check-booking', [BookingController::class, 'frontCheckBooking'])->name('booking.checkbooking');
Route::get('booking-update-price-distance', [BookingController::class, 'updatePriceDistance'])->name('booking.updatepricedistance');
Route::post('booking-get-route', [BookingController::class, 'frontGetRoute'])->name('booking.getroute');
Route::post('booking-cancel', [BookingController::class, 'bookingCancel'])->name('booking.cancel');

// Protect routes by role-based middleware

Route::middleware(['auth', 'role:admin'])->prefix('admin/dashboard')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [AdminDashboardController::class, 'adminProfile'])->name('admin.profile');
    Route::get('/booking', [AdminDashboardController::class, 'adminBooking'])->name('admin.booking');
});

Route::middleware(['auth', 'role:customer'])->prefix('customer/dashboard')->group(function () {
    Route::get('/', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/profile', [CustomerDashboardController::class, 'customerProfile'])->name('customer.profile');
    Route::get('/booking', [CustomerDashboardController::class, 'customerBooking'])->name('customer.booking');
    Route::post('/update-profile', [CustomerDashboardController::class, 'customerUpdateProfile'])->name('customer.updateprofile');
    Route::post('/update-password', [CustomerDashboardController::class, 'customerUpdatePassword'])->name('customer.updatepassword');
    Route::get('/fetch-pending-booking', [CustomerDashboardController::class, 'fetchPedingBooking'])->name('customer.fetchpendingbooking');
});

Route::middleware(['auth', 'role:driver'])->prefix('driver/dashboard')->group(function () {
    Route::get('/', [DriverDashboardController::class, 'index'])->name('driver.dashboard');
    Route::get('/profile', [DriverDashboardController::class, 'driverProfile'])->name('driver.profile');
    Route::get('/booking', [DriverDashboardController::class, 'driverBooking'])->name('driver.booking');
});

Route::middleware(['auth', 'role:staff'])->prefix('staff/dashboard')->group(function () {
    Route::get('/', [StaffDashboardController::class, 'index'])->name('staff.dashboard');
    Route::get('/profile', [StaffDashboardController::class, 'staffProfile'])->name('staff.profile');
    Route::get('/booking', [StaffDashboardController::class, 'staffBooking'])->name('staff.booking');
});

