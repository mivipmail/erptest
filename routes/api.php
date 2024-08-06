<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/parts', [\App\Http\Controllers\PartController::class, 'index']);
Route::patch('/parts/move/{id}', [\App\Http\Controllers\PartController::class, 'move']);
Route::delete('/parts/{id}', [\App\Http\Controllers\PartController::class, 'destroy']);
