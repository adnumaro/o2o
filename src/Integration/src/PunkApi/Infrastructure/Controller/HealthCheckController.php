<?php

declare(strict_types=1);

namespace O2O\Integration\PunkApi\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class HealthCheckController
{
    public function __invoke(Request $request)
    {
        return new JsonResponse(
            [
                'integration' => 'OK',
            ]
        );
    }
}
