<?php

use App\Models\Warehouse;
use App\Models\Setting;

$warehouses = Warehouse::all();

function computeSelectedProperty($warehouseId)
{
    echo Setting::get('warehouse.id') == $warehouseId ? 'selected' : null;
}

?>


<div class="container">
    <form class="kt-form kt-form--label-right" action="{{ route('part.update_warehouse') }}" method="post">
        @method('POST')
        @csrf
        <label for="warehouse-select">Warehouse</label>

        <div class="input-group mb-3">
            <select class="custom-select" id="warehouse-select" name="warehouse" onchange="this.form.submit()">
                <option selected>Choose warehouse...</option>
                @foreach ($warehouses as $warehouse)
                <option value="{{ $warehouse->id }}" <?php computeSelectedProperty($warehouse->id) ?>>{{ $warehouse->name }}</option>
                @endforeach
            </select>

            @error('warehouse')
            <div class=" error invalid-feedback">{{ $message }}
            </div>
            @enderror
        </div>
    </form>
</div>