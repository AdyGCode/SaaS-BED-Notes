
param(
    [string]$ProjectName = "api-starter"
)

$ErrorActionPreference = 'Stop'

Write-Host "Creating Laravel app: $ProjectName" -ForegroundColor Cyan
composer create-project laravel/laravel $ProjectName
Set-Location $ProjectName

Write-Host "Installing Pest (dev)..." -ForegroundColor Cyan
composer require pestphp/pest --dev --with-all-dependencies

# Initialize Pest if not already
if (Test-Path .\vendor\bin\pest) {
    .\vendor\bin\pest --init | Out-Null
}

# Ensure SQLite file exists
$dbPath = Join-Path (Get-Location) "database\database.sqlite"
if (-not (Test-Path $dbPath)) { New-Item -ItemType File -Path $dbPath | Out-Null }

# Append DB settings (last wins)
Add-Content ".env" "`nDB_CONNECTION=sqlite"
Add-Content ".env" ("DB_DATABASE=" + $dbPath)

# Copy overlay from parent
$overlay = Resolve-Path "..\overlay\*"
Write-Host "Copying overlay files..." -ForegroundColor Cyan
Copy-Item -Path $overlay -Destination . -Recurse -Force

# Generate key and migrate
php artisan key:generate | Out-Null
php artisan migrate

Write-Host "Done. Run 'php artisan serve' to start the server." -ForegroundColor Green
