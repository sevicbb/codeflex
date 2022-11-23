<?php

use App\Models\Setting;

?>


<div class="container">
    <form class="kt-form kt-form--label-right" action="{{ route('part.update_tax') }}" method="post">
        @method('POST')
        @csrf

        <label for="tax-input"> Tax = <strong> {{ Setting::get('tax.value') }} % </strong> </label>

        <div class="input-group mb-3">
            <input class="form-control @error('tax') is-invalid @enderror" id="tax-input" type="text" name="tax" placeholder="Enter new tax...">

            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Update tax</button>
            </div>

            @error('tax')
            <div class="error invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </form>
</div>