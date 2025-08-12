<?php

use App\Livewire\Article\ShowArticle;
use App\Livewire\Booking\BookingForm;
use App\Livewire\LandingPage;
use Illuminate\Support\Facades\Route;
use App\Models\Package;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', LandingPage::class)->name('home');

Route::get('/booking/{package}', BookingForm::class)->name('booking');
Route::get('/article/{article}', ShowArticle::class)->name('article.show');
