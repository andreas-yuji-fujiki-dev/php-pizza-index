# entrypoints/index.php

Real file: [`index.php`](../../index.php)

## Responsibility

HTTP entry point for the `/` route. Contains no logic of its own — it just sets up the `Controller` and delegates to the listing page.

## Behavior

1. Includes [`controllers/pizza_controller.php`](../../controllers/pizza_controller.php)
2. Instantiates `Controller`
3. Calls `Controller::indexPage()`, which fetches all pizzas and renders [`views/index.php`](../views/index.md)

## Dependencies

- [Controller](../controllers/pizza_controller.md)
