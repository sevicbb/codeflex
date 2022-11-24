<?php

namespace App\Models;

use App\PivotModels\WarehousePart;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    public function getPriceWithTaxAttribute()
    {
        $taxAmount = $this->price * Setting::get('tax.value') / 100;

        return $this->price + round($taxAmount, 2);
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
