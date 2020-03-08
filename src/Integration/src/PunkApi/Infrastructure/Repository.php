<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Infrastructure;

use O2O\Integration\PunkApi\Domain\IRepository;
use O2O\Integration\PunkApi\Domain\ValueObject\Id;
use O2O\Integration\PunkApi\Domain\ValueObject\QueryCriteria;
use O2O\Integration\PunkApi\Infrastructure\Service\Client;

final class Repository implements IRepository
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param QueryCriteria $criteria
     * @return array
     */
    public function searchBeerByFood(QueryCriteria $criteria): array
    {
        $criteriaStr = str_replace(' ', '_', (string) $criteria);

        $res = $this->client->searchByFood($criteriaStr);

        return json_decode($res->getBody()->getContents(), true);
    }

    /**
     * @param Id $id
     * @return array
     */
    public function beerDetails(Id $id): array
    {
        $res = $this->client->searchById((string) $id);

        return json_decode($res->getBody()->getContents(), true);
    }
}
