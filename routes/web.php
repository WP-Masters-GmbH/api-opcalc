<?php

use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MarketDataController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

#Route::get('/', [PagesController::class, 'index']);

Route::get('/', HomeController::class);

// Market Data
Route::get('/market-data', [MarketDataController::class, 'index']);
