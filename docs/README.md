# Documentation — Pizza Index

Technical documentation for the application, organized by responsibility layer. Each folder below mirrors a folder in the project root.

## Architecture

Simple layered PHP application (procedural + OOP), no framework:

```
HTTP request
      │
      ▼
entrypoints (index.php, add.php, details.php)   ← "routes", 1 file per page
      │
      ▼
controllers (Controller)                        ← reads $_GET/$_POST, orchestrates, picks view
      │
      ▼
services (PizzaService)                         ← business rule: validates before writing
      │            │
      ▼            ▼
repository       utils (Validate)                ← data access        ← field validation
(PizzaRepository)
      │
      ▼
config (DatabaseConfig + env_variables.php)      ← mysqli connection
      │
      ▼
database (init.sql + seeders/seed_pizzas.php)    ← schema and sample data

models (PizzaModel) — DTO used across all layers above
views  — PHP templates rendered by the controllers
```

## Index by layer

- [entrypoints/](entrypoints/) — PHP scripts hit directly by the browser (the application's "routes")
- [controllers/](controllers/) — `Controller`, orchestrates request → service → view
- [services/](services/) — `PizzaService`, business rule (validation + delegation to the repository)
- [repository/](repository/) — `PizzaRepository`, data access (mysqli)
- [models/](models/) — `PizzaModel`, pizza data object (DTO)
- [utils/](utils/) — `Validate`, form field validation rules
- [config/](config/) — `DatabaseConfig` and connection environment variables
- [database/](database/) — SQL schema and sample data seeder
- [views/](views/) — PHP templates rendered by the controllers

## Request flow (example: listing pizzas)

1. Browser hits `/` → Apache serves [index.php](../index.php)
2. `index.php` instantiates `Controller` and calls `indexPage()`
3. `Controller::indexPage()` calls `PizzaService::getAllPizzas()`
4. `PizzaService::getAllPizzas()` delegates to `PizzaRepository::queryAll()`
5. `PizzaRepository::queryAll()` opens a connection via `DatabaseConfig::connect()`, runs `SELECT * FROM pizzas`, maps each row to a `PizzaModel` and closes the connection
6. `Controller::indexPage()` passes the list of `PizzaModel` to [views/index.php](../views/index.php), which is rendered
