<?php

use App\Http\Livewire\Login;
use App\Http\Livewire\Register;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'bookings'], function () {
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
    Route::livewire('/view', 'services.view')
    ->name('viewServices')
    ->layout('layouts.dashboard')
    ->section('content');
    
});

//customers routes
Route::group(['prefix' => 'customers'], function () {
    Route::livewire('/view', 'customers.view')
    ->name('viewCustomers')
    ->layout('layouts.dashboard')
    ->section('content');
    
});

//dashboard routes
Route::livewire('/dashboard', 'dashboard')
->layout('layouts.dashboard')
->name('dashboard');



