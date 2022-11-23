<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    public function getPriceWithTaxAttribute()
    {
        $taxAmount = $this->price * Setting::get('tax.value') / 100;

        return $this->price + round($taxAmount, 2);
    }
}
