<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Infrastructure\Transformer;

final class BeerCollectionTransformer
{
    public static function transform(array $data): array
    {
        $filterFields = ['id', 'name', 'description'];

        return array_filter($data, function ($key) use ($filterFields) {
            return in_array($key, $filterFields);
        }, ARRAY_FILTER_USE_KEY);
    }
}
