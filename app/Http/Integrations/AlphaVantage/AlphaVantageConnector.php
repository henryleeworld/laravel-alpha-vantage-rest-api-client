<?php

namespace App\Http\Integrations\AlphaVantage;

use GuzzleHttp\Client;

/**
 * Alpha vantage connector
 *
 * @filesource
 */
final readonly class AlphaVantageConnector
{
    /**
     * @var client
     */
    private Client $client;

    /**
     * Instantiate a new AlphaVantageConnector instance.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get query string.
     */
    private function getQueryString(array $queryStringAry = []): array
    {
        return array_merge($queryStringAry, [
            'apikey'  => config('services.alpha-vantage.api_key'),
        ]);
    }

    /**
     * Make Http Request
     */
    public function makeHttpRequest(string $endpoint, array $queryStringAry = [])
    {
        $response = $this->client->request('GET', config('services.alpha-vantage.base_url') . $endpoint, [
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
