<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Application;

use O2O\Integration\PunkApi\Domain\IRepository;
use O2O\Integration\PunkApi\Domain\ValueObject\QueryCriteria;

final class SearchBeerByFood
{
    private IRepository $repository;

    public function __construct(IRepository $repository)
    {
        $this->repository = $repository;
    }

    public function search(QueryCriteria $criteria)
    {
        return $this->repository->searchBeerByFood($criteria);
    }
}
