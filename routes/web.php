<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\CompetitorController;
use App\Http\Controllers\RoundController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('layouts/app');
});

// Competition routes
Route::get('/competitions', [CompetitionController::class, 'index']);
Route::get('/competition/{id}', [CompetitionController::class, 'show']);
Route::post('/competition', [CompetitionController::class, 'store']);
Route::put('/competition/{id}', [CompetitionController::class, 'update']);
Route::delete('/competition/{id}', [CompetitionController::class, 'destroy']);

// Competitor routes
Route::get('/competitors', [CompetitorController::class, 'index']);
Route::get('/competitor/{id}', [CompetitorController::class, 'show']);
Route::post('/competitor', [CompetitorController::class, 'store']);
Route::put('/competitor/{id}', [CompetitorController::class, 'update']);
Route::delete('/competitor/{id}', [CompetitorController::class, 'destroy']);

// Round routes
Route::get('/rounds', [RoundController::class, 'index']);
Route::get('/round/{id}', [RoundController::class, 'show']);
Route::post('/round', [RoundController::class, 'store']);
Route::put('/round/{id}', [RoundController::class, 'update']);
Route::delete('/round/{id}', [RoundController::class, 'destroy']);

// User routes
Route::get('/users', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);



