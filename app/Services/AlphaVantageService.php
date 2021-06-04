<?php

namespace App\Services;

use GuzzleHttp\Client;

/**
 * Alpha vantage service
 *
 * @filesource
 */
class AlphaVantageService
{
    /**
     * @var client
     */
    protected $client;

    /**
     * Instantiate a new AlphaVantageService instance.
     *
     * @param Client $client Client
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get query string.
     *
     * @param array $queryStringAry Query string array
     *
     * @return array query string array
     */
    private function getQueryString(array $queryStringAry = []): array
    {
        return array_merge($queryStringAry, [
            'apikey'  => config('alpha-vantage.api_key'),
        ]);
    }

    /**
     * Make Http Request
     *
     * @param string $endpoint       Endpoint
     * @param array  $queryStringAry Query string array
     *
     * @return mixed
     */
    public function makeHttpRequest(string $endpoint, array $queryStringAry = [])
    {
        $response = $this->client->request('GET', config('alpha-vantage.base_url') . $endpoint, [
            'query' => $this->getQueryString($queryStringAry),
            'curl' => [
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_MAXREDIRS      => 3,
                CURLOPT_POSTREDIR      => 3,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSLVERSION     => CURL_SSLVERSION_TLSv1_2,
            ],
        ]);
        return json_decode((string) $response->getBody(), true);
    }
}
