<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Utils\CsvParser;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partsArray = CsvParser::csvFileToAssociativeArray(base_path() . '/data/Programming_Test_2_1.csv');
        $parts = Part::hydrate($partsArray);

        return view('dashboard', ['parts' => $parts]);
    }
}
