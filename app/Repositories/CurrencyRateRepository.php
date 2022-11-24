<?php

namespace App\Repositories;

use App\Models\CurrencyRate;

class CurrencyRateRepository extends Repository implements CurrencyRateRepositoryInterface
{
    protected $model = CurrencyRate::class;

    public function __construct(
        CurrencyRepositoryInterface $currencyRepository
    ) {
        $this->currencyRepository = $currencyRepository;
    }

    public function getCurrencyRate(string $currency = null)
    {
        $selectedCurrency = $currency ?? $this->currencyRepository->getSelectedCurrency()->code;

        $currencyRate = $this->findBy('to_currency', $selectedCurrency);

        if (is_null($currencyRate)) {
            return 1;
        }

        return $currencyRate->rate;
    }
}
