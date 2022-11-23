<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaxRequest;
use App\Models\Part;
use App\Models\Setting;
use Illuminate\Http\Request;

class PartController extends Controller
{
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

        Setting::set('tax.value', $data['tax']);

        return redirect()->route('part.index');
    }
}
