<?php

use App\Http\Controllers\StockMarketController;
use Illuminate\Support\Facades\Route;

Route::get('alpha_vantage/time_series_intraday/', [StockMarketController::class, 'getTimeSeriesIntraday']);
Route::get('alpha_vantage/currency_exchange_rate/', [StockMarketController::class, 'getCurrencyExchangeRate']);
