<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserSkillController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
	Route::post('/register', [AuthController::class, 'register']);
	Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
	Route::post('/auth/logout', [AuthController::class, 'logout']);
	Route::apiResource('room', RoomController::class);
});

Route::apiResource('user-skills', UserSkillController::class);
