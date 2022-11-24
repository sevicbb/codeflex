<?php

namespace Database\Seeders;

use App\Models\Part;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehousePartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Warehouse::all() as $warehouse) {
            $warehouse->parts()->attach(Part::all());
        }
    }
}
