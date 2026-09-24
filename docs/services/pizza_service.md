# services/pizza_service.php

Real file: [`services/pizza_service.php`](../../services/pizza_service.php)

## Responsibility

Business rule layer between the `Controller` and the `PizzaRepository`. For write operations (create/update), validates data before delegating to the repository; for reads and delete, it just passes the call through.

## Class: `PizzaService`

### Properties

| Property | Type | Description |
|---|---|---|
| `pizzaRepository` (private) | `PizzaRepository` | Used for every database operation. |
| `validate` (private) | `Validate` | Used to validate fields before creating/updating. |

### Methods

| Method | Returns | Responsibility |
|---|---|---|
| `__construct()` | — | Instantiates `PizzaRepository` and `Validate`. |
| `getAllPizzas()` | `PizzaModel[]\|false` | Passes straight through to `PizzaRepository::queryAll()`, no extra logic. |
| `getPizzaById(int $id)` | `PizzaModel\|false` | Passes straight through to `PizzaRepository::queryById()`, no extra logic. |
| `registerNewPizza(PizzaModel $newPizzaData)` | `bool\|array` | Runs `Validate::allFormFields()`; if there are errors, returns the per-field error array. Otherwise delegates to `PizzaRepository::queryInsert()` and returns the repository's `bool`. |
| `updatePizza(PizzaModel $pizzaData)` | `bool\|array` | Same pattern as `registerNewPizza`: validates first, returns the error array if any, otherwise delegates to `PizzaRepository::queryUpdate()`. |
| `deletePizza(int $id)` | `bool` | Passes straight through to `PizzaRepository::queryDelete()`. |

## Notes

- The docblocks on `registerNewPizza`/`updatePizza` in the code say `@return true|array`, but in practice the success value is whatever `bool` the repository returns (which can be `false` on a database failure) — callers should treat "success" as "not an error array", not as "is strictly `true`".
- The `Controller` is what interprets the difference between an error array (`is_array($response) && !empty(array_filter($response))`) and success.

## Dependencies

- [PizzaModel](../models/pizza_model.md)
- [PizzaRepository](../repository/pizza_repository.md)
- [Validate](../utils/validate.md)

## Used by

- [Controller](../controllers/pizza_controller.md)
