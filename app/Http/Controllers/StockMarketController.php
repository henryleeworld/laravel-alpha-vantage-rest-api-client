<?php

namespace App\Http\Controllers;

use App\Http\Integrations\AlphaVantage\AlphaVantageConnector;
use Carbon\Carbon;

class StockMarketController extends Controller
{
    private $alphaVantageConnector;

    /**
     * Instantiate a new StockMarketController instance.
     *
     * @param AlphaVantageConnector $alphaVantageConnector
     *
     * @return Response
     */
    public function __construct(AlphaVantageConnector $alphaVantageConnector)
    {
        $this->alphaVantageConnector = $alphaVantageConnector;
    }

    /**
     * Get currency exchange rate.
     *
     * @return Response
     */
    public function getCurrencyExchangeRate()
    {
        $currencyExchangeRateAry = $this->alphaVantageConnector->makeHttpRequest('', [
           'from_currency' => 'USD',
           'function'      => config('services.alpha-vantage.function.currency_exchange_rate'),
           'to_currency'   => 'TWD',
        ]);
        $rateAry = $currencyExchangeRateAry['Realtime Currency Exchange Rate'];
        $dateTime = Carbon::parse($rateAry['6. Last Refreshed'], $rateAry['7. Time Zone'])->format('Y-m-d H:i:s');
        echo $dateTime . ' ' . __('US dollars to New Taiwan dollars ') . __('bid price:') . $rateAry['8. Bid Price'] . PHP_EOL;
        echo $dateTime . ' ' . __('US dollars to New Taiwan dollars ') . __('ask price:') . $rateAry['9. Ask Price'] . PHP_EOL;
    }

    /**
     * Get time series intraday.
     *
     * @return Response
     */
    public function getTimeSeriesIntraday()
    {
        $interval = '60min';
        $timeSeriesIntradayAry = $this->alphaVantageConnector->makeHttpRequest('', [
           'function' => config('services.alpha-vantage.function.time_series_intraday'),
           'interval' => $interval,
           'symbol'   => 'IBM'
        ]);
        foreach ($timeSeriesIntradayAry['Time Series (' . $interval . ')'] as $dateTime => $valueAry) {
            $dateTime = Carbon::parse($dateTime)->format('Y-m-d H:i:s');
            echo $dateTime . ' ' . __('Original opening price:') . $valueAry['1. open'] . PHP_EOL;
            echo $dateTime . ' ' . __('Original high price:') . $valueAry['2. high'] . PHP_EOL;
            echo $dateTime . ' ' . __('Original low price:') . $valueAry['3. low'] . PHP_EOL;
            echo $dateTime . ' ' . __('Original closing price:') . $valueAry['4. close'] . PHP_EOL;
            echo $dateTime . ' ' . __('Original trading volume:') . $valueAry['5. volume'] . PHP_EOL;
        }
    }
}
