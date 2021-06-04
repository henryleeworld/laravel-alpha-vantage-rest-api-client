<?php

namespace App\Http\Controllers;

use App\Services\AlphaVantageService;
use Carbon\Carbon;

class StockMarketController extends Controller
{
    private $alphaVantageService;

    /**
     * Instantiate a new StockMarketController instance.
     *
     * @param AlphaVantageService $alphaVantageService
     *
     * @return Response
     */
    public function __construct(AlphaVantageService $alphaVantageService)
    {
        $this->alphaVantageService = $alphaVantageService;
    }

    /**
     * Get currency exchange rate.
     *
     * @return Response
     */
    public function getCurrencyExchangeRate()
    {
        $currencyExchangeRateAry = $this->alphaVantageService->makeHttpRequest('', [
           'from_currency' => 'USD',
           'function'      => config('alpha-vantage.function.currency_exchange_rate'),
           'to_currency'   => 'TWD',
        ]);
        $rateAry = $currencyExchangeRateAry['Realtime Currency Exchange Rate'];
        $dateTime = Carbon::parse($rateAry['6. Last Refreshed'], $rateAry['7. Time Zone'])->format('Y-m-d H:i:s');
        echo $dateTime . ' ' . '美金換新台幣' . '買入價：' . $rateAry['8. Bid Price'] . PHP_EOL;
        echo $dateTime . ' ' . '美金換新台幣' . '賣出價：' . $rateAry['9. Ask Price'] . PHP_EOL;
    }

    /**
     * Get time series intraday.
     *
     * @return Response
     */
    public function getTimeSeriesIntraday()
    {
        $interval = '60min';
        $timeSeriesIntradayAry = $this->alphaVantageService->makeHttpRequest('', [
           'function' => config('alpha-vantage.function.time_series_intraday'),
           'interval' => $interval,
           'symbol'   => 'IBM'
        ]);
        foreach ($timeSeriesIntradayAry['Time Series (' . $interval . ')'] as $dateTime => $valueAry) {
            $dateTime = Carbon::parse($dateTime)->format('Y-m-d H:i:s');
            echo $dateTime . ' ' . '原始開盤價：' . $valueAry['1. open'] . PHP_EOL;
            echo $dateTime . ' ' . '原始高價：' . $valueAry['2. high'] . PHP_EOL;
            echo $dateTime . ' ' . '原始低價：' . $valueAry['3. low'] . PHP_EOL;
            echo $dateTime . ' ' . '原始收盤價：' . $valueAry['4. close'] . PHP_EOL;
            echo $dateTime . ' ' . '原始交易量：' . $valueAry['5. volume'] . PHP_EOL;
        }
    }
}
