<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TechnologyController;
use Illuminate\Support\Facades\Route;

Route::apiResource('projects', ProjectController::class)->only(['index', 'show']);
Route::apiResource('technologies', TechnologyController::class)->only(['index']);
