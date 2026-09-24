# controllers/pizza_controller.php

Real file: [`controllers/pizza_controller.php`](../../controllers/pizza_controller.php)

## Responsibility

HTTP layer. Reads `$_GET`/`$_POST`, orchestrates calls to [`PizzaService`](../services/pizza_service.md), prepares the variables each view expects, and includes (`require`) the matching template. One method per page/route; instantiated once per [entrypoint](../entrypoints/).

## Class: `Controller`

### Properties

| Property | Type | Description |
|---|---|---|
| `pizzaService` (public) | `PizzaService` | Used by every page method. |

### Methods

| Method | Returns | Responsibility |
|---|---|---|
| `__construct()` | — | Instantiates `PizzaService`. |
| `indexPage()` | `void` | Fetches all pizzas (`PizzaService::getAllPizzas()`) and includes [`views/index.php`](../views/index.md) with `$pizzasList`. |
| `addPage()` | `void` | Handles GET (empty form) and POST (`$_POST['submit']`). On POST: builds a `PizzaModel` from the submitted fields, calls `PizzaService::registerNewPizza()`. If the return is a non-empty error array, re-renders the form filled in (values run through `htmlspecialchars`) with per-field error messages. On success, redirects to `/`. Always finishes by including [`views/add.php`](../views/add.md). |
| `detailsPage()` | `void` | The most complex method — concentrates 3 flows on the same page (broken down below) and always finishes by including [`views/details.php`](../views/details.md). |

### `detailsPage()` breakdown

State is driven by several flags/vars passed to the view:

1. **Load pizza**: if `$_GET['id']` is set, fetches it via `PizzaService::getPizzaById()` and stores it in `$specificPizza`.
2. **Delete** (3-step flow via POST):
   - `open-delete-modal` → sets `$showDeleteModal = true`
   - `cancel-delete` → sets `$showDeleteModal = false`
   - `confirm-delete` → calls `PizzaService::deletePizza($_POST['id-to-delete'])`; on failure, keeps the modal open with `$deletionError` set; on success, redirects to `/`.
3. **Edit** (3-step flow via POST):
   - `open-edit-modal` → sets `$showEditModal = true` and pre-fills `$editInput_newEmail/Title/Ingredients` with the pizza's current data
   - `cancel-edit` → sets `$showEditModal = false`
   - `confirm-edit` → builds a `PizzaModel` from `id-to-update` plus the `new-email`/`new-title`/`new-ingredients` fields, calls `PizzaService::updatePizza()`; if the return is an error array, keeps the modal open with `$editInputErrors` set; on success, redirects to `/details.php?id={id}`.

## Notes

- There's no "invalid/non-numeric id" handling before passing `$_GET['id']`/`$_POST['id-to-delete']`/`$_POST['id-to-update']` to the service — type checking only happens at the `int $id` signature of the service/repository methods (PHP's implicit coercion).
- `addPage()` and `detailsPage()` (in the edit flow) each independently reimplement the same "validate → if error array, keep the page with errors → else redirect" pattern, with no shared helper.

## Dependencies

- [PizzaModel](../models/pizza_model.md)
- [PizzaService](../services/pizza_service.md)

## Used by

- [entrypoints/index.php](../entrypoints/index.md)
- [entrypoints/add.php](../entrypoints/add.md)
- [entrypoints/details.php](../entrypoints/details.md)
