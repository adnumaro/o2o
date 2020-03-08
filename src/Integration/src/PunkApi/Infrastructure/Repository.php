<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Infrastructure;

use O2O\Integration\PunkApi\Domain\IRepository;
use O2O\Integration\PunkApi\Domain\QueryCriteria;
use O2O\Integration\PunkApi\Infrastructure\Service\Client;

final class Repository implements IRepository
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function searchBeerByFood(QueryCriteria $criteria): array
    {
        $criteriaStr = str_replace(' ', '_', (string) $criteria);

        $res = $this->client->search($criteriaStr);

        return json_decode($res->getBody()->getContents(), true);
    }
}
