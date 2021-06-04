<?php

return [
    'api_key'  => env('ALPHA_VANTAGE_API_KEY', 'demo'),
    'base_url' => env('ALPHA_VANTAGE_BASE_URL', 'https://www.alphavantage.co/query'),
    'function' => [
        'currency_exchange_rate' => 'CURRENCY_EXCHANGE_RATE',
        'time_series_intraday'   => 'TIME_SERIES_INTRADAY',
    ],
];