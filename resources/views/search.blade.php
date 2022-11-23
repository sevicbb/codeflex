<div class="container">
    <form class="kt-form kt-form--label-right" action="{{ route('part.index') }}" method="get">
        @method('GET')
        @csrf

        <label for="search-input"> Search </strong> </label>

        <div class="input-group mb-3">
            <input class="form-control" id="search-input" type="text" name="search" placeholder="Search by ID, description or brand...">

            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>
</div>