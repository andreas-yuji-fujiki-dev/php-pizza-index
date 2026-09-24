# 🍕 Pizza Index

<p>
  <img src="https://img.shields.io/badge/status-learning%20project-yellow?style=for-the-badge" alt="status: learning project">
  <img src="https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.4">
  <img src="https://img.shields.io/badge/MariaDB-11-003545?style=for-the-badge&logo=mariadb&logoColor=white" alt="MariaDB 11">
  <img src="https://img.shields.io/badge/Docker-Compose-2496ED?style=for-the-badge&logo=docker&logoColor=white" alt="Docker Compose">
  <img src="https://img.shields.io/badge/Apache-2.4-D22128?style=for-the-badge&logo=apache&logoColor=white" alt="Apache 2.4">
</p>

> **This was my first PHP project.** I built it to learn the language and basic backend concepts (routing by hand, a layered architecture, form validation, raw SQL with `mysqli`, Docker) from scratch, without a framework. Expect rough edges — see [What wasn't implemented](#-what-wasnt-implemented) below.

Pizza Index is a small CRUD web app: it lists pizzas submitted by users, and lets anyone create, view, edit, and delete a pizza entry.

## 📖 Full technical documentation

A full breakdown of the architecture, every class/file, its responsibilities and methods lives in **[`/docs/README.md`](docs/README.md)**. This README only covers the big picture and how to run the project.

## 🤖 A note on AI usage

I used AI (Claude) **only to write the documentation** — this README and everything under [`/docs`](docs/README.md). Every line of application code (controllers, services, repository, models, views, validation) is mine, written as I learned PHP.

I treated it as a documentation tool, not a substitute for understanding my own code, following what I consider good practice when coding with AI:

- I gave it real, deliberate context instead of a vague "document this": the actual project structure, the layered architecture I built, and clear instructions on how I wanted the docs organized (one folder per layer, one file per class, methods + responsibilities listed).
- I had it **read every source file directly** before writing anything, so the docs describe what the code actually does instead of guessing or hallucinating behavior.
- I reviewed the generated docs myself before committing them, rather than pasting them in blind.
- I kept the boundary clear: AI assisted with the *write-up* of a project I designed and coded end-to-end, not with the engineering decisions themselves.

## 🧠 Design decisions

A few choices here were made on purpose, for the sake of learning, not because they're the "correct" engineering call for a project this size:

- **Layered / MVC-ish architecture for a CRUD this small, on purpose.** A pizza CRUD doesn't need an `entrypoint → controller → service → repository → model` pipeline plus a separate `Validate` class — I could've written each page as one flat script. I over-engineered it deliberately, to force myself to actually use PHP's OOP features (classes, constructors, dependency instantiation, `private`/`public` visibility, typed properties) instead of writing everything as loose procedural scripts, which would've been the easy way out for a first project.
- **`mysqli` instead of `PDO`.** I know `PDO` is generally the better choice for new PHP projects — it's database-agnostic, supports named parameters, and has more consistent error handling via exceptions. I went with `mysqli` anyway: this was **my first PHP project ever**, so I picked the more straightforward, procedural-friendly API to focus on learning the language and the request lifecycle first, without also juggling PDO's object/exception model at the same time. See [`docs/repository/pizza_repository.md`](docs/repository/pizza_repository.md) for how it's used, and its trade-offs (like the lack of prepared statements, noted above).
- **Typed properties and typed method signatures wherever PHP allows it** (`public int $id`, `string $title` on `PizzaModel`, typed parameters across services/repository). I leaned on PHP's type system on purpose instead of treating everything as loosely-typed arrays, specifically to practice it.
- **A dedicated `PizzaModel` DTO instead of passing arrays around.** Data crosses every layer as a `PizzaModel` instance, not as an associative array — the repository explicitly maps each database row into one. It's more code than just returning `mysqli_fetch_assoc()` results straight to the view, but that was the point: practicing object-oriented data modeling instead of the array-shaped shortcut.
- **Vanilla CSS, no framework or preprocessor.** No Tailwind/Bootstrap/Sass — plain CSS files split by concern ([`reset.css`](assets/css/reset.css), [`styles.css`](assets/css/styles.css), [`responsivity.css`](assets/css/responsivity.css)). The project's whole point was learning PHP, so I kept the frontend side as simple and dependency-free as possible instead of splitting focus with CSS tooling.
- **No PHP framework** (Laravel, Symfony, Slim, etc.). Same reasoning as the `mysqli` choice: I wanted to write routing, request handling, and the database connection wrapper by hand first, to understand what a framework actually abstracts away, before relying on one.
- **A connection opened and closed per repository call, instead of a shared/pooled connection.** Every `PizzaRepository` method calls `DatabaseConfig::connect()`/`disconnect()` on its own. It's less efficient than reusing one connection per request, but simpler to reason about while learning how `mysqli` connections work.

## 🧭 Routes

| Method | Route | Description |
|---|---|---|
| `GET` | `/` | Lists all registered pizzas (empty state if there are none). |
| `GET` | `/add.php` | Shows the "add a pizza" form. |
| `POST` | `/add.php` | Creates a new pizza (`submit` field). Re-renders the form with errors on invalid input. |
| `GET` | `/details.php?id={id}` | Shows a specific pizza's details. |
| `POST` | `/details.php?id={id}` | Handles delete/edit actions on the same page, depending on which button was submitted: `open-delete-modal`, `cancel-delete`, `confirm-delete`, `open-edit-modal`, `cancel-edit`, `confirm-edit`. |

There's no router/rewrite layer — each route above is a literal `.php` file at the project root. See [`docs/entrypoints/`](docs/entrypoints/) for details.

## ✅ What was implemented

- List pizzas on the home page, with an empty-state fallback
- Create a pizza, with server-side validation (valid email, letters-only title, at least 3 comma-separated ingredients)
- View a pizza's details, including computed fields (author name parsed from the email, "age since creation" formatted from the timestamp)
- Edit a pizza (via modal), reusing the same validation rules
- Delete a pizza (via confirmation modal)
- Responsive layout (mobile and desktop)
- A seeder script with 40 sample pizzas, for local development
- Dockerized environment (PHP+Apache app container, MariaDB container with healthcheck, schema auto-applied on first boot)
- A layered architecture (entrypoints → controllers → services → repository → database), documented per-file in [`/docs`](docs/README.md)

## ❌ What wasn't implemented

- **Authentication/authorization** — anyone can edit or delete any pizza; the submitted email is just a label, not an identity check
- **Consistent SQL injection protection** — inserts/updates escape input with `mysqli_real_escape_string()`, but `queryById()`/`queryDelete()` interpolate the `id` straight into the SQL string, relying only on PHP's `int` type hint for safety. No prepared statements are used anywhere.
- **Consistent XSS protection** — `views/index.php` and `views/add.php` escape output with `htmlspecialchars()`, but `views/details.php` prints pizza data (title, ingredients, email) straight into the HTML, unescaped.
- **CSRF protection** on the forms
- **Pagination, search, or filtering** on the pizza list
- **Image upload** — every pizza uses the same static illustration
- **Automated tests** (unit or integration)
- **Friendly/pretty URLs** — routes are literal `.php` files with query strings (e.g. `/details.php?id=1`)
- **Rate limiting** or any abuse protection

## 🚀 Getting started

### Option A — Docker (recommended)

Requirements: [Docker](https://www.docker.com/) and Docker Compose.

1. Clone the repository:
   ```bash
   git clone git@github.com:andreas-yuji-fujiki-dev/php-pizza-index.git
   cd php-pizza-index
   ```

2. Create the environment variables (see [Environment variables](#-environment-variables) below) — this file is required by the app and is **not** committed to the repo.

3. Build and start the containers:
   ```bash
   docker compose up -d --build
   ```
   This starts the `app` container (PHP 8.4 + Apache, port `8080`) and the `db` container (MariaDB 11), and applies [`database/init.sql`](database/init.sql) automatically on the database's first boot.

4. *(Optional)* Seed the database with 40 sample pizzas:
   ```bash
   docker compose exec app php database/seeders/seed_pizzas.php
   ```

5. Open the app in your browser:
   ```
   http://localhost:8080
   ```

### Option B — Local PHP server (XAMPP/LAMPP or similar)

Requirements: PHP 8.4+ with the `mysqli` extension, Apache (or `php -S`), and a MySQL/MariaDB server.

1. Clone the repository into your server's document root (e.g. `htdocs`):
   ```bash
   git clone git@github.com:andreas-yuji-fujiki-dev/php-pizza-index.git
   ```

2. Create a database and apply the schema:
   ```bash
   mysql -u root -p -e "CREATE DATABASE pizza_index"
   mysql -u root -p pizza_index < database/init.sql
   ```

3. Create the environment variables (see below) with your local database credentials.

4. *(Optional)* Seed the database:
   ```bash
   php database/seeders/seed_pizzas.php
   ```

5. Start Apache/MySQL (through XAMPP/LAMPP's control panel, or your own setup) and open the app in your browser, e.g.:
   ```
   http://localhost/php-pizza-index
   ```

## 🔑 Environment variables

The app reads its database credentials from [`config/database.php`](config/database.php) (documented in [`docs/config/database.md`](docs/config/database.md)), which requires a file named **`env_variables.php`** at the project root. This file is listed in [`.gitignore`](.gitignore) and is **not** part of the repository — you have to create it yourself after cloning.

Create `env_variables.php` at the project root with:

```php
<?php
  define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
  define('DB_USER', getenv('DB_USER') ?: 'root');
  define('DB_PASSWORD', getenv('DB_PASSWORD') ?: '');
  define('DB_NAME', getenv('DB_NAME') ?: 'pizza_index');
?>
```

- **Running with Docker**: the fallback values above are irrelevant — `docker compose` already injects `DB_HOST`, `DB_USER`, `DB_PASSWORD`, `DB_NAME` into the `app` container (see [`compose.yaml`](compose.yaml)), and `getenv()` picks those up. You only need to create the file so the `require` in `config/database.php` doesn't fail; the exact content above works as-is.
- **Running locally without Docker**: there are no container env vars, so replace the fallback values (after `?:`) with your actual local database host/user/password/name.
- **Customizing the Docker database credentials**: `compose.yaml` reads `DB_USER`, `DB_PASSWORD`, and `DB_ROOT_PASSWORD` from your shell environment or from a `.env` file at the project root (Docker Compose loads it automatically). If you don't create one, it falls back to `pizza_user` / `pizza_password` / `root_password`. Example `.env`:
  ```
  DB_USER=pizza_user
  DB_PASSWORD=pizza_password
  DB_ROOT_PASSWORD=root_password
  ```

## 🛠️ Tech stack

- PHP 8.4 (no framework)
- MariaDB 11 (`mysqli` extension, raw SQL)
- Apache 2.4
- Docker Compose
