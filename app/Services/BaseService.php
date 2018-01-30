<?php

namespace App\Services;

use GuzzleHttp\Client;
use Log;

class BaseService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['verify' => false]);
    }
}
