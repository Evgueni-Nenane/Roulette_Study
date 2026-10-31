# Roulette Study

A timed study challenge platform. Spin a wheel, land on an AI-generated topic, study it against
the clock, answer by text or voice, and get your explanation graded by AI.

Inspired by the daily-challenge format of CSS Battle: everyone faces the same topic, gets one
attempt, and competes on a global leaderboard.

## Status

Early development. The repository currently contains only the project scaffolding.

## Stack

| Layer | Technology |
| --- | --- |
| Backend | PHP 8.3, Slim 4, PDO |
| Database | PostgreSQL (Neon) |
| Frontend | React, TypeScript, Vite, Tailwind CSS |
| AI | Google Gemini (topic generation, transcription, grading) |
| Infra | Docker-compatible containers (Podman locally), Render |
| CI/CD | GitHub Actions |

## Repository layout

```
backend/    PHP API (Slim 4, PDO)
frontend/   React single-page app
docs/       Project documentation
```

## Product modes

- **Daily Challenge** — a rotating category and a single topic per day, fixed timer, one attempt,
  global leaderboard.
- **Practice** — pick a category, let the AI generate the topics on the wheel, spin and answer.
  Counts towards XP, streaks and stats, but not towards the daily ranking.

## Commit convention

This repository follows [Conventional Commits](https://www.conventionalcommits.org/):

```
feat(scope): ...
fix(scope): ...
chore(scope): ...
docs(scope): ...
test(scope): ...
refactor(scope): ...
```

Commits are kept small and focused on a single concern.

## License

MIT. See [LICENSE](LICENSE).
