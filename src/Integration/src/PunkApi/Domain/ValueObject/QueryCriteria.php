<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Domain\ValueObject;

use O2O\Integration\Shared\Domain\ValueObject\ArrayValueObject;

final class QueryCriteria extends ArrayValueObject
{
    public function __construct(string $value)
    {
        $valueWithSpace = str_replace('_', ' ', $value);

        $query = strpos($valueWithSpace, ',') !== false
            ? explode(',', $valueWithSpace)
            : [$valueWithSpace];

        parent::__construct($query);
    }
}
