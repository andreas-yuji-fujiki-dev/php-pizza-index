# repository/pizza_repository.php

Real file: [`repository/pizza_repository.php`](../../repository/pizza_repository.php)

## Responsibility

Data access layer. The only class in the project that talks directly to MySQL via the `mysqli` extension. Converts database rows into [`PizzaModel`](../models/pizza_model.md) instances and back.

## Class: `PizzaRepository`

### Properties

| Property | Type | Description |
|---|---|---|
| `databaseConfig` (private) | `DatabaseConfig` | Used to open/close connections in every public method. |

### Methods

| Method | Returns | Responsibility |
|---|---|---|
| `__construct()` | — | Instantiates `DatabaseConfig`. |
| `executeQuery(mysqli $dbConnection, string $query)` (private) | `array\|mysqli_result\|bool` | Runs a raw query. If the connection is invalid, returns `['error'=>true, 'error_details'=>...]` with `mysqli_connect_error()`'s message. If the query fails, returns the same error shape with `mysqli_error()`. On success, returns the raw `mysqli_query()` result. |
| `queryAll()` | `PizzaModel[]\|false` | `SELECT * FROM pizzas`. Maps each row into a new `PizzaModel` (assigning property by property via a dynamic loop `$newPizza->$key = $value`). Opens and closes its own connection. |
| `queryById(int $id)` | `PizzaModel\|false` | `SELECT * FROM pizzas WHERE id = $id`. Returns `false` if not found or on error. Opens and closes its own connection. |
| `queryInsert(PizzaModel $newPizzaData)` | `bool` | Escapes `email`, `title`, `ingredients` with `mysqli_real_escape_string()` and runs `INSERT INTO pizzas (...)`. |
| `queryUpdate(PizzaModel $pizza)` | `bool` | Casts `id` to `int` and escapes the remaining fields; runs `UPDATE pizzas SET ... WHERE id = $id`. |
| `queryDelete(int $id)` | `bool` | First calls `queryById($id)` to confirm the pizza exists (returns `false` early if not); then runs `DELETE FROM pizzas WHERE id = $id`. |

## Notes

- **Connection lifecycle**: every public method opens its own connection via `DatabaseConfig::connect()` and closes it at the end — there is no connection shared across calls.
- **SQL interpolation in `queryById` and `queryDelete`**: `$id` is inserted directly into the query string (`"... WHERE id = $id"`) with no explicit escaping. Protection against SQL injection in these two methods relies entirely on PHP's `int $id` type hint forcing the conversion before the call — if that type hint were relaxed or removed, there would be no protection left. `queryInsert` and `queryUpdate`, by contrast, explicitly escape every string field with `mysqli_real_escape_string()`.
- No prepared statements are used anywhere — all queries are built via string concatenation/interpolation.

## Dependencies

- [PizzaModel](../models/pizza_model.md)
- [DatabaseConfig](../config/database.md)

## Used by

- [PizzaService](../services/pizza_service.md)
