<?php

namespace App\Models;

use App\PivotModels\WarehousePart;
use App\Repositories\CurrencyRateRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Part extends Model
{
    public function getConvertedPriceAttribute()
    {
        $currencyRate = App::make(CurrencyRateRepositoryInterface::class)->getCurrencyRate();

        return $this->price * $currencyRate;
    }

    public function getPriceWithTaxAttribute()
    {
        $tax = 1 + round(Setting::get('tax.value') / 100, 2);

        return $this->convertedPrice * $tax;
    }

    public function getInventoryAttribute()
    {
        return WarehousePart::where(
            [
                'part_id' => $this->id,
                'warehouse_id' => Setting::get('warehouse.id')
            ]
        )->first()->inventory;
    }
}
