---
theme: nmt
background: https://cover.sli.dev
title: Session 04 - Unit v Feature Tests
class: text-left
drawings:
  persist: false
transition: fade
mdc: true
duration: 35min
---

# Session 04: Unit v Feature Tests

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
level: 2
---

# Objectives

---
layout: two-cols
level: 2
---

# Objectives

::left::

- Use Laravel Docs to assist your learning and work.
- Explain **Unit vs Feature** tests and when to use each.
- Write minimal tests in **PHPUnit** and **Pest**.
- Test **Web** pages and **API** endpoints (JSON).

::right::

- Configure **SQLite** for dev & **in-memory** for tests.
- Shape JSON with **API Resources** and
- Hint at **JSON:API** & **Problem Details** for errors.


<!--
Notes:
- Laravel 12 ships with testing support for Pest & PHPUnit; 
- Feature/Unit directories exist by default. 
- https://laravel.com/docs/12.x/testing
-->


---
level: 2
---

# Contents 

<Toc minDepth="1" maxDepth="1" />

---
layout: section
---

# Warm up!

## Call the Exterminator!

Scenarios to classify as Bug, Feature, or “It depends”

---
level: 2
---

# Warm up! Call the Exterminator!

<br>

## 😂 Funny Scenario

<br>

The lecturer will read the scenario and ask for your answer.

Decide if the scenario contains a bug, a feature, or if it depends on the context.

<!--
Encourage discussion and debate.

Emphasize that the line between bug and feature can be blurry.

#### 😂 Funny Scenario - **Bug**
##### The API documentation says the endpoint accepts JSON, XML, YAML, and “good vibes.”

- Lighthearted start.
- Documentation mismatch is technically a bug.
- Great example for discussing unclear or playful documentation.

#### 😂 Funny Scenario #2 - **Bug**
##### An automated test occasionally fails… but only on Fridays after 3 PM.

- Introduce flaky tests.
- Time‑based failures often come from cron, timezones, or loads.
- Good way to ask students “Have you seen weird timing bugs?”

#### 😂 Funny Scenario #3 - **Feature**
##### The homepage hero image changes to a cat picture when the site is under high load.

- Talk about fallback assets and CDNs.
- Could be intentional as an “easter egg.”

#### 😂 Funny Scenario #4 - **Bug**
##### A “Submit” button briefly switches to Comic Sans during animations.

- UI rendering glitch likely from missing font or CSS fallback.

#### 😂 Funny Scenario #5 - **Feature**
##### The API rate‑limits users with the message: “Stop. Hydrate. Try again.”

- Humorous but acceptable; depends on tone guidelines in product design.

#### 😂 Funny Scenario #6 - **Bug**
##### Tests pass only when the lead developer is in the room.

- Great conversation starter about environment parity, privilege issues, caches, etc.

#### 😂 Funny Scenario #7 - **Bug**
##### Two‑factor codes are always sent to your mum.

- Use to discuss environment variable misconfiguration or credential mix‑ups.
-->

---
level: 2
---

# Warm up! Call the Exterminator!

<br>

## ⚙️ Serious Scenario

<br>

The lecturer will read the scenario and ask for your answer.

Decide if the scenario contains a bug, a feature, or if it depends on the context.

<!--
#### ⚙️ Serious Scenario #8 - **Bug**
##### The API returns `200 OK` even when an error occurs.

- HTTP semantics matter.
- Breaks error handling, monitoring, and logs.

#### ⚙️ Serious Scenario #9 - **Bug**
##### Unit tests mock external services using outdated schema definitions.

- Students should explore contract testing and schema drift.

#### ⚙️ Serious Scenario #10 - **Bug**
##### A feature test writes to the production database due to env misconfiguration.

- Use to highlight risks of poor CI/CD segregation.
- One of the biggest real‑world failures.

#### ⚙️ Serious Scenario #11 - **Feature**
##### Expired tokens are accepted for 10 extra minutes as a grace period.

- Discuss UX/security trade-offs.
- Many auth systems do this intentionally.

#### ⚙️ Serious Scenario #12 - **Bug (process issue)**
##### The test suite takes 40 minutes to run due to too many end-to-end tests.

