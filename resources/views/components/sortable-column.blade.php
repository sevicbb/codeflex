<?php

$sortDirection = request('sort-direction') === 'asc' ? 'desc' : 'asc';

?>

<th class="position-relative">
    <form class="kt-form kt-form--label-right" action="{{ route('part.index') }}" method="get">
        <input type="hidden" name="sort-field" value="{{ $field }}" />
        <input type="hidden" name="sort-direction" value="{{ $sortDirection }}" />
        <button class="c-sortable-column btn btn-link stretched-link" type="submit">
            {{ $label }}
        </button>
    </form>
</th>