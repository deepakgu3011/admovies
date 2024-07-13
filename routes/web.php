<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ContactController;
use App\Models\Movies;

// Public routes
Route::get('/', function () {
    $data['movies']= Movies::all()->where('status','active');
    return view('welcome',$data);
});

Route::get('aboutus', function () {
    return view('about');
});

Route::get('contact', function () {
    return view('contact');
});

Route::get('policy', function () {
    return view('policy');
});

Route::resource('contacts', ContactController::class);

// Authentication routes
Route::middleware(['guest'])->group(function () {
    Route::get('login', function () {
        return view('guest.login');
    });
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::get('add/register', function () {
        return view('guest.register');
    });
    Route::post('register', [AuthController::class, 'register'])->name('register');
});

// Routes protected by 'auth' middleware
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('movie', MovieController::class);


    Route::post('logout',[AuthController::class,'logout'])->name('logout');
});

Route::post('sendreply',[MovieController::class,'sendreply'])->name('sendReply');

// Fallback route
Route::fallback(function () {
    return redirect('/');
});
