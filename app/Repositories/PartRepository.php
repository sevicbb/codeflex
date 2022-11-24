<?php

namespace App\Repositories;

use App\Models\Part;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class PartRepository extends Repository implements PartRepositoryInterface
{
    protected $model = Part::class;

    public function __construct(
        SettingRepositoryInterface $settingRepository,
        CurrencyRateRepositoryInterface $currencyRateRepository
    ) {

        $this->settingRepository = $settingRepository;
        $this->currencyRateRepository = $currencyRateRepository;
    }

    public function partsBuilder(?string $search, ?int $page, ?int $pageAmount, ?string $currency): Builder
    {
        $tax = 1 + round($this->settingRepository->get('tax.value') / 100, 2);
        $currencyRate = $this->currencyRateRepository->getCurrencyRate($currency);

        $builder = DB::table('parts')
            ->select(
                'parts.id AS id',
                'parts.identifier AS identifier',
                'parts.description AS description',
                'parts.brand AS brand',
                'parts.color AS color',
                'parts.price AS base_price'
            )
            ->selectRaw('price * ? as price_with_tax', [$tax])
            ->selectRaw('price * ? as converted_price', [$currencyRate]);

        if (!is_null($search)) {
            $builder->whereLike(['identifier', 'description', 'brand'], $search);
        }

        if (!is_null($page) && !is_null($pageAmount)) {
            $builder->paginate($pageAmount, ['*'], 'page', $page);
        }

        return $builder;
    }
}
