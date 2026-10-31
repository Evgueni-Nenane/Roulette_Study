<?php

declare(strict_types=1);

namespace App\Http\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class HealthAction
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $payload = json_encode(
            [
                'status' => 'ok',
                'service' => 'roulette-study-api',
                'time' => gmdate('c'),
            ],
            JSON_THROW_ON_ERROR
        );

        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
