<?php

namespace App\Repositories;

use App\PivotModels\WarehousePart;

class WarehousePartRepository extends Repository implements WarehousePartRepositoryInterface
{
    protected $model = WarehousePart::class;
}
