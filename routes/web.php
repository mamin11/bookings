<?php

use App\Http\Livewire\Login;
use App\Http\Livewire\Register;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

//email verification routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



//route groups
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('home');
    });
    
    //this login route handles both the login and register. Uses livewire component
    Route::livewire('/login', 'login')->name('login')
    ->layout('layouts.app')
    ->section('content');
});

//add 'prefix' => 'admin', before below middleware to define route group for admin. eg admin/dashboard
Route::group([ 'middleware' => 'auth'], function () {
    Route::livewire('/logout', 'logout')->name('logout');
    
});

//booking routes
Route::group(['prefix' => 'bookings', 'middleware' => 'verified'], function () {
    Route::livewire('/add', 'booking-component')
    ->name('addBooking')
    ->layout('layouts.dashboard')
    ->section('content');

    Route::livewire('/view', 'bookings.view')
    ->name('viewBookings')
    ->layout('layouts.dashboard')
    ->section('content');
    
});

//services routes
Route::group(['prefix' => 'services'], function () {
    Route::livewire('/', 'services.view')
    ->name('viewServices')
    ->layout('layouts.dashboard')
    ->section('content');
    
});

//customers routes
Route::group(['prefix' => 'customers'], function () {
    Route::livewire('/', 'customers.view')
    ->name('viewCustomers')
    ->layout('layouts.dashboard')
    ->section('content');
    
});

//staff routes
Route::group(['prefix' => 'staff'], function () {
    Route::livewire('/', 'staff.view')
    ->name('viewStaff')
    ->layout('layouts.dashboard')
    ->section('content');
    
});

//dashboard routes
Route::livewire('/dashboard', 'dashboard')
->layout('layouts.dashboard')
->name('dashboard');



