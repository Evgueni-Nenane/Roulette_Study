<?php

declare(strict_types=1);

namespace App\Application;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

/**
 * Builds the dependency injection container.
 *
 * This is the only place where the container is configured. Application code
 * receives its dependencies through constructors.
 */
final class ContainerFactory
{
    public static function create(): ContainerInterface
    {
        $builder = new ContainerBuilder();
        $builder->useAutowiring(true);
        $builder->addDefinitions([
            Config::class => static fn (): Config => Config::fromEnvironment(),
        ]);

        return $builder->build();
    }
}
