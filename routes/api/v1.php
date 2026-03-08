<?php

use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TechnologyController;
use Illuminate\Support\Facades\Route;

Route::get('/', InfoController::class);

Route::get('profile', ProfileController::class);
Route::apiResource('projects', ProjectController::class)->only(['index', 'show']);
Route::apiResource('technologies', TechnologyController::class)->only(['index']);
