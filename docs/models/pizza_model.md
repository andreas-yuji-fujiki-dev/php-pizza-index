# models/pizza_model.php

Real file: [`models/pizza_model.php`](../../models/pizza_model.php)

## Responsibility

Data object (DTO) representing a pizza. No behavior — just public typed properties. It's the shared data structure across every layer: filled from database rows by the repository, from form data by the controller, and read directly by the views.

## Class: `PizzaModel`

No methods. Only public properties:

| Property | Type | Description |
|---|---|---|
| `id` | `int` | Pizza identifier (primary key). |
| `title` | `string` | Pizza name. |
| `ingredients` | `string` | Comma-separated ingredients list (e.g. `"Tomato sauce, mozzarella, basil"`). |
| `email` | `string` | Email of whoever registered the pizza. |
| `created_at` | `string` | Creation timestamp, in the format returned by MySQL (`Y-m-d H:i:s`). |

## Notes

- Properties have no default value and are not initialized in a constructor: a freshly created `PizzaModel` (`new PizzaModel()`) has typed but "empty" properties until they're manually assigned — accessing one before assignment throws a "typed property must not be accessed before initialization" error.

## Used by

- [PizzaRepository](../repository/pizza_repository.md) — builds instances from database rows
- [PizzaService](../services/pizza_service.md) — receives and returns instances
- [Validate](../utils/validate.md) — receives an instance to validate its fields
- [Controller](../controllers/pizza_controller.md) — builds instances from `$_POST`
- [views/index.php](../views/index.md), [views/details.php](../views/details.md) — read properties to render
- [database/seeders/seed_pizzas.php](../database/seeders/seed_pizzas.md) — sample data follows this same shape
