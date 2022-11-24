<?php

namespace App\Services;

use App\Constants\CurrencyConstants;

class CurrencyConversionService extends RequestService
{
    public function __construct()
    {
        $this->baseEndpoint = 'https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/latest/currencies/';

        parent::__construct();
    }

    public function fetchCurrencyRate(string $currency)
    {
        $lowercaseCurrency = strtolower($currency);

        $endpoint = $this->baseEndpoint
            . strtolower(CurrencyConstants::BASE_CURRENCY)
            . '/'
            . $lowercaseCurrency
            . '.json';

        $response = $this->httpClient->request('GET', $endpoint, []);
        $responseBody = json_decode($response->getBody(), true);

        return $responseBody[$lowercaseCurrency];
    }
}
