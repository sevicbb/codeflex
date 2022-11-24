<?php

namespace App\Repositories;

interface CurrencyRepositoryInterface
{
    public function getBaseCurrency();

    public function getSelectedCurrency();
}
