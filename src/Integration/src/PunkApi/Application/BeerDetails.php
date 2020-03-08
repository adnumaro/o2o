<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Application;

use O2O\Integration\PunkApi\Domain\IRepository;
use O2O\Integration\PunkApi\Domain\ValueObject\Id;

final class BeerDetails
{
    private IRepository $repository;

    public function __construct(IRepository $repository)
    {
        $this->repository = $repository;
    }

    public function details(Id $id)
    {
        return $this->repository->beerDetails($id);
    }
}
