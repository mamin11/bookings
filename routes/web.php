<?php

use App\Http\Livewire\Login;
use Illuminate\Http\Request;
use App\Http\Livewire\Register;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
    try {
        $request->user()->sendEmailVerificationNotification();
    } catch (Exception $e) {
        // dd($e);
        Session::flash('alert-class', 'alert-danger');
        return back()->with('message', $e->getMessage().' !');
    }

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//login with google
Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('google/callback', 'Auth\LoginController@handleProviderCallback');



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
    ->section('content')->middleware('checkIsNotCustomer');
    
});

//services routes
Route::group(['prefix' => 'services', 'middleware' => 'verified'], function () {
    Route::livewire('/', 'services.view')
    ->name('viewServices')
    ->layout('layouts.dashboard')
    ->section('content')->middleware('checkIsNotCustomer');
    
});

//customers routes
Route::group(['prefix' => 'customers', 'middleware' => ['verified', 'checkIsNotCustomer']], function () {
    Route::livewire('/', 'customers.view')
    ->name('viewCustomers')
    ->layout('layouts.dashboard')
    ->section('content');

});

//view my bookings route
Route::livewire('/mybookings', 'customer.bookings.view')
->name('mybookings')
->layout('layouts.dashboard')
->section('content')->middleware('auth');

//staff routes
Route::group(['prefix' => 'staff', 'middleware' => 'auth'], function () {
    Route::livewire('/', 'staff.view')
    ->name('viewStaff')
    ->layout('layouts.dashboard')
    ->section('content')->middleware('checkIsNotCustomer');
    
});

//user profile route
Route::livewire('/account', 'userprofile.view')
->name('myAccount')
->layout('layouts.dashboard')
->section('content')->middleware('auth');

//product data route
Route::livewire('/productdata', 'productdata.view')
->name('productdata')
->layout('layouts.dashboard')
->section('content')->middleware('auth', 'checkIsNotCustomer');
    
//dashboard routes
Route::livewire('/dashboard', 'dashboard')
->layout('layouts.dashboard')
->name('dashboard')->middleware('auth');

//calendar route
Route::get('/calendar','CalendarController@index')->name('viewCalendar')->middleware('auth');
Route::get('/iCalendar','IcalendarController@getIcalEvents')->name('getIcalendar')->middleware('auth');

// Route::get('/invoice', function() {
    //     return view('livewire.invoice');
    // });
Route::group([ 'middleware' => ['auth', 'checkIsCustomer']], function () {
    Route::get('/checkout/{id}', 'Controller@checkout')->name('customerCheckout');
    Route::post('/checkout', 'Controller@checkoutsubmit')->name('customerSubmit');
    Route::get('payment-successfull', 'Controller@success')->name('payment-successfull');    
});
