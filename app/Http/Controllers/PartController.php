<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCurrencyRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Http\Requests\UpdateTaxRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\Models\Part;
use App\Repositories\CurrencyRepositoryInterface;
use App\Repositories\PartRepositoryInterface;
use App\Repositories\SettingRepositoryInterface;
use App\Repositories\WarehousePartRepositoryInterface;
use Illuminate\Http\Request;

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
        $partsBuilder = Part::distinct();

        if ($request->has('search')) {
            $partsBuilder->whereLike(['identifier', 'description', 'brand'], $request->query('search'));
        }

        if ($request->has('sort-field') && $request->has('sort-direction')) {
            $partsBuilder->orderBy($request->query('sort-field'), $request->query('sort-direction'));
        }

        $parts = $partsBuilder
            ->paginate(config('pagination.items_per_page'))
            ->withQueryString();

        return view('dashboard', ['parts' => $parts]);
    }

    public function updateTax(UpdateTaxRequest $request)
    {
        $data = $request->validated();

        $this->settingRepository->set('tax.value', $data['tax']);

        return redirect()->route('part.index');
    }

    public function updateWarehouse(UpdateWarehouseRequest $request)
    {
        $data = $request->validated();

        $this->settingRepository->set('warehouse.id', $data['warehouse']);

        return redirect()->route('part.index');
    }

    public function updateInventory(UpdateInventoryRequest $request)
    {
        $data = $request->all();

        $this->warehousePartRepository->updateWhereConditions(
            [
                'part_id' => $data['part_id'],
                'warehouse_id' => $data['warehouse_id']
            ],
            [
                'inventory' => $data['inventory']
            ]
        );

        return redirect()->route('part.index');
    }

    public function updateCurrency(UpdateCurrencyRequest $request)
    {
        $data = $request->validated();

        $this->settingRepository->set('currency.id', $data['currency']);

        return redirect()->route('part.index');
    }
}
