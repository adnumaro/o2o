<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Infrastructure\Controller;

use O2O\Integration\PunkApi\Application\SearchBeerByFood;
use O2O\Integration\PunkApi\Domain\QueryCriteria;
use O2O\Integration\PunkApi\Infrastructure\FoundTransformer;
use O2O\Integration\PunkApi\Infrastructure\Repository;
use O2O\Integration\PunkApi\Infrastructure\Service\Client;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class SearchBeerByFoodController
{
    public function __invoke(Request $request)
    {
        $searchBeerByFood = new SearchBeerByFood(
            new Repository(new Client())
        );

        $response = $searchBeerByFood->search(
            new QueryCriteria($request->query->get('criteria'))
        );

        return new JsonResponse(
            [
                'response' => FoundTransformer::transform($response)
            ]
        );
    }
}
