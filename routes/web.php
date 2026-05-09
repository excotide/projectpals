<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.landing')->name('landing');
Route::view('/crud', 'pages.crud')->name('crud.page')->middleware('auth');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::prefix('auth')->group(function () {
	Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
	Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
	Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
	Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
