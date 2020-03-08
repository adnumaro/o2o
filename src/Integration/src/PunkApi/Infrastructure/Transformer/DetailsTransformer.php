<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Infrastructure\Transformer;

final class DetailsTransformer
{
    public static function transform(array $data): array
    {
        $dataTransformer = [];

        foreach ($data as $element) {
            array_push($dataTransformer, [
                'id' => $element['id'],
                'name' => $element['name'],
                'description' => $element['description'],
                'image' => '',
                'slogan' => $element['tagline'],
                'created_at' => $element['first_brewed']
            ]);
        }

        return $dataTransformer;
    }
}