<?php

namespace App\Repositories\Finnhub;

use Finnhub;
use GuzzleHttp;

class APIFinnhubRepository implements FinnhubRepository
{
    /**
     * @throws Finnhub\ApiException
     */
    public function apiQuote(string $searchKey): float
    {
        $config = Finnhub\Configuration::getDefaultConfiguration()->setApiKey('token', $_ENV["API_KEY"]);
        $client = new Finnhub\Api\DefaultApi(
            new GuzzleHttp\Client(),
            $config
        );
        try {
            $data = $client->quote($searchKey);
        } catch (Finnhub\ApiException $exception) {
            throw new Finnhub\ApiException($exception->getMessage());
        }
        return $data["c"];
    }
}