#!/usr/bin/env bash
set -euo pipefail
PROJECT_NAME="${1:-api-starter}"

printf "Creating Laravel app: %s\n" "$PROJECT_NAME"
composer create-project laravel/laravel "$PROJECT_NAME"
cd "$PROJECT_NAME"

printf "Installing Pest (dev)...\n"
composer require pestphp/pest --dev --with-all-dependencies

if [ -x "vendor/bin/pest" ]; then
  vendor/bin/pest --init >/dev/null 2>&1 || true
fi

# Ensure SQLite DB exists
mkdir -p database
: > database/database.sqlite

# Append DB settings (last wins)
echo "\nDB_CONNECTION=sqlite" >> .env
DB_ABS_PATH="$(pwd)/database/database.sqlite"
echo "DB_DATABASE=${DB_ABS_PATH}" >> .env

# Copy overlay into project root
cp -R ../overlay/* .

php artisan key:generate >/dev/null 2>&1 || true
php artisan migrate

echo "Done. Start the server with: php artisan serve" 
