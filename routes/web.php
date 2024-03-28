<?php

use App\Http\Controllers\StockMarketController;
use Illuminate\Support\Facades\Route;

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
Route::get('alpha_vantage/time_series_intraday/', [StockMarketController::class, 'getTimeSeriesIntraday']);
Route::get('alpha_vantage/currency_exchange_rate/', [StockMarketController::class, 'getCurrencyExchangeRate']);