- Great moment to talk about test pyramid, CI time, dev frustration.

#### ⚙️ Serious Scenario #13 - **Bug**
##### An endpoint accepts undocumented and deprecated fields.

- Leads to unpredictable integration behaviour.
- Encourage discussion around strict vs. lenient API designs.

#### ⚙️ Serious Scenario #14 - **Bug**
##### The UI silently truncates long input fields.

- Students should identify data loss risks.
- Introduce validation and UX expectations.

-->

---
level: 2
---

# Warm up! Call the Exterminator!

<br>

## 🤔 Thought-Provoking

<br>

The lecturer will read the scenario and ask for your answer.

Decide if the scenario contains a bug, a feature, or if it depends on the context.

<!--

#### 🤔 Thought-Provoking #15 - **Ambiguous**
##### Caching causes stale results for up to 30 seconds.

- Trade-off between performance and real-time accuracy.
- Great for exploring distributed system realities.

#### 🤔 Thought-Provoking #16 - **Feature**
##### Feature tests simulate network latency to mimic real-world conditions.

- Ask when simulation becomes too slow.
- Discuss realism vs. productivity.

#### 🤔 Thought-Provoking #17 - **Feature**
##### API requests automatically retry 3 times before throwing errors.

- Can hide deeper reliability issues.
- Opens discussion on idempotency.

#### 🤔 Thought-Provoking #18 - **Bug**
##### A unit test asserts an exact timestamp match, causing intermittent failures.

- Explore deterministic testing.
- Students should propose better assertions (± tolerances).

#### 🤔 Thought-Provoking #19 - **Ambiguous**
##### Lazy-loaded UI components cause slight layout shifts.

- Performance vs. UX.
- Great for modern frontend architecture discussions.

#### 🤔 Thought-Provoking #20 - **Ambiguous**
##### API responses return items in different orders under load.

- Distributed systems often do this naturally.
- Raises big questions: Should clients depend on order?
-->

---
level: 2
---

# 🎉 Wrapping-Up the Warm-Up...

<br>

## Bug? Feature? Or… “It depends.”

<br>

Let the debates begin!

<!--
- Invite students to argue cases.
- Highlight how context shapes interpretation.

-->

---
layout: section
---

# Unit Tests

 <!-- 
Definition first, no code yet. 

Emphasis: isolation, speed, and the fact the framework may not fully boot. 

-->

---
level: 2
---

# What is a **Unit Test**?

A **Unit Test**:
- checks a *small, isolated* piece of code
- e.g. helper function or a single class method

## Key Points

- Typically **does not** touch the database
- Often **does not** boot the full Laravel application
- Runs **very fast** and is ideal for pure logic and refactoring safety

<!-- 
Clarify that while you can technically boot the framework, 
the goal is to test pure behaviour without 
I/O for speed and determinism. 
-->

---
level: 2
layout: two-cols
---

# When to use Unit Tests?

::left::

### **Helper utilities** 

Part of a "helper" class

- e.g. Laravel's Str class 

<br>

### **Model methods** 

Pure methods

- e.g., computed name formatting

<br>

::right::

### **Domain rules** 

Do not depend on external systems.

- e.g. databases, file systems, et al.

<br>

### **Refactoring guardrails** 

Safety net that immediately tells you: 

- “Hey! That change broke a rule!”

<br>

<!-- 
Domain rules refer to the core business logic of your application.

They define:

- how the business works, 
- what is allowed, and 
- what must be true for the system to behave correctly.

External systems - e.g. Databases, Filesystems, HTTP requests/responses, Network services, Framework features (middleware, routing, DI container, etc.)

-->

---
level: 2
---

# Unit Test Examples - Helper

## Helper Class: `PhoneHelper`

**File:** `app/Helpers/PhoneHelper.php`

````md magic-move

```php {all}
namespace App\Helpers;

class PhoneHelper
{
    // Helper methods go here...
}
```

```php {1-2,12|3-5|6-9|all}
class PhoneHelper
{
    /**
     * Remove all non-digits. E.g. "+61 (08) 9123-4567" -> "610891234567".
     */
    public static function normalize(string $phone): string
    {
        return preg_replace('/\D+/', '', $phone);
    }
    
    // isAustralian() will be added next step

```

