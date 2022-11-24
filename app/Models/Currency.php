<?php

namespace App\Models;

use App\Constants\CurrencyConstants;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currencies';

    public static function baseCurrency()
    {
        return self::where('code', CurrencyConstants::BASE_CURRENCY)->first();
    }

    public static function selectedCurrency()
    {
        if (Setting::has('currency.id')) {
            return self::find(Setting::get('currency.id'));
        }

        return self::baseCurrency();
    }
}
