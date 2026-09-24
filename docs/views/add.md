# views/add.php

Real file: [`views/add.php`](../../views/add.php)

## Responsibility

Template for the `/add.php` page. Renders the pizza-creation form, with sticky values (kept after a validation error) and per-field error messages.

## Expected variables (contract with the Controller)

| Variable | Type | Source |
|---|---|---|
| `$email` | `string` | `Controller::addPage()` |
| `$title` | `string` | `Controller::addPage()` |
| `$ingredients` | `string` | `Controller::addPage()` |
| `$errors` | `array` (`['email'=>string,'title'=>string,'ingredients'=>string]`) | `Controller::addPage()` |

## Behavior

- Includes [`views/partials/header.php`](partials/header.md) and [`views/partials/footer.php`](partials/footer.md)
- `POST` form to `add.php` with 3 fields: `email`, `title`, `ingredients`, plus a `submit` button
- Each field shows its current value (`value="<?php echo $email ?>"`) and its corresponding error message right below (`<span class="error">`)

## Notes

- `$email`/`$title`/`$ingredients` already arrive escaped (`htmlspecialchars`) from the `Controller` when there's an error — the view doesn't escape them again.

## Dependencies

- [partials/header.php](partials/header.md)
- [partials/footer.php](partials/footer.md)
