<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.landing')->name('landing');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
