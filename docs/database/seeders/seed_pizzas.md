# database/seeders/seed_pizzas.php

Real file: [`database/seeders/seed_pizzas.php`](../../../database/seeders/seed_pizzas.php)

## Responsibility

Standalone script (not a class, not called by any HTTP entrypoint) that populates the `pizzas` table with 40 sample records, to ease local development/demoing.

## Behavior

1. Includes [`config/database.php`](../config/database.md)
2. Declares a PHP array with 40 pizzas (fixed `id`, `title`, `ingredients`, `email`, `created_at`)
3. Opens a connection via `DatabaseConfig::connect()`
4. For each pizza in the array, builds and runs an `INSERT IGNORE INTO pizzas (id, title, ingredients, email, created_at) VALUES (...)` directly with `mysqli_query()`
5. Closes the connection via `DatabaseConfig::disconnect()`
6. Prints `"Pizzas seeded successfully!\n"`

## Notes

- **Idempotent**: uses `INSERT IGNORE` with a fixed `id` per record — running the script multiple times doesn't duplicate rows (subsequent runs simply skip inserts that collide with existing PKs).
- **No escaping**: unlike [`PizzaRepository`](../repository/pizza_repository.md), this script interpolates values directly into the SQL string with no `mysqli_real_escape_string()` or prepared statements — acceptable here because the data is fixed constants in the source code, not external input.
- Run manually (e.g. `php database/seeders/seed_pizzas.php` inside the `app` container), not part of the application's normal request flow.

## Dependencies

- [DatabaseConfig](../config/database.md)
