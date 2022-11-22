<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaxRequest;
use App\Models\Part;

class PartController extends Controller
{
    public function index()
    {
        return view('dashboard', ['parts' => Part::all()]);
    }

    public function updateTax(UpdateTaxRequest $request)
    {
        $data = $request->validated();
        config(['tax.value' => $data['tax']]);

        return view('dashboard', ['parts' => Part::all()]);
    }
}
