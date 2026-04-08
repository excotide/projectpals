<?php

use App\Http\Controllers\Api\UserSkillController;
use Illuminate\Support\Facades\Route;

Route::apiResource('user-skills', UserSkillController::class);
