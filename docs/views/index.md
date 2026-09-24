# views/index.php

Real file: [`views/index.php`](../../views/index.php)

## Responsibility

Template for the home page (`/`). Renders the grid of registered pizzas, or an empty state if there are none.

## Expected variables (contract with the Controller)

| Variable | Type | Source |
|---|---|---|
| `$pizzasList` | `PizzaModel[]` | `Controller::indexPage()` |

## Behavior

- Includes [`views/partials/header.php`](partials/header.md) and [`views/partials/footer.php`](partials/footer.md)
- If `$pizzasList` is empty/falsy: shows a fallback message with a link to `/add.php`
- If there's at least 1 pizza: renders one `.pizza-card` per item, with a static image (`assets/images/pizza.svg`), title, ingredients list (`explode(',', $pizza->ingredients)`), and a "More info" button linking to `/details.php/?id={id}`
- All text values coming from the database are escaped with `htmlspecialchars()` before being printed

## Dependencies

- [PizzaModel](../models/pizza_model.md)
- [partials/header.php](partials/header.md)
- [partials/footer.php](partials/footer.md)
