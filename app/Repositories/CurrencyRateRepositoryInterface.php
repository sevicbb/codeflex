<?php

namespace App\Repositories;

interface CurrencyRateRepositoryInterface
{
    public function getCurrencyRate(string $currency = null);
}
