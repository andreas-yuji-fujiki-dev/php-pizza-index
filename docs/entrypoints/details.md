# entrypoints/details.php

Real file: [`details.php`](../../details.php)

## Responsibility

HTTP entry point for the `/details.php` route. Contains no logic of its own — it just sets up the `Controller` and delegates to the view/edit/delete flow for a specific pizza.

## Behavior

1. Includes [`controllers/pizza_controller.php`](../../controllers/pizza_controller.php)
2. Instantiates `Controller`
3. Calls `Controller::detailsPage()`, which reads `$_GET['id']` and the various modal states (edit/delete) via `$_POST`, and renders [`views/details.php`](../views/details.md)

## Dependencies

- [Controller](../controllers/pizza_controller.md)
