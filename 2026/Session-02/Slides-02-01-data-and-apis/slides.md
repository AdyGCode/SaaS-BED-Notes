---
theme: nmt
background: https://cover.sli.dev
title: Session 01 - PHP Fundamentals & Intro MVC
class: text-left
drawings:
  persist: false
transition: fade
mdc: true
duration: 35min
---

# Session 02: Laravel 12 - Data and APIs

## SaaS 2 – REST API Development 


<div @click="$slidev.nav.next" class="mt-12 -mx-4 p-4" hover:bg="white op-10">
<p>Press <kbd>Space</kbd> or <kbd>RIGHT</kbd> for next slide/step <fa7-solid-arrow-right /></p>
</div>

<div class="abs-br m-6 text-xl">
  <a href="https://github.com/adygcode/SaaS-FED-Notes" target="_blank" class="slidev-icon-btn">
    <fa7-brands-github class="text-zinc-300 text-3xl -mr-2"/>
  </a>
</div>


---
layout: default
level: 2
---


# Navigating Slides

Hover over the bottom-left corner to see the navigation's controls panel.

## Keyboard Shortcuts

|                                                     |                             |
| --------------------------------------------------- | --------------------------- |
| <kbd>right</kbd> / <kbd>space</kbd>                 | next animation or slide     |
| <kbd>left</kbd>  / <kbd>shift</kbd><kbd>space</kbd> | previous animation or slide |
| <kbd>up</kbd>                                       | previous slide              |
| <kbd>down</kbd>                                     | next slide                  |


---
layout: section
---

# Objectives


---
layout: two-cols
level: 2
---

# Objectives

::left::

- Migrations vs Seeders  

- Environments & `.env`  

- Database Connections  


::right::

- Resourceful vs API Resourceful Controllers  

- Route Naming & Versioning  

- Essential Artisan Commands

<!-- 

Today we’ll build a clean mental model for data definition, initialization, environments, and RESTful endpoints in Laravel 12. We'll compare migrations vs seeders, talk environments/.env, database connections, routing conventions, versioning, and the core Artisan commands. 
-->


---
level: 1
---

# Contents 

<Toc minDepth="1" maxDepth="1" />

---
layout: section
---

# Migrations vs Seeders


---
level: 2
layout: two-cols
---

# Migrations vs Seeders

::left::

## Migrations

STRUCTURE

- Version control for schema (tables, columns, indexes)  
- Executed in order; reversible (rollback)  
- Live in `database/migrations/`

::right::

## Seeders

DATA

- Populate data (baseline, reference, sample)  
- Idempotent logic recommended  
- Live in `database/seeders/`


<!-- 

Keep schema changes isolated in migrations and initial/fixture data in seeders. Migrations are reversible; seeders should be idempotent so you can re-run safely. Factories are perfect for generating realistic test data in development and testing.
-->


---
level: 2
---

# Migrations vs Seeders

## Migration

```shell
php artisan make:migration <MIGRATION NAME>
```

### Example

```shell
php artisan make:migration create_courses_table --create=courses
```

### Additional Options
- `--create=table` creates a create-table stub  
- `--table=table` updates existing table


---
level: 2
---

# Migrations vs Seeders

## Seeder

```shell
php artisan make:seed <SEEDER NAME>
```

### Example

```shell
php artisan make:seed CourseSeeder 
```

---
level: 2
---

## Example Migration

````md magic-move

```php [PHP] {none|1-3|5,7}
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    ...
};
```

```php [PHP] {3,18|4,13|5,12|6,11|7-10|15-17}
use ...

return new class extends Migration {
    public function up(): void {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12)->unique();
            $table->string('title', 128);
            $table->string('description')->nullable();
            $table->unsignedTinyInteger('credits');
            $table->timestamps();
        });
    }
    
    public function down(): void {
        Schema::dropIfExists('courses');
    }
};
```


````

<!-- 

Use descriptive migration names. 

Laravel infers intent from names like create_*_table. 

Prefer separate migrations for structural changes; 

Avoid mixing schema and large data transformations inside migrations.
-->


---
level: 2
---

## Example Seeding for Courses

````md magic-move

