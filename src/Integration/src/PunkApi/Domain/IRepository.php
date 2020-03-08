<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Domain;

use O2O\Integration\PunkApi\Domain\ValueObject\Id;
use O2O\Integration\PunkApi\Domain\ValueObject\QueryCriteria;

interface IRepository
{
    public function searchBeerByFood(QueryCriteria $criteria): array;

    public function beerDetails(Id $id): array;
}
