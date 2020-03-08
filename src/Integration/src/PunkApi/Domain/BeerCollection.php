<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Domain;

use O2O\Integration\Shared\Domain\Collection;

final class BeerCollection extends Collection
{
    protected $type = 'O2O\Integration\PunkApi\Domain\Beer';

    public function toArray(): array
    {
        $content = [];

        foreach ($this->items as $item) {
            array_push($content, $item->toArray());
        }

        return $content;
    }
}
