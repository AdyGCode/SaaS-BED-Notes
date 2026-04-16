
## Laravel 12 API Testing: PEST, Postman, and HTTP Correctness

**Focus**
- PEST tests for APIs
- Postman collections for endpoints
- Status codes & headers correctness

<!-- Speaker notes:
Intro the toolbox: PEST for fast, fluent PHP tests in Laravel 12; Postman for manual/automated collections; and a reliability layer: correct HTTP status codes, headers (Content-Type, Cache-Control, ETag, Location, Authorization), and JSON shapes. Emphasize test-first where possible.
-->
---

## PEST Setup in Laravel 12

```bash
# Already present in new Laravel apps, but ensure:
composer require pestphp/pest --dev
php artisan test       # runs PEST by default in Laravel 12
```

**Structure**
```
tests/
  Feature/Api/
  Pest.php
```

**.env.testing**
```
APP_ENV=testing
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```

<!-- Speaker notes:
Laravel 12 ships with PEST-ready scaffolding. Keep API tests in tests/Feature/Api. Use an in-memory SQLite DB for speed and isolation. Run with `php artisan test`. Use factories and seeders for deterministic data.
-->
---

## Writing First PEST API Test (GET index)

```php
// tests/Feature/Api/CourseIndexTest.php
use function Pest\Laravel\getJson;
use App\Models\Course;

it('lists courses as JSON', function () {
    Course::factory()->count(3)->create();

    getJson('/api/v1/courses')
        ->assertOk()                    // 200
        ->assertHeader('content-type', 'application/json')
        ->assertJsonStructure([
            'data' => [
                ['id', 'code', 'title', 'credits']
            ],
            'links', 'meta'
        ]);
});
```

<!-- Speaker notes:
Use getJson/postJson/putJson/deleteJson. Assert status via ->assertOk(), ->assertCreated(), etc. Validate headers and JSON shape with assertHeader and assertJsonStructure. For paginated resources, check data/links/meta.
-->
---

## PEST Test: POST store (validation + 201)

```php
// tests/Feature/Api/CourseStoreTest.php
use function Pest\Laravel\postJson;

it('creates a course and returns 201', function () {
    $payload = [
        'code' => 'CPT101',
        'title' => 'Computing Fundamentals',
        'credits' => 3,
    ];

    postJson('/api/v1/courses', $payload)
        ->assertCreated()               // 201
        ->assertHeader('content-type', 'application/json')
        ->assertJsonPath('code', 'CPT101');
});

it('rejects invalid payload with 422', function () {
    postJson('/api/v1/courses', [])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['code', 'title', 'credits']);
});
```

<!-- Speaker notes:
Cover both happy-path and failure-path. Use assertCreated() for 201. For validation errors, expect 422 and assertJsonValidationErrors listing required fields.
-->
---

## PEST Test: Auth & Headers (Bearer)

```php
// tests/Feature/Api/CourseAuthTest.php
use App\Models\User;
use function Pest\Laravel\getJson;

it('requires auth header', function () {
    getJson('/api/v1/courses')
        ->assertUnauthorized();         // 401
});

it('returns data with valid token', function () {
    $user = User::factory()->create();
    $token = $user->createToken('api')->plainTextToken; // e.g., Sanctum

    getJson('/api/v1/courses', [
        'Authorization' => 'Bearer '.$token,
        'Accept' => 'application/json'
    ])->assertOk();
});
```

<!-- Speaker notes:
Demonstrate header-driven auth (Sanctum/Passport). 401 when missing/invalid token; 403 for forbidden if policy denies. Always send Accept: application/json for API tests.
-->
---

## PEST Test: ETags, Cache, and Pagination

```php
// tests/Feature/Api/CourseCachingTest.php
use function Pest\Laravel\getJson;

it('supports ETag conditional requests', function () {
    $first = getJson('/api/v1/courses')->assertOk();
    $etag = $first->headers->get('ETag');

    getJson('/api/v1/courses', ['If-None-Match' => $etag])
        ->assertStatus(304);            // Not Modified
});

it('returns proper pagination headers', function () {
    getJson('/api/v1/courses')
        ->assertOk()
        ->assertHeader('X-RateLimit-Remaining')
        ->assertJsonStructure(['links', 'meta']);
});
```

<!-- Speaker notes:
If your API implements ETags, test 304 flow. Laravel doesn’t add ETag by default; you can via middleware. Also assert rate-limit headers when using `throttle:api` middleware and JSON pagination meta.
-->
---

## Postman: Create a Collection (Basics)

1. **Create Collection** → *New > Collection* → "Laravel API V1".
2. **Auth**: Add collection-level `Authorization: Bearer {{token}}`.
3. **Variables**: `{{base_url}}`, `{{token}}` in *Variables* tab.
4. **Folders**: `Courses`, `Users`, etc.
5. **Environments**: *local*, *staging*, *prod* with base_url differences.

