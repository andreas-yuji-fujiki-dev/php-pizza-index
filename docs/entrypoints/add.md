# entrypoints/add.php

Real file: [`add.php`](../../add.php)

## Responsibility

HTTP entry point for the `/add.php` route. Contains no logic of its own — it just sets up the `Controller` and delegates to the pizza-creation flow (form display on GET, processing on POST).

## Behavior

1. Includes [`controllers/pizza_controller.php`](../../controllers/pizza_controller.php)
2. Instantiates `Controller`
3. Calls `Controller::addPage()`, which handles the form submission (`$_POST['submit']`) and renders [`views/add.php`](../views/add.md)

## Dependencies

- [Controller](../controllers/pizza_controller.md)
