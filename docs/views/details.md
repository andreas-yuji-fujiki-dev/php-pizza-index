# views/details.php

Real file: [`views/details.php`](../../views/details.php)

## Responsibility

Template for the `/details.php` page. Displays a specific pizza's details, and concentrates the edit/delete modal UI.

## Expected variables (contract with the Controller)

| Variable | Type | Source |
|---|---|---|
| `$specificPizza` | `?PizzaModel` | `Controller::detailsPage()` |
| `$showEditModal` | `bool` | `Controller::detailsPage()` |
| `$showDeleteModal` | `bool` | `Controller::detailsPage()` |
| `$deletionError` | `string` | `Controller::detailsPage()` |
| `$editingError` | `string` | `Controller::detailsPage()` (currently unused in the view beyond the `if($editingError)` check) |
| `$editInput_newEmail` | `string` | `Controller::detailsPage()` |
| `$editInput_newTitle` | `string` | `Controller::detailsPage()` |
| `$editInput_newIngredients` | `string` | `Controller::detailsPage()` |
| `$editInputErrors` | `array` (`['email'=>string,'title'=>string,'ingredients'=>string]`) | `Controller::detailsPage()` |

## Behavior

- Includes [`views/partials/header.php`](partials/header.md) and [`views/partials/footer.php`](partials/footer.md)
- If `$specificPizza` is empty, shows only "Invalid pizza..." in the title
- Otherwise, computes derived data directly in the view:
  - `$userName`: part before `@` in the email
  - `$ingredientsList`: `explode(',', ...)` of the ingredients
  - `$age`: difference between `created_at` and now, via `DateTime::diff()`, shown as "X years, Y months, Z days, H hours, M minutes, S seconds"
- Conditionally renders:
  - Delete confirmation modal (`$showDeleteModal`), with a `POST` form (`confirm-delete` / `cancel-delete`)
  - Edit modal (`$showEditModal`), with a `POST` form (`confirm-edit` / `cancel-edit`) pre-filled with `$editInput_*` and per-field errors from `$editInputErrors`
  - "About" block with author, creation date, age, and ingredients list
  - Action buttons (`open-delete-modal`, `open-edit-modal`)

## Notes

- Unlike `views/index.php` and `views/add.php`, the fields here (`$userName`, `$email`, ingredients, etc.) are **not** run through `htmlspecialchars()` before being printed — a potential reflected-XSS point if title/email/ingredients contained HTML/JS (partially mitigated by [`Validate`](../utils/validate.md)'s rules, which already restrict `title`/`ingredients` to letters, spaces, and commas).

## Dependencies

- [PizzaModel](../models/pizza_model.md)
- [partials/header.php](partials/header.md)
- [partials/footer.php](partials/footer.md)
