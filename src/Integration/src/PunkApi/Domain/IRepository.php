<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Domain;

use O2O\Integration\PunkApi\Domain\ValueObject\Id;

interface IRepository
{
    public function searchBeerByFood(string $criteria): BeerCollection;

    public function beerDetails(Id $id): Beer;
}
