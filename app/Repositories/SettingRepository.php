<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingRepository extends Repository implements SettingRepositoryInterface
{
    protected $model = Setting::class;

    public function get(string $key, $default = null)
    {
        return $this->findBy('key', $key)->value ?? $default;
    }

    public function set($key, $value)
    {
        return $this->updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public function has($key)
    {
        return $this->existsBy('key', $key);
    }
}
