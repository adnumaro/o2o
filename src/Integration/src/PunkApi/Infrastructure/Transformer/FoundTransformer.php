<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Infrastructure\Transformer;

final class FoundTransformer
{
    public static function transform(array $data): array
    {
        $dataTransformer = [];

        foreach ($data as $element) {
            array_push($dataTransformer, [
                'id' => $element['id'],
                'name' => $element['name'],
                'description' => $element['description']
            ]);
        }

        return $dataTransformer;
    }
}
