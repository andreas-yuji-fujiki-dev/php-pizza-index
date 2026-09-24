# env_variables.php

Real file: [`env_variables.php`](../../env_variables.php)

## Responsibility

Configuration bootstrap file (not a class). Reads environment variables from the PHP process and defines global constants used by the database connection layer.

## Behavior

For each variable, uses `getenv()` and falls back to a local-development default when not set:

| Constant | Env var | Default (fallback) |
|---|---|---|
| `DB_HOST` | `DB_HOST` | `127.0.0.1` |
| `DB_USER` | `DB_USER` | `root` |
| `DB_PASSWORD` | `DB_PASSWORD` | `''` (empty) |
| `DB_NAME` | `DB_NAME` | `pizza_index` |

## Notes

- Listed in [`.gitignore`](../../.gitignore), i.e. **not version-controlled** — each environment (local, Docker, production) needs its own copy with the correct credentials, or must rely entirely on the process's environment variables.
- In `compose.yaml`, the `app` service receives `DB_HOST`, `DB_USER`, `DB_PASSWORD`, `DB_NAME` as container environment variables, which this file reads via `getenv()`.

## Used by

- [config/database.php](database.md)
