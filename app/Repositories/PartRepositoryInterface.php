<?php

namespace App\Repositories;

use Illuminate\Database\Query\Builder;

interface PartRepositoryInterface
{
    public function partsBuilder(string $search, int $page, int $pageAmount, string $currency): Builder;
}
