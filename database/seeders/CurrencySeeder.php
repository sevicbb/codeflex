<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insertOrIgnore(
            [
                [
                    'id' => 1,
                    'code' => 'EUR',
                    'symbol' => '€',
                    'name' => 'Euro'
                ],
                [
                    'id' => 2,
                    'code' => 'USD',
                    'symbol' => '$',
                    'name' => 'US Dollar',
                ],
                [
                    'id' => 3,
                    'code' => 'AUD',
                    'symbol' => 'AU$',
                    'name' => 'Australian Dollar',
                ],
                [
                    'id' => 4,
                    'code' => 'GBP',
                    'symbol' => '£',
                    'name' => 'British Pound Sterling',
                ],
                [
                    'id' => 5,
                    'code' => 'RSD',
                    'symbol' => 'din.',
                    'name' => 'Serbian Dinar',
                ],
                [
                    'id' => 6,
                    'code' => 'JPY',
                    'symbol' => '¥',
                    'name' => 'Japanese Yen',
                ]
            ]
        );
    }
}
