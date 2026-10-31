<?php

declare(strict_types=1);

namespace App\Application;

use App\Http\Action\HealthAction;
use Slim\App;

/**
 * Route table. Actions are resolved from the container by class name.
 */
final class Routes
{
    public function __invoke(App $app): void
    {
        $app->get('/api/health', HealthAction::class);
    }
}