```php [PHP] {none|1-4|6,8}
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder {
...
}
```

```php [PHP] {3,16|4,6}
...

class CourseSeeder extends Seeder {
    public function run(): void {
        ...
    }
}
```


```php [PHP] {5-8}
...

class CourseSeeder extends Seeder {
    public function run(): void {
        // Seed using a factory
        Course::factory()
            ->count(20)
            ->create();
    }
}
```


```php [PHP] {5-9}
...

class CourseSeeder extends Seeder {
    public function run(): void {
        // Deterministic inserts:
        Course::updateOrCreate(
            ['code' => 'CPT101'],
            ['title' => 'Computing Fundamentals', 'credits' => 3]
        );
    }
}
```


```php [PHP] {5|7,14|8-12|16-18}
...

class CourseSeeder extends Seeder {
    public function run(): void {
        // Deterministic inserts, Seed data array

        $seedCourses = [
            [
                'code' => 'CPT101',
                'title' => 'Computing Fundamentals', 
                'credits' => 3,
            ],
        
        ];
        
        foreach( $seedCourses as $seedCourse) {
            Course::updateOrCreate($seedCourse);
        );
    }
}
```


```php [PHP] {all}
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder {
    public function run(): void {
        // Deterministic inserts, Seed data array

        $seedCourses = [
            [
                'code' => 'CPT101',
                'title' => 'Computing Fundamentals', 
                'credits' => 3,
            ],
        
        ];
        
        foreach( $seedCourses as $seedCourse) {
            Course::updateOrCreate($seedCourse);
        );
    }
}
```

````

<!-- 

Seed with factories for volume and realism.

Use updateOrCreate or upsert to keep reruns safe.

Orchestrate all seeders from DatabaseSeeder so a single command sets up your environment.
-->

---
level: 2
---

## Database Seeder

- Calls the seeders in order
- Always seed:
  - tables with no foreign keys (FK)
  - tables with one FK
  - tables with two FK
  - etc


---
level: 2
---

## Database Seeder Example

````md magic-move

```php [PHP] {none|1-3|5,11|6,10|7-9|all}
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

````

---
layout: section
---

# Application Environments

---
level: 2
layout: two-cols
---

# Environment concepts

::left::

- `APP_ENV` switches configuration context 
  - local
  - testing
  - production
  - etc.  
- `.env` per host

::right::

- **NEVER** commit secrets  
- `.env.testing` auto‑used by:
  - PEST (`php artisan test`)
  - and PHPUnit  
- Production:
  - Set `APP_DEBUG=false`
  - Ensure `APP_URL` & `APP_KEY` set


<!-- 

APP_ENV selects the environment, 
APP_DEBUG must be false in production, 
APP_KEY must be set. 

.env.testing is picked automatically by php artisan test. 
-->

---
level: 2
layout: two-cols
---

## Caching

::left::

Used to improve performance

- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan view:cache`
- `php artisan route:cache`

::right::

Clear and Recache after changing any `.env`/config settings
- `php artisan config:clear`
- `php artisan view:clear`
- `php artisan cache:clear`
- `php artisan event:clear`
- `php artisan route:clear`



<!-- 

Cache config and routes in production after changes.
-->

---
level: 2
layout: two-cols
---

## Caching

::left::
When in production we usually:
- clear all caches
- re-optimize the composer autoload

::right::

To do this use

- `php artisan optimize:clear`


Best practice

- Avoid `env()` outside `config/*`
- Use `config()` in app code

<!-- 

Cache config and routes in production after changes. 
Avoid env() in application code
Instead read via config().
-->

---
layout: section
---

# .env & Config Loading

---
level: 2
---

# .env & Config Loading

## Typical `.env` 

Example "cut down" `.env` with a MariaDB/MySQL database

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

<!-- 

Keep a clean .env.example as a template. Use CI/CD or hosting secrets to inject real values per environment. For local dev, Sail or Valet defaults help. Never hardcode credentials in code or committed files.
-->

---
level: 2
---

# Config reference

- `config/database.php` reads from `env()`  
- Use `config('database.connections.mysql.database')` in code if needed

## Tips
- Maintain `.env.example` as a setup template  
- Inject per‑env secrets via deployment

