# Architecture

## Principles

The codebase is written in object-oriented PHP and follows these rules:

- `declare(strict_types=1)` in every file.
- One class per file; the file name matches the class name.
- Classes are `final` unless they are explicitly designed for extension.
- Value objects are `readonly`; state changes produce new instances.
- Dependencies are injected through constructors. The DI container is only used in the
  composition root.
- No service locator, no global state, no static business logic. Static methods are limited to
  named constructors and factories.
- Boundaries are defined by interfaces owned by the inner layers; implementations live in
  `Infrastructure`.
- Enums replace magic strings for states and types.
- Errors are represented by typed exceptions, not by return codes or `false`.

## Layers

Dependencies point inwards: `Http` → `Application` → `Domain`, with `Infrastructure` implementing
interfaces declared by the inner layers.

| Layer | Namespace | Responsibility | May depend on |
| --- | --- | --- | --- |
| Http | `App\Http` | Slim actions, middleware, request/response mapping | Application, Domain |
| Application | `App\Application` | Use cases, orchestration, transactions | Domain |
| Domain | `App\Domain` | Entities, value objects, repository interfaces, domain services | Nothing |
| Infrastructure | `App\Infrastructure` | PDO repositories, Gemini client, mailer, storage | Domain, Application |
| Support | `App\Support` | Small framework-agnostic utilities | Nothing |

Business rules never live in controllers. SQL never lives outside repositories.

## Composition root

```
public/index.php
  └── ContainerFactory  (builds PHP-DI container)
        └── Kernel      (builds Slim app, middleware, routes)
              └── Routes (maps HTTP verbs and paths to action classes)
```

The front controller only loads the environment, builds the container and runs the kernel.

## Planned structure

```
src/
  Application/     Config, ContainerFactory, Kernel, Routes, use cases
  Domain/          Entities, value objects, repository interfaces
  Http/
    Action/        Invokable controllers
    Middleware/    Cross-cutting HTTP concerns
    Request/       Validated input DTOs
  Infrastructure/  PDO repositories, Gemini client, storage
  Support/         Framework-agnostic helpers
tests/
  Unit/            Domain and application tests
  Integration/     Repository and HTTP tests
```

## Testing

- Unit tests cover domain objects and use cases with hand-written fakes.
- Integration tests cover repositories against PostgreSQL and HTTP actions through the kernel.
- External services (Gemini) are always replaced by test doubles; no network calls in CI.
