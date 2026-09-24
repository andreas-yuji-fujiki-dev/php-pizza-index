# config/database.php

Real file: [`config/database.php`](../../config/database.php)

## Responsibility

Wraps opening and closing `mysqli` database connections, using the credentials defined in [env_variables.php](env_variables.md).

## Class: `DatabaseConfig`

No own properties. Requires `env_variables.php` at the top of the file (which defines the `DB_HOST`, `DB_USER`, `DB_PASSWORD`, `DB_NAME` constants).

### Methods

| Method | Returns | Responsibility |
|---|---|---|
| `connect()` | `mysqli` | Opens and returns a new database connection via `mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)`. |
| `disconnect(mysqli $connection)` | `bool` | Closes the given connection via `mysqli_close()`. |

## Notes

- No pooling or shared/persistent connection: every `PizzaRepository` method that needs the database calls its own `connect()` and `disconnect()` (see [repository/pizza_repository.md](../repository/pizza_repository.md)).
- Does not handle connection failure itself — the caller of `connect()` is responsible for checking whether the connection is valid (which is exactly what `PizzaRepository::executeQuery()` does).

## Dependencies

- [env_variables.php](env_variables.md)

## Used by

- [PizzaRepository](../repository/pizza_repository.md)
- [database/seeders/seed_pizzas.php](../database/seeders/seed_pizzas.md)