---
layout: section
---

# Database Connections
## `config/database.php`

---
level: 2
---

## Database Connections

- Multiple connections are possible
- Default unless connection specified in model

````md magic-move

```php
return [
  'default' => env('DB_CONNECTION', 'mysql'),

  'connections' => [
    ...
  ],
];
```


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
...
  ],
];
```


```php
return [
  'default' => env('DB_CONNECTION', 'mysql'),

  'connections' => [
        ...

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

````


<!-- 

You can define multiple connections in config/database.php and switch per query with DB::connection(name). Set the default connection for most operations. Consider strict mode and utf8mb4 in MySQL for correctness.
-->

---
level: 2
---

# Database Connections

## Using a direct connection

- Direct connection to database
- Apply query (RAW SQL) from connection

```php
use Illuminate\Support\Facades\DB;

DB::connection('pgsql_reporting')
  ->select('select count(*) from events');
```

---
level: 2
---

# Database Connections

## Using Eloquent

Remember that Eloquent may make it easier

Options:

- Using the Model (recommended)
- Using the Model without editing the model
- Using Eloquent Query Builder (still model‑aware)

---
level: 2
---

# Database Connections

## Using Eloquent

Have an event model?
- Point it to the reporting connection
- Uses the model’s default aggregate methods


---
level: 2
---

# Database Connections

## Model

```php [PHP] {all}
class Event extends Model{
    protected $connection = 'pgsql_reporting';    
    protected $table = 'events';
    // ...
}
```

## Query

```php [PHP] {all}
$count = Event::count();
```



---
layout: section
---

# Resourceful Controllers

## Comparing Web and API 

---
level: 2
---

# Resourceful Controllers (Web)

### Purpose
- Conventional CRUD methods for MVC with views

### Generate
```bash
php artisan make:controller CourseController --resource
```

### Methods
- `index`, `create`, `store`, `show`, `edit`, `update`, `destroy`

### Routes
```php
use App\Http\Controllers\CourseController;

Route::resource('courses', CourseController::class);
```



<!-- 

Resourceful controllers are geared for
- server-rendered apps, 
- Blade views, 
- sessions, and 
- CSRF via web middleware. 

They generate 7 methods including create/edit which return forms/pages.
-->

---
level: 2
---

# API Resourceful Controllers (Stateless)

### Purpose
- RESTful JSON endpoints
- **NO** HTML form pages

### Generate
```bash
php artisan make:controller Api/V1/CourseController --api
```

### Methods
- `index`, `store`, `show`, `update`, `destroy`

### Routes
```php
use App\Http\Controllers\Api\V1\CourseController as CourseApi;

Route::apiResource('courses', CourseApi::class);
```

<!-- 

API resourceful controllers are:
- stateless, 
- JSON-first, and
- omit create/edit. 

Typically under api middleware (no sessions, rate 
limiting). 

Pair with Route::apiResource and versioned namespaces.
-->


---
layout: section
---

# Resourceful Web vs API

## A quick comparison

---
level: 2
---

# Resourceful vs API Resourceful

| **Aspect** | Web Resourceful (`--resource`) | API Resourceful (`--api`) |
|---|--------------------------------|---|
| **Methods** | 7 incl. `create`, `edit`       | 5 (no `create`, `edit`) |
| **Views** | Returns Blade views            | Returns JSON / API responses |
| **Middleware** | Usually `web`                  | Usually `api` |
| **Routes** | `Route::resource`              | `Route::apiResource` |
| **Use case** | Server‑rendered UI             | SPA/mobile/3rd‑party API |



<!-- 

This table is your quick diff: web vs API. 

The main functional differences are methods, default middleware, expected responses, and routing helpers. 

You can have both in the same application.
-->

---
layout: section
---

# Route Naming Conventions

---
level: 2
---

# Route Naming Conventions

## Web routes
```php
Route::resource('courses', CourseController::class);
```

## API routes
```php
Route::prefix('api')
    ->middleware('api')
    ->group(function () {
        Route::apiResource('courses', CourseApi::class);
    });
```

<!-- 

Use prefixes and name prefixes to keep routes organized and avoid collisions. 

-->

---
level: 2
---

# Route Naming Conventions

## Consistent naming

```php
Route::prefix('api/v1')
    ->as('api.v1.')
    ->middleware('api')
    ->group(function () {
        Route::apiResource('courses', CourseApi::class);
    });
```

<!-- 

For APIs, version in the URL (api/v1) 
and in route names (api.v1.*). 

Group with middleware('api') for stateless behaviour.
-->


---
layout: section
---

# Versioning APIs (V1, V2, …)

---
level: 2
---


## Versioning APIs (V1, V2, …)

## Folder & namespace

```
app/Http/Controllers/Api/V1/CourseController.php
app/Http/Controllers/Api/V2/CourseController.php
```

## Routes

````md magic-move

```php
use \App\Http\Controllers\Api\V1\CourseController as Api_V1_CourseController;
use \App\Http\Controllers\Api\V2\CourseController as Api_V2_CourseController;

Route::prefix('api/v1')
    ->as('api.v1.')
    ->group(function () {
        Route::apiResource('courses', Api_V1_CourseController::class);
});

// API V2 after
```

```php
// API V1 Routes before

Route::prefix('api/v2')
    ->as('api.v2.')
    ->group(function () {
        Route::apiResource('courses', Api_V2_CourseController::class);
});

```

````

<!-- 

Version controllers and resources together. 

Use Aliases to reduce namespace verbosity in routes.

Introduce V2 for breaking changes 

Deprecate V1 with a communicated timeline.

-->

---
level: 2
---

# Example: API Controller Snippet

```php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
...
```


<!-- 

In practice, validate requests, return paginated resources, and use API Resources for consistent JSON shapes. 

Add policies and auth.
-->


---
layout: two-cols
---

# Recap Checklist

::left::

- [ ] Migrations & Seeders
- [ ] Environments & .env
- [ ] Database Connections
- [ ] Resourceful Controllers
- [ ] API Resource Controllers
- [ ] Routing & Versioning
- [ ] Artisan Commands
- [ ] Caching / Clearing
- [ ] Eloquent Tips

::right::

````md magic-move

```md
Migrations & Seeders

- Schema = migrations
- Data = seeders
- Factories for samples
- Idempotent seeding
- Separate structure/data
```

```md
Environments & .env

- .env not committed
- Use .env.example
- Use config() not env()
- .env.testing auto‑loaded
- Production: debug off
```

```md
Database Connections

- Multiple connections supported
- Model $connection override
- Model::on('connection')
- Avoid hardcoded creds
- Config caching matters
```

```md
Resourceful Controllers

- Web: 7 methods
- Views + sessions
- Route::resource()
- --resource scaffold
- Form‑based CRUD
```

```md
API Resource Controllers

- API: 5 methods
- JSON responses
- Stateless middleware
- Route::apiResource()
- Versioned namespaces
```

```md
Routing & Versioning

- Prefix api/v1
- Name api.v1.*
- Separate V1/V2
- Avoid route collisions
- Consistent structure
```

```md
Artisan Commands

- make:migration
- migrate / rollback
- make:seeder
- db:seed
- make:controller
```

```md
Caching / Clearing

- config:clear
- route:clear
- view:clear
- cache:clear
- optimize:clear
```

```md
Eloquent Tips

- Model::count()
- Model::on('conn')
- Raw via selectRaw
- Model $connection
- Query builder aware
```

````


---
level: 2
---

# Exit TicketS

> “What surprised you today?”

Reflect on one thing about Laravel’s migrations, controllers, or API structure that you didn’t expect.

Why do you think it works that way?


> “What still feels unclear?”

Describe one concept from today (e.g., environments, database connections, resource vs API controllers) that you want to understand better.

What would help you strengthen that understanding?


---

# Acknowledgements

- Fu, A. (2020). Slidev. Sli.dev. https://sli.dev/
- Font Awesome. (2026). Font Awesome. Fontawesome.com; Font Awesome. https://fontawesome.com/
- Mermaid Chart. (2026). Mermaid.ai. https://mermaid.ai/

> Slide template by Adrian Gould

<br>

> - Mermaid syntax used for some diagrams
> - Some content was co-generated with the assistance of Microsoft CoPilot
