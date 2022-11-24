<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('warehouses')->insertOrIgnore(
            [
                [
                    'id' => 1,
                    'name' => 'Novi Sad'
                ],
                [
                    'id' => 2,
                    'name' => 'Netherlands'
                ],
            ]
        );
    }
}
