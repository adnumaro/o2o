<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Domain;

interface IRepository
{
    public function searchBeerByFood(QueryCriteria $criteria): array;
}
