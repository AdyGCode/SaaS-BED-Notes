
# SaaS-2-BED Session 01 – Starter Repo (Laravel 12 + SQLite)

This starter package contains an **overlay** of Laravel API code (models, controllers, resources, requests, migrations, factories, tests) and **setup scripts** that will create a fresh Laravel 12 app, enable **SQLite**, install **Pest**, and copy the overlay into the project.

## Quick Start (Windows 11 + Laragon)

1. Open **PowerShell** and navigate to a working folder under Laragon, e.g.:
   ```powershell
   cd C:\laragon\www
   ```
2. Run the setup script (creates a new project folder `api-starter` by default):
   ```powershell
   .\scripts\setup-laravel.ps1 -ProjectName api-starter
   ```
3. Start the app:
   ```powershell
   cd .\api-starter
   php artisan serve
   ```
4. Run migrations & tests (setup script already migrates once):
   ```powershell
   php artisan migrate
   .\vendor\bin\pest
   ```

## Quick Start (Git Bash or WSL)

```bash
cd /c/laragon/www
bash scripts/setup-laravel.sh api-starter
cd api-starter
php artisan serve
```

## Endpoints
- `GET /api/courses` – list courses
- `GET /api/courses/{id}` – get one
- `POST /api/courses` – create (201 + Location)
- `PUT/PATCH /api/courses/{id}` – update (200/204)
- `DELETE /api/courses/{id}` – delete (204)

…and the same for `students`.

## Postman
Export your collection (v2.1) after adding sample requests with headers `Accept: application/json` and `Content-Type: application/json` for body requests.

## Notes
- SQLite is configured in `.env` by the setup script. It creates `database/database.sqlite` and appends:
  ```
  DB_CONNECTION=sqlite
  DB_DATABASE=ABSOLUTE_PATH_TO_PROJECT\database\database.sqlite
  ```
- If you prefer a relative path, edit `config/database.php` for the sqlite connection to use `database_path('database.sqlite')` as the default.

## References
- Laravel Routing & API Basics: https://laravel.com/docs/12.x/routing
- Database (SQLite) configuration: https://laravel.com/docs/12.x/database
- Pest Testing Framework: https://pestphp.com/
