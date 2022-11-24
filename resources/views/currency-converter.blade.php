<?php

use App\Models\Currency;
use App\Models\Setting;

$currencies = Currency::all();

function computeSelectedCurrencyProperty($currencyId)
{
    echo Setting::get('currency.id') == $currencyId ? 'selected' : null;
}

?>

<div class="container">
    <form class="kt-form kt-form--label-right" action="{{ route('part.update_currency') }}" method="post">
        @method('POST')
        @csrf
        <label for="warehouse-select">Currency conversion</label>

        <div class="input-group mb-3">
            <select class="custom-select" id="currency-select" name="currency" onchange="this.form.submit()">
                <option selected>Choose currency...</option>
                @foreach ($currencies as $currency)
                <option value="{{ $currency->id }}" <?php computeSelectedCurrencyProperty($currency->id) ?>>{{ $currency->name }}</option>
                @endforeach
            </select>

            @error('currency')
            <div class=" error invalid-feedback">{{ $message }}
            </div>
            @enderror
        </div>
    </form>
</div>