
<!-- Speaker notes:
Today we’ll build a clean mental model for data definition, initialization, environments, and RESTful endpoints in Laravel 12. We'll compare migrations vs seeders, talk environments/.env, database connections, routing conventions, versioning, and the core Artisan commands. 
-->

## Laravel 12: Data & APIs

**Key topics**
- Migrations vs Seeders  
- Environments & `.env`  
- Database Connections  
- Resourceful vs API Resourceful Controllers  
- Route Naming & Versioning  
- Essential Artisan Commands

---

<!-- Speaker notes:
Keep schema changes isolated in migrations and initial/fixture data in seeders. Migrations are reversible; seeders should be idempotent so you can re-run safely. Factories are perfect for generating realistic test data in development and testing.
-->

## Migrations vs Seeders

**Migrations**
- Version control for schema (tables, columns, indexes)  
- Executed in order; reversible (rollback)  
- Live in `database/migrations/`

**Seeders**
- Populate data (baseline, reference, sample)  
- Idempotent logic recommended  
- Live in `database/seeders/`

**Rule of thumb**  
**Migrations = structure**, **Seeders = data**

---

<!-- Speaker notes:
Use descriptive migration names. Laravel infers intent from names like create_*_table. Prefer separate migrations for structural changes; avoid mixing schema and large data transformations inside migrations.
-->

## Migration Essentials

**Typical migration**
```php
// database/migrations/2024_05_04_000000_create_courses_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('title');
            $table->unsignedTinyInteger('credits');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('courses');
    }
};
```

**Options**
- `--create=table` creates a create-table stub  
- `--table=table` updates existing table

---

<!-- Speaker notes:
Seed with factories for volume and realism. Use updateOrCreate or upsert to keep reruns safe. Orchestrate all seeders from DatabaseSeeder so a single command sets up your environment.
-->

## Seeding Essentials

**Seeder structure**
```php
// database/seeders/CourseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder {
    public function run(): void {
        \App\Models\Course::factory()
            ->count(20)
            ->create();

        // Deterministic inserts:
        \App\Models\Course::updateOrCreate(
            ['code' => 'CPT101'],
            ['title' => 'Computing Fundamentals', 'credits' => 3]
        );
    }
}
```

**DatabaseSeeder**
```php
// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([
            CourseSeeder::class,
        ]);
    }
}
```

---

<!-- Speaker notes:
APP_ENV selects the environment, APP_DEBUG must be false in production, and APP_KEY must be set. .env.testing is picked automatically by php artisan test. Cache config and routes in production after changes. Avoid env() in application code—read from config().
-->

## Environments (dev / test / prod)

**Environment concepts**
- `APP_ENV` switches configuration context (local, testing, production, etc.)  
- `.env` per host; **never** commit secrets  
- `.env.testing` auto‑used by `php artisan test` / PHPUnit  
- Production: `APP_DEBUG=false`, `APP_URL` set, `APP_KEY` set

**Caching**
- `php artisan config:cache` & `php artisan route:cache` for performance  
- After changing `.env`/config, clear & recache

**Best practice**
- Avoid `env()` outside `config/*`; use `config()` in app code

---

<!-- Speaker notes:
Keep a clean .env.example as a template. Use CI/CD or hosting secrets to inject real values per environment. For local dev, Sail or Valet defaults help. Never hardcode credentials in code or committed files.
-->

## `.env` & Config Loading

**Typical `.env` (database)**
```dotenv
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=college
DB_USERNAME=root
DB_PASSWORD=secret
```

**Config reference**
- `config/database.php` reads from `env()`  
- Use `config('database.connections.mysql.database')` in code if needed

**Tips**
- Maintain `.env.example` as a setup template  
- Inject per‑env secrets via deployment

---

<!-- Speaker notes:
You can define multiple connections in config/database.php and switch per query with DB::connection(name). Set the default connection for most operations. Consider strict mode and utf8mb4 in MySQL for correctness.
-->

## Database Connections (config/database.php)

**Multiple connections**
```php
return [
  'default' => env('DB_CONNECTION', 'mysql'),

  'connections' => [
    'mysql' => [
      'driver' => 'mysql',
      'url' => env('DATABASE_URL'),
      'host' => env('DB_HOST', '127.0.0.1'),
      'port' => env('DB_PORT', '3306'),
      'database' => env('DB_DATABASE', 'forge'),
      'username' => env('DB_USERNAME', 'forge'),
      'password' => env('DB_PASSWORD', ''),
      'unix_socket' => env('DB_SOCKET', ''),
      'charset' => 'utf8mb4',
      'collation' => 'utf8mb4_unicode_ci',
      'strict' => true,
    ],

    'pgsql_reporting' => [
      'driver' => 'pgsql',
      'host' => env('PG_HOST'),
      'port' => env('PG_PORT', 5432),
      'database' => env('PG_DB'),
      'username' => env('PG_USER'),
      'password' => env('PG_PASS'),
    ],
  ],
];
```

**Usage**
```php
use Illuminate\Support\Facades\DB;

DB::connection('pgsql_reporting')
  ->select('select count(*) from events');
```

---

<!-- Speaker notes:
Resourceful controllers are geared for server-rendered apps—Blade views, sessions, and CSRF via web middleware. They generate 7 methods including create/edit which return forms/pages.
-->

## Resourceful Controllers (Web)

**Purpose**
- Conventional CRUD methods for MVC with views

**Generate**
```bash
php artisan make:controller CourseController --resource
```

**Methods**
- `index`, `create`, `store`, `show`, `edit`, `update`, `destroy`

**Routes**
```php
use App\Http\Controllers\CourseController;

Route::resource('courses', CourseController::class);
```

---

<!-- Speaker notes:
API resourceful controllers are stateless, JSON-first, and omit create/edit. Typically under api middleware (no sessions, rate limiting). Pair with Route::apiResource and versioned namespaces.
-->

## API Resourceful Controllers (Stateless)

**Purpose**
- RESTful JSON endpoints; no HTML form pages

**Generate**
```bash
php artisan make:controller Api/V1/CourseController --api
```

**Methods**
- `index`, `store`, `show`, `update`, `destroy`

**Routes**
```php
use App\Http\Controllers\Api\V1\CourseController as CourseApi;

Route::apiResource('courses', CourseApi::class);
```

---

<!-- Speaker notes:
This table is your quick diff: web vs API. The main functional differences are methods, default middleware, expected responses, and routing helpers. You can have both in the same application.
-->

## Resourceful vs API Resourceful (At a Glance)

| Aspect | Resourceful (`--resource`) | API Resourceful (`--api`) |
|---|---|---|
| Methods | 7 incl. `create`, `edit` | 5 (no `create`, `edit`) |
| Views | Returns Blade views | Returns JSON / API responses |
| Middleware | Usually `web` | Usually `api` |
| Routes | `Route::resource` | `Route::apiResource` |
| Use case | Server‑rendered UI | SPA/mobile/3rd‑party API |

---

<!-- Speaker notes:
Use prefixes and name prefixes to keep routes organized and avoid collisions. For APIs, version in the URL (api/v1) and in route names (api.v1.*). Group with middleware('api') for stateless behavior.
-->

## Route Naming Conventions

**Web routes**
```php
Route::resource('courses', CourseController::class);
```

**API routes**
```php
Route::prefix('api')->middleware('api')->group(function () {
    Route::apiResource('courses', CourseApi::class);
});
```

**Consistent naming**
```php
Route::prefix('api/v1')->as('api.v1.')->middleware('api')->group(function () {
    Route::apiResource('courses', CourseApi::class);
});
```

---

<!-- Speaker notes:
Version controllers and resources together. Introduce V2 for breaking changes and deprecate V1 with a communicated timeline.
-->

## Versioning APIs (V1, V2, …)

**Folder & namespace**
```
app/Http/Controllers/Api/V1/CourseController.php
app/Http/Controllers/Api/V2/CourseController.php
```

**Routes**
```php
Route::prefix('api/v1')->as('api.v1.')->group(function () {
    Route::apiResource('courses', \App\Http\Controllers\Api\V1\CourseController::class);
});
```

---

<!-- Speaker notes:
In practice, validate requests, return paginated resources, and use API Resources for consistent JSON shapes. Add policies and auth.
-->

## Example: API Controller Snippet

```php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
```
