<?php

declare(strict_types=1);

namespace App\Application;

/**
 * Immutable application configuration, read once at boot.
 */
final readonly class Config
{
    public function __construct(
        public string $environment,
        public bool $debug,
        public string $url,
    ) {
    }

    public static function fromEnvironment(): self
    {
        return new self(
            environment: self::read('APP_ENV') ?? 'production',
            debug: filter_var(self::read('APP_DEBUG') ?? false, FILTER_VALIDATE_BOOL),
            url: self::read('APP_URL') ?? 'http://localhost',
        );
    }

    private static function read(string $key): ?string
    {
        $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);

        return is_string($value) && $value !== '' ? $value : null;
    }
}
