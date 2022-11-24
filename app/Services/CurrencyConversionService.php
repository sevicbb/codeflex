<?php

namespace App\Services;

use App\Constants\CurrencyConstants;
use App\Models\Currency;
use App\Models\CurrencyRate;

class CurrencyConversionService extends RequestService
{
    public function __construct()
    {
        $this->endpoint = 'https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/latest/currencies/';

        parent::__construct();
    }

    public function fetchCurrencyRate(string $currency)
    {
        $preparedEndpoint = $this->endpoint
            . strtolower(CurrencyConstants::BASE_CURRENCY)
            . '/'
            . strtolower($currency)
            . '.json';

        $response = $this->httpClient->request('GET', $preparedEndpoint, []);

        $result = json_decode($response->getBody(), true);

        return $result[strtolower($currency)];
    }

    public function getCurrencyRate()
    {
        $currencyRate = CurrencyRate::where(
            'to_currency',
            Currency::selectedCurrency()->code
        )->first();

        if (is_null($currencyRate)) {
            return 1;
        }

        return $currencyRate->rate;
    }
}
