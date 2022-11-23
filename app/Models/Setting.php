<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get($key, $default = null): mixed
    {
        if (self::has($key)) {
            return self::where('key', $key)->first()->value;
        }

        return $default;
    }

    public static function set($key, $value): mixed
    {
        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        return $value;
    }

    public static function has($key)
    {
        return self::where('key', $key)->exists();
    }
}
