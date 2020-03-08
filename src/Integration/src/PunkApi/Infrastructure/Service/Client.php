<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Infrastructure\Service;

use O2O\Integration\Shared\Infrastructure\Service\ApiClient;

final class Client extends ApiClient
{
    const BASE_URI = 'https://api.punkapi.com/v2/beers';

    public function search(string $queries)
    {
        return $this->request('GET', self::BASE_URI . '?food=' . $queries);
    }
}