```php {1|3-5|6-10|all}
// code from previous step...

    /**
     * Basic AU detection: does the normalized number start with country code 61?
     */
    public static function isAustralian(string $phone): bool
    {
        $digits = self::normalize($phone);
        return str_starts_with($digits, '61');
    }
    
    // More helper methods could go here...
}
```


````


---
level: 2
---

# Unit Test Examples - Helper

## **Unit tests (Pest):**

**File:** `tests/Unit/PhoneHelperTest.php`

```php {none|1|3-6|8-11|all}
use App\Helpers\PhoneHelper;

it('normalizes phone numbers', function () {
    expect(PhoneHelper::normalize('+61 400-123-456'))
        ->toBe('61400123456');
});

it('detects AU numbers', function () {
    expect(PhoneHelper::isAustralian('+61 412 555 666'))
        ->toBeTrue();
});
```

<!-- 
Now we move to concrete examples. Start with a standalone helper class to show totally isolated testing. 

Fully isolated: no framework, no DB. Runs lightning fast. Pest provides expressive expectations while using PHPUnit under the hood. citeturn1search24 
-->

---
level: 2
---

# Unit Test Examples - Model

## Model Method: `Contact::formattedName()`

**File:** `app/Models/Contact.php`

```php {1|3|5-6,13|7|9-12|all}
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'email'];

    public function formattedName(): string
    {
        return ucwords(strtolower($this->name));
    }
}
```

---
level: 2
---

# Unit Test Examples - Model

## **Unit test (PHPUnit):** 

**File:** `tests/Unit/ContactModelTest.php`

```php {1|3-4|6-7,13|8-9,12|8-12|all}
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Contact;

class ContactModelTest extends TestCase
{
    public function test_formatted_name(): void
    {
        $c = new Contact(['name' => 'jane DOE']);
        $this->assertSame('Jane Doe', $c->formattedName());
    }
}
```

<!-- 
Although this test extends Laravel TestCase, the method under test is pure and doesn’t hit DB, so it still behaves like a unit.
Laravel’s PHPUnit base is compatible with Pest; Pest can co-exist.

-->

---
layout: section
---

# Feature Tests

<!-- 
Now we define Feature Tests before any code. 
-->


---
level: 2
---

# Section 2 — Feature Tests

## What is a **Feature Test**?

Feature Tests verify how **multiple parts** of the application work 
together.

For example:
-   routing, controllers, middleware, validation, database, views or JSON responses.

They...
- Use **HTTP test helpers** like `get()`, `postJson()`
- Execute requests **without a real server** (internally simulated)
- Assert status codes, headers, views, and JSON structures

<!-- 
Key message: Feature tests simulate real user or client interactions across the stack. 
-->

---
level: 2
layout: two-cols
---

# Section 2 — Feature Tests

## When to use Feature Tests

::left::

## **Web pages** 

- 'views' & forms, 
- redirects, 
- auth flows

<br>

## **API endpoints**

- CRUD / BREAD
- validation, 
- authorization

<br>


::right::

## **Database interactions**

- creation, 
- updates, 
- deletes

<br>

## **HTTP behaviour**

- headers, 
- content negotiation, 
- JSON format

<br>


<!-- 
This is where we validate integration and behaviour, not just isolated logic. 
-->

---
level: 2
---

# Feature Tests - Web

## Test Homepage Loads

**File** `routes/web.php`

```php
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
```


---
level: 2
---

# Feature Tests - Web

## Homepage loads (via PHPUnit)

**File:** `tests/Feature/Web/HomepageTest.php`

```php {1-3|5-6,13|7-8,12|7-12|all}
namespace Tests\Feature\Web;

use Tests\TestCase;

class HomepageTest extends TestCase
{
    public function test_homepage_loads(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('get started');
    }
}
```

---
level: 2
---

# Feature Tests - Web
## Homepage loads (via Pest)

