<?php

namespace App\Repositories;

interface SettingRepositoryInterface
{
    public function get(string $key, $default = null);

    public function set($key, $value);

    public function has($key);
}
