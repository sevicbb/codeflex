<?php

use App\Models\Setting;

?>

@if (Setting::has('warehouse.id'))
<form class="kt-form kt-form--label-right" action="{{ route('part.update_inventory') }}" method="post">
    @method('POST')
    @csrf

    <div class="input-group">
        <input type="text" name="inventory" class="form-control {{ $part->inventory === 0 ? 'c-zero-inventory' : ''}}" value="{{ $part->inventory }}">
        <input type="hidden" name="part_id" value="{{ $part->id }}">
        <input type="hidden" name="warehouse_id" value="{{ Setting::get('warehouse.id') }}">

        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Update</button>
        </div>
    </div>
</form>
@endif