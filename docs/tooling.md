# Local tooling

Tools required to develop this project, and how they are installed on the reference machine.

## Required

| Tool | Version tested | Purpose |
| --- | --- | --- |
| PHP (host) | 8.5.11 | Composer and syntax checks only |
| Composer | 2.11.1 | PHP dependency manager |
| Podman | 5.8.9 | Rootless container engine (Docker-compatible CLI) |
| podman-compose | 1.6.0 | Reads `docker-compose.yml` and runs the stack |
| Node.js | 22.x | Frontend toolchain (Vite, TypeScript, Vitest) |
| npm | 10.x | Frontend dependencies |
| ffmpeg | system | Audio normalisation before transcription |
| make | system | Task shortcuts |

PostgreSQL client tools are optional; the database runs in a container during development.

## Host PHP caveat

The host PHP build does **not** include `pdo_pgsql`, `mbstring` or `intl`, and there is no `sudo`
access to install them. The backend therefore always runs inside a container. The host PHP is used
only for Composer and quick syntax checks.

## Installed at user level

```bash
# Composer
~/.local/bin/composer

# podman-compose
pip3 install --user podman-compose
```

No `sudo` is required for either.

## Podman socket

The rootless Podman API socket is enabled so that `podman compose` works:

```bash
systemctl --user enable --now podman.socket
```

## Verification

```bash
composer --version
podman --version
podman compose version
podman run --rm docker.io/library/alpine:3.20 echo ok
node --version && npm --version
```

All commands must succeed before starting the stack.
