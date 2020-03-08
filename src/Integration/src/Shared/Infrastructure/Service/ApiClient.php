<?php

declare(strict_types=1);

namespace O2O\Integration\Shared\Infrastructure\Service;

use GuzzleHttp\Client;

class ApiClient extends Client
{
    public function request($method, $uri = '', array $options = [])
    {
        return parent::request($method, $uri, $options);
    }
}
