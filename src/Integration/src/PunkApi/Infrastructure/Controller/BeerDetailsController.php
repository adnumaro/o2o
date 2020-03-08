<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Infrastructure\Controller;

use O2O\Integration\PunkApi\Application\BeerDetails;
use O2O\Integration\PunkApi\Domain\ValueObject\Id;
use O2O\Integration\PunkApi\Infrastructure\Repository;
use O2O\Integration\PunkApi\Infrastructure\Service\Client;
use O2O\Integration\PunkApi\Infrastructure\Transformer\DetailsTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class BeerDetailsController
{
    public function __invoke(string $id, Request $request)
    {
        $beerDetails = new BeerDetails(
            new Repository(new Client())
        );

        $response = $beerDetails->details(
            new Id($id)
        );

        return new JsonResponse(
            [
                'response' => DetailsTransformer::transform($response)
            ]
        );
    }
}
