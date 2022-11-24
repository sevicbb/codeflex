<?php

namespace App\Models;

use App\PivotModels\WarehousePart;
use App\Services\CurrencyConversionService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Part extends Model
{
    public function getCalculatedPriceAttribute()
    {
        $currencyRate = App::make(CurrencyConversionService::class)->getCurrencyRate();

        return $this->price * $currencyRate;
    }

    public function getPriceWithTaxAttribute()
    {
        $taxAmount = $this->calculatedPrice * Setting::get('tax.value') / 100;

        return $this->calculatedPrice + round($taxAmount, 2);
    }

    public function getInventoryAttribute()
    {
        if (!Setting::has('warehouse.id')) {
            return null;
        }

        return WarehousePart::where(
            [
                'part_id' => $this->id,
                'warehouse_id' => Setting::get('warehouse.id')
            ]
        )->first()->inventory;
    }
}
