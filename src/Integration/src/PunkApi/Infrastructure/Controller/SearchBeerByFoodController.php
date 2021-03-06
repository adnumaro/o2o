<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Infrastructure\Controller;

use O2O\Integration\PunkApi\Application\SearchBeerByFood;
use O2O\Integration\PunkApi\Infrastructure\Repository;
use O2O\Integration\PunkApi\Infrastructure\Service\Client;
use O2O\Integration\PunkApi\Infrastructure\Transformer\BeerCollectionTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class SearchBeerByFoodController
{
    public function __invoke(Request $request)
    {
        $searchBeerByFood = new SearchBeerByFood(new Repository(new Client()));

        $criteria = $request->query->get('criteria') ?? '';

        $response = null;
        if ($criteria) {
            $response = $searchBeerByFood->search($criteria);
        }

        return new JsonResponse(
            [
                'response' => $response
                    ? BeerCollectionTransformer::transform($response->toArray())
                    : null
            ]
        );
    }
}
