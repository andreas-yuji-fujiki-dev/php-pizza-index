# utils/validate.php

Real file: [`utils/validate.php`](../../utils/validate.php)

## Responsibility

Validation rules for a pizza's fields (used both on creation and on editing). Each individual validation returns `null` when the value is valid, or an error message (`string`) when it isn't.

## Class: `Validate`

No properties. Depends on [`PizzaModel`](../models/pizza_model.md) only as the parameter type of the aggregator method.

### Methods

| Method | Returns | Responsibility |
|---|---|---|
| `userEmail(string $email)` | `?string` | Validates email format with `filter_var(..., FILTER_VALIDATE_EMAIL)`. |
| `pizzaTitle(string $title)` | `?string` | Accepts only letters (upper/lowercase) and spaces, via the regex `/^[a-zA-Z\s]+$/`. |
| `pizzaIngredients(string $ingredients)` | `?string` | Validates that the string is a comma-separated list where each item contains only letters and spaces (regex `/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/`) **and** that there are at least 3 comma-separated items. |
| `allFormFields(PizzaModel $pizzaData)` | `?array` | Runs the three validations above against a `PizzaModel` and aggregates the result into `['email' => '', 'title' => '', 'ingredients' => '']`, filling each key with its error message (or an empty string if valid). Returns `null` if no field has an error, or the full array if at least one does. |

## Notes

- `pizzaIngredients` doesn't check numbers or special characters in isolation — the regex already rejects any character outside letters/spaces/commas, so digits and symbols are covered by the same pattern.
- The "at least 3 ingredients" check is done by counting the elements of `explode(',', $ingredients)`, so a string like `"a,,"` counts as 3 elements even with empty items — the format regex is what catches that case (empty items between commas pass the regex since `[a-zA-Z\s]*` accepts zero or more characters).

## Used by

- [PizzaService](../services/pizza_service.md) — called in `registerNewPizza()` and `updatePizza()` before any database write
