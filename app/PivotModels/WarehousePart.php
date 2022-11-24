<?php

namespace App\PivotModels;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class WarehousePart extends MorphPivot
{
    protected $table = 'warehouse_part';
}
