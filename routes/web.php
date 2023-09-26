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
Route::match(['post', 'put'], '/competitionAdd', [CompetitionController::class, 'create']);
Route::delete('/competitionDel', [CompetitionController::class, 'destroy']);


// Round routes
Route::get('/rounds', [RoundController::class, 'index']);
Route::match(['post', 'put'], '/roundAdd', [RoundController::class, 'create']);
Route::delete('/roundDel', [RoundController::class, 'destroy']);

// Competitor routes
Route::get('/competitors', [CompetitorController::class, 'index']);
Route::match(['post', 'put'], '/competitorAdd', [CompetitorController::class, 'create']);
Route::delete('/competitorDel', [CompetitorController::class, 'destroy']);

// User routes
Route::get('/users', [UserController::class, 'index']);



