<?php

declare(strict_types=1);

namespace App\Application;

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

/**
 * Composition root of the HTTP application.
 *
 * Wires the Slim application to the DI container, registers middleware and
 * routes, and exposes a single entry point for the front controller.
 */
final class Kernel
{
    public function __construct(
        private readonly ContainerInterface $container,
        private readonly Config $config,
        private readonly Routes $routes,
    ) {
    }

    public function app(): App
    {
        AppFactory::setContainer($this->container);
        $app = AppFactory::create();

        $app->addRoutingMiddleware();
        $app->addBodyParsingMiddleware();
        $app->addErrorMiddleware($this->config->debug, true, true);

        ($this->routes)($app);

        return $app;
    }

    public function run(): void
    {
        $this->app()->run();
    }
}