```php {1,7|2|4|4-5|6-7|all}
it('loads the homepage', function () {
    $response = $this->get('/');
    
    $response->assertOk()
        ->assertSee('get started');
    // You may extend by checking for known content on the page, 
    // e.g. a heading or welcome message.
});
```


<!-- 
HTTP tests are fluent and expressive: `assertOk`, `assertSee`, `assertRedirect`, etc.
Internally simulated – no external web server is needed. citeturn1search31 
-->

---
level: 2
---

# Feature Test Example - API

## API: Create & List Contacts (Pest)

Three parts to this:
- Route
- Controller method
- Feature tests

<!-- 
Now API tests using JSON helpers, DB via RefreshDatabase, and API Resources formatting checks. 
-->

---
level: 2
---

# Feature Test Example - API

## API: Create & List Contacts (Pest)

### Routes

**File:** `routes/api.php`

```php {none|1-2|4|all}
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ContactController;

Route::apiResource('contacts', ContactController::class);
```
---
level: 2
---

# Feature Test Example - API

## API: Create & List Contacts (Pest)

### Controller Method(s)
- Part of the complete controller class

**File:** `app/Http/Controllers/API/ContactController.php`

```php {1-2,11|3-6|8-10|all}
public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:contacts,email',
    ]);

    return ContactResource::make(Contact::create($data))
        ->response()
        ->setStatusCode(201);
}
```

---
level: 2
---


# Feature Test Example - API

## API: Create & List Contacts (Pest)

**File:** `tests/Feature/API/ContactApiTest.php`

````md magic-move

```php {1-2|4|6,14|6-7,14|6-11,14|6,13,14|all}
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a contact via API', function () {
    $payload = ['name' => 'Mary Jones', 'email' => 'mary@example.com'];

    $this->postJson('/api/contacts', $payload)
        ->assertCreated()
        ->assertJsonPath('data.attributes.name', 'Mary Jones');

    expect(Contact::whereEmail('mary@example.com')->exists())->toBeTrue();
});

// more tests to come
```

```php {1-4|6,12|6-7,12|6,9-11,12|all}
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

// Previous code here

it('lists contacts with pagination meta', function () {
    Contact::factory()->count(2)->create();

    $this->getJson('/api/contacts')
        ->assertOk()
        ->assertJsonStructure(['data', 'links', 'meta']);
});
```

````
<!-- 
Use JSON helpers `getJson`, `postJson`; assertions for structure and paths.
Pagination auto-includes `links` and `meta` when using Laravel paginator with resources. citeturn1search31turn1search10 
-->

---
level: 2
---

# Feature Test Example - API

## API: Validation & Problem Details (RFC 9457 hint)

- Standards-based error body.
- Use `application/problem+json`

```php {none|1|1-2,7|1-7|8|all}
return response()
    ->json([
        'type' => url('/probs/validation'),
        'title' => 'Validation failed',
        'status' => 422,
        'detail' => 'Email is required and must be unique',
    ], 422)
    ->header('Content-Type','application/problem+json');
```

**Why**: Machine-readable, standardised error shape per **Problem Details** specification (RFC 9457, superseding RFC 7807). citeturn1search63turn1search59

<!-- 
Laravel returns 422 with default error JSON. 

Showing Problem Details hints how to standardise errors for clients. 
-->

---
level: 2
---

# Feature Test Example - API

## API: Authorisation (403) example

```php {none|all}
// Policy gate check inside controller
$this->authorize('create', Contact::class);
```

**Feature test (Pest):**
```php {none|1,4|2-3|all}
it('blocks unauthorised creation', function () {
    $this->postJson('/api/contacts', ['name' => 'X', 'email' => 'x@x'])
        ->assertForbidden();
});
```

<!-- 
Focus is testing behaviour (403) not implementation details. 

Add policies as needed. 
-->

---
layout: section
---

# Activities & Challenges

---
level: 2
---

# Activity + Challenges

## Base: 

Write a feature test for GET /api/students that asserts pagination 
meta is present.

## Challenge A:

Add CoursePolicy and test that unauthorized POST /api/courses returns 403 with Problem Details.

## Challenge B: 

Implement a JSON:API-like envelope for students and update 
tests accordingly.

## Reflect: 

