<?php

namespace App\Models;

use App\PivotModels\WarehousePart;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public function parts()
    {
        return $this->belongsToMany(
            Part::class,
            'warehouse_part',
            'warehouse_id',
            'part_id'
        )
            ->using(WarehousePart::class)
            ->withPivot(['inventory']);
    }
}
