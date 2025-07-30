<?php

use App\Livewire\Booking\BookingForm;
use App\Livewire\LandingPage;
use Illuminate\Support\Facades\Route;
use App\Models\Package;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', LandingPage::class)->name('home');

Route::get('/booking/{package}', BookingForm::class)->name('booking');
