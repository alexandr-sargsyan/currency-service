<?php

use App\Http\Controllers\GetCurrentExchangeRatesByCharCodeController;
use App\Http\Controllers\GetCurrentExchangeRatesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetAllCurrentExchangeRatesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/currency', GetAllCurrentExchangeRatesController::class);
Route::get('/currency/{currency_code}',GetCurrentExchangeRatesController::class);
