<?php

namespace App\Repositories;

use App\Constants\CurrencyConstants;
use App\Models\Currency;

class CurrencyRepository extends Repository implements CurrencyRepositoryInterface
{
    protected $model = Currency::class;

    public function __construct(
        SettingRepositoryInterface $settingRepository
    ) {
        $this->settingRepository = $settingRepository;
    }

    public function getBaseCurrency()
    {
        return $this->findBy('code', CurrencyConstants::BASE_CURRENCY);
    }

    public function getSelectedCurrency()
    {
        if ($this->settingRepository->has('currency.id')) {
            return $this->find($this->settingRepository->get('currency.id'));
        }

        return $this->getBaseCurrency();
    }
}
