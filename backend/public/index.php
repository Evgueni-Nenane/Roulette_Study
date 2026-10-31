<?php

declare(strict_types=1);

use App\Application\ContainerFactory;
use App\Application\Kernel;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

Dotenv::createImmutable(dirname(__DIR__))->safeLoad();

ContainerFactory::create()
    ->get(Kernel::class)
    ->run();
