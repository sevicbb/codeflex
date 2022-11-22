<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaxRequest;
use App\Models\Part;
use App\Utils\CsvParser;

class PartController extends Controller
{
    public function index()
    {
        return view('dashboard', ['parts' => $this->fetchParts()]);
    }

    public function updateTax(UpdateTaxRequest $request)
    {
        $data = $request->validated();
        config(['tax.value' => $data['tax']]);

        return view('dashboard', ['parts' => $this->fetchParts()]);
    }

    private function fetchParts()
    {
        $partsArray = CsvParser::csvFileToAssociativeArray(base_path() . '/data/Programming_Test_2_1.csv');

        return Part::hydrate($partsArray);
    }
}
