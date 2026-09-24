# database/init.sql

Real file: [`database/init.sql`](../../database/init.sql)

## Responsibility

Schema initialization SQL script. Mounted into the `db` container (MariaDB) via `docker-entrypoint-initdb.d`, as configured in [`compose.yaml`](../../compose.yaml) — runs automatically only on the first initialization of the `db_data` volume.

## Table: `pizzas`

| Column | Type | Constraints |
|---|---|---|
| `id` | `INT UNSIGNED` | `NOT NULL`, `AUTO_INCREMENT`, `PRIMARY KEY` |
| `title` | `VARCHAR(255)` | `NOT NULL` |
| `ingredients` | `TEXT` | `NOT NULL` (comma-separated string) |
| `email` | `VARCHAR(255)` | `NOT NULL` |
| `created_at` | `TIMESTAMP` | `NOT NULL`, `DEFAULT CURRENT_TIMESTAMP` |

## Notes

- `CREATE TABLE IF NOT EXISTS`: safe to run more than once manually, even though the MariaDB entrypoint only runs it automatically once per fresh volume.
- Maps directly to [`PizzaModel`](../models/pizza_model.md)'s properties.

## Related

- [database/seeders/seed_pizzas.php](seeders/seed_pizzas.md) — populates this table with sample data
