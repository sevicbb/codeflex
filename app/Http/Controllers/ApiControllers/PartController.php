<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\PivotModels\WarehousePart;
use App\Repositories\CurrencyRepositoryInterface;
use App\Repositories\PartRepositoryInterface;
use App\Repositories\SettingRepositoryInterface;
use App\Repositories\WarehousePartRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PartController extends Controller
{
    public function __construct(
        PartRepositoryInterface $partRepository,
        SettingRepositoryInterface $settingRepository,
        CurrencyRepositoryInterface $currencyRepository,
        WarehousePartRepositoryInterface $warehousePartRepository
    ) {
        $this->partRepository = $partRepository;
        $this->settingRepository = $settingRepository;
        $this->currencyRepository = $currencyRepository;
        $this->warehousePartRepository = $warehousePartRepository;
    }

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page' => 'integer',
            'page_amount' => 'integer',
            'search' => 'string',
            'currency' => 'exists:currencies,code'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        $parts = $this->partRepository->partsBuilder(
            $request->query('search'),
            $request->query('page'),
            $request->query('page_amount'),
            $request->query('currency')
        )->get();

        foreach ($parts as $part) {
            $part->inventory = $this->warehousePartRepository->allWhere('part_id', $part->id);
        }

        return $parts;
    }
}
