<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.landing')->name('landing');
Route::view('/crud', 'pages.crud')->name('crud.page');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
