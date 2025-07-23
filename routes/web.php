<?php

use App\Livewire\Booking\BookingForm;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/booking', BookingForm::class)->name('booking');
