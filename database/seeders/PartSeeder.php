<?php

namespace Database\Seeders;

use App\Utils\CsvParser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = CsvParser::csvFileToAssociativeArray(base_path() . '/data/Programming_Test_2_1.csv');

        foreach ($data as $item) {
            DB::table('parts')->insertOrIgnore(
                [
                    'identifier' => $item['id'],
                    'description' => $item['description'],
                    'brand' => $item['brand'],
                    'color' => $item['color'],
                    'price' => $item['price']
                ]
            );
        }
    }
}
