<?php

namespace App\Services;

use GuzzleHttp\Client;

class RequestService
{
    public function __construct()
    {
        $this->httpClient = new Client();
    }


    public function get(string $endpoint)
    {
        return $this->httpClient->request('GET', $endpoint, []);
    }
}