<!-- Speaker notes:
Keep reusable variables at the collection or environment level. Helps switch hosts and tokens quickly. Organize endpoints by resource. Prefer descriptive names and comments for team sharing.
-->
---

## Postman: Example Requests

**GET Courses**
```
GET {{base_url}}/api/v1/courses
Headers: Accept: application/json
```

**POST Course**
```
POST {{base_url}}/api/v1/courses
Headers: Accept: application/json; Authorization: Bearer {{token}}
Body (JSON): {"code":"CPT101","title":"Computing Fundamentals","credits":3}
```

**PUT Course**
```
PUT {{base_url}}/api/v1/courses/{{id}}
Headers: Accept: application/json; Authorization: Bearer {{token}}
Body (JSON): {"title":"Comp Fundamentals","credits":4}
```

<!-- Speaker notes:
Mirror your PEST tests in Postman. Keep Accept and Authorization headers consistent. Use path variables and saved examples for regression comparison.
-->
---

## Postman Tests Tab: Status & Headers

**Tests (JavaScript) example**
```js
pm.test('Status is 200', () => pm.response.to.have.status(200));
pm.test('JSON content-type', () => pm.response.to.have.header('content-type'));
pm.test('Has data array', () => {
  const json = pm.response.json();
  pm.expect(json).to.have.property('data');
});
```

**Save as example** for documentation.

<!-- Speaker notes:
Use the Tests tab to assert status codes, headers, and JSON shape. Save successful responses as Examples for reference docs. This complements server-side PEST tests.
-->
---

## Exporting & Automating Postman

**Export collection** → Share with team or CI.

**Run in CLI (Newman)**
```bash
npm i -g newman
newman run Laravel_API_V1.postman_collection.json \
  -e local.postman_environment.json \
  --reporters cli,junit --reporter-junit-export newman.xml
```

<!-- Speaker notes:
Automate Postman with Newman in CI to catch regressions. Export JUnit to integrate with CI test reports. Keep env files out of source control if they contain secrets.
-->
---

## Ensuring Correct Status Codes

- **200 OK**: Successful GET
- **201 Created**: Successful POST creating a resource
- **204 No Content**: Successful DELETE/PUT with no body
- **400/422**: Bad input / validation failure
- **401/403**: Unauthenticated / Unauthorized
- **404**: Not found

<!-- Speaker notes:
Choose codes by action semantics. 201 should include Location header (URL of new resource). 204 must have empty body. Prefer 422 for validation errors in APIs.
-->
---

## Ensuring Correct Headers

- `Content-Type: application/json`
- `Accept: application/json`
- `Authorization: Bearer <token>`
- `Cache-Control`, `ETag` (if caching)
- `Location` on 201
- `X-RateLimit-*` (if throttled)

<!-- Speaker notes:
APIs are contract-first: headers matter. On resource creation, return Location to canonical URL. If you implement caching, validate ETag/If-None-Match tests. Rate-limit headers help clients handle backoff.
-->
---

## Sample Controller Responses (Laravel 12)

```php
// store()
return response()->json($course, 201)
    ->header('Location', route('api.v1.courses.show', $course));

// destroy()
return response()->noContent(); // 204

// index() with pagination
return CourseResource::collection(Course::paginate(15))
    ->response()
    ->header('Cache-Control', 'no-store');
```

<!-- Speaker notes:
Use response helpers for explicit codes. Add Location on create. For resources, prefer API Resources for consistent shapes. Consider global middleware to set Cache-Control defaults for APIs.
-->
---

## Quick Workflow: Red–Green–Refactor

1. **Write PEST test** (red)
2. **Implement controller** (green)
3. **Add Postman tests**
4. **Check headers/codes**
5. **Refactor & commit**

<!-- Speaker notes:
Keep tight feedback loops: code → test → Postman verification. Commit small. Use CI to run both PHPUnit/PEST and Newman collections for defense-in-depth.
-->
---

## Recap Checklist (1–5 words)

**PEST**
- Use getJson/postJson
- Assert status codes
- Assert headers
- Validate JSON shape
- Test auth flows

**Postman**
- Collection variables
- Environment files
- Tests tab assertions
- Save examples
- Newman in CI

**HTTP Correctness**
- 200/201/204 usage
- 401 vs 403
- 404 for missing
- 422 validation errors
- Location on 201

**Headers**
- Content-Type JSON
- Accept JSON
- Authorization Bearer
- Cache-Control/ETag
- Rate-limit headers

<!-- Speaker notes:
Short, actionable reminders that map to the hands-on steps: write PEST first, mirror in Postman, and verify correct HTTP semantics.
-->
---

## Exit Journal Questions

1) **What will you change?**
- One improvement to your API testing flow (PEST, Postman, headers/codes) and why.

2) **Where is your blind spot?**
- One area (auth, validation, caching) you’ll explore next to increase API reliability.

<!-- Speaker notes:
Prompt students to internalize changes to their workflow and identify learning priorities. Encourage concrete next actions (e.g., add 201 Location header everywhere; set up Newman in CI).
-->
---
