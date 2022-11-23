<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaxRequest;
use App\Models\Part;
use App\Models\Setting;

class PartController extends Controller
{
    public function index()
    {
        $parts = Part::paginate(config('pagination.items_per_page'));

        return view('dashboard', ['parts' => $parts]);
    }

    public function updateTax(UpdateTaxRequest $request)
    {
        $data = $request->validated();

        Setting::set('tax.value', $data['tax']);

        return redirect()->route('part.index');
    }
}