When is a unit test enough vs when do you need a feature test?

---
layout: section
---

# Recap Checklist

---
level: 2
---

# Recap Checklist

- [ ] Explain Unit vs Feature trade-offs (speed vs realism) [sli.dev]
- [ ] Pest installed & working (Laravel plugin) [github.com]
- [ ] API Resources shape clean JSON (+links/meta) [laravel.com]
- [ ] Feature tests cover endpoints (201/200/404/422/204) [laravel.com]
- [ ] Unit tests protect core rules (no framework boot) [sli.dev]
- [ ] SQLite config + Postman collection ready [jsonapi.org], [laravel.com]

---
level: 2
---

# Exit Ticket

> Pose a question about the content

---
layout: section
---

# Acknowledgements / References
---
level: 2
---

# Acknowledgements / References



## References 


- API Coach. (2026). *RFC 9457 problem details for HTTP APIs*. https://apicoach.io/wiki/http-fundamentals/problem-details/  
- Bergmann, S. (2026). *PHPUnit manual: Version 12.5*. https://docs.phpunit.de/en/12.5/index.html  
- Brown, S., Timoney, J., Lysaght, T., & Ye, D. (2011). *Software testing: Principles and practice*. China Machine Press. http://www.softwaretestingbook.org/ed1/SWTPP-Edition1-online.pdf  
- Dhandala, N. (2026). *How to build API problem details*. OneUptime. https://oneuptime.com/blog/post/2026-01-30-api-problem-details/view  

---
level: 2
---

## References 2

- GeeksforGeeks. (2025). *Unit testing best practices*. https://www.geeksforgeeks.org/blogs/unit-testing-best-practices/  
- IBM. (2026). *Unit testing best practices*. https://www.ibm.com/think/insights/unit-testing-best-practices  
- JSON:API. (2026). *JSON:API specification*. https://jsonapi.org/
- Jain, J. (2022). *Learn API testing: Norms, practices, and guidelines for building effective test automation*. Springer. https://link.springer.com/book/10.1007/978-1-4842-8142-0  
- Kilcommins, F. (2024). *Problem details (RFC 9457): Getting hands‑on with API error handling*. Swagger. https://swagger.io/blog/problem-details-rfc9457-api-error-handling/  


---
level: 2
---

## References 3

- Laragon. (2026). *Laragon documentation*. https://laragon.org/docs  
- Laravel. (2026). *Database: Getting started*. https://laravel.com/docs/12.
x/database
- Laravel. (2026). *Eloquent API resources*. https://laravel.com/docs/12.
x/eloquent-resources
- Laravel. (2026). *HTTP tests*. https://laravel.com/docs/12.x/http-tests  
- Laravel. (2026). *Testing: Getting started*. https://laravel.com/docs/12.
x/testing  


---
level: 2
---

## References 4


- Microsoft Azure Architecture Center. (2026). *API design: Best practices*. https://learn.microsoft.com/en-us/azure/architecture/best-practices/api-design
- Microsoft. (2025). *Unit testing best practices for .NET*. https://learn.microsoft.com/en-us/dotnet/core/testing/unit-testing-best-practices  
- Mujtaba, G. (2024). *Introduction to Pest: A PHP testing framework*. DEV Community. https://dev.to/ghulam_mujtaba_247/introduction-to-pest-a-php-testing-framework-39ea  
- Nottingham, M., Wilde, E., & Dalal, S. (2023). *RFC 9457: Problem details for HTTP APIs*. Internet Engineering Task Force. https://www.ietf.org/rfc/rfc9457.pdf  

---
level: 2
---

## References 5

- PestPHP. (2026). *Pest: An elegant PHP testing framework*. https://pestphp.com/  
- Postman. (2026). *Postman API client*. https://www.postman.com/product/api-client/  
- SQLite Project. (2026). *SQLite documentation: In‑memory databases*. https://www.sqlite.org/inmemorydb.html  
- Vonage Developer. (2025). *Control your legacy refactor with PEST architecture testing*. https://developer.vonage.com/en/blog/control-your-legacy-refactor-with-pest-architecture-testing  

> - Some content was generated with the assistance of Microsoft CoPilot
