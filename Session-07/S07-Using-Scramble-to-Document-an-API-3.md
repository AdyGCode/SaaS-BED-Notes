---
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
banner: "![[Black-Red-Banner.svg]]"
banner_x: 1
banner_y: "0"
auto-scaling: true
size: 1920x1080
color: "#ccc"
backgroundColor: "#060606"
tags:
  - SaaS
  - APIs
  - Back-End
  - Journal
created: 2024-07-31T07:52
updated: 2025-03-27T18:46
---

# Session 07 Using Scramble to Document an API Part 3

## Software as a Service - Back-End Development

Developed by Adrian Gould

---

```table-of-contents
title: # Contents
style: nestedList
minLevel: 0
maxLevel: 3
includeLinks: true
```

---

# Session 07 Scramble Part 3

To date we have been creating an API using Scramble to document the API.

In this set of notes we are extending this to include Testing via PEST testing.

## Configuration

Before you continue, you **must** do some configuration for testing to work.

If you **DO NOT** configure the testing correctly, then the tests are run on the LIVE database. Not a good diea.

Firstly we either configure PHPUnit.xml **or** we create a `.env.testing` file.


### Option 1: PhpUnit.xml

Locate and open the PhpUnit.xml file.

Find the following two lines and uncomment them...

```xml
<!-- <env name="DB_CONNECTION" value="sqlite"/> -->
<!-- <env name="DB_DATABASE" value=":memory:"/> -->
```

so they become:

```xml
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

_Alternatively..._

### Option 2: Create `.env.testing`

Duplicate the `.env` making the new copy `.env.testing`

Update the new file so that you make the database use SQLite as in-`:memory:` database.

```ini

DB_CONNECTION=sqlite 
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=:memory: 
DB_USERNAME=root
DB_PASSWORD=
```



### test/Pest.php

Edit the `test/Pest.php` file and update so it reads:

```php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

pest()
    ->extend(TestCase::class)
    ->extend(RefreshDatabase::class)
    ->in('Feature');
```

This change will clean the database and re-run any migrations every time a test is executed.




## Testing all Routes

Original version: https://magecomp.com/blog/test-all-routes-in-laravel-with-pest/

Our first test will be to create a Route Test that tests all routes.

```shell
php artisan make:test RouteTest --pest
```

Edit this test and add:

```php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\TestResponse;

it('has a working response for all routes', function () {
    // Retrieve all routes
    $routes = collect(Route::getRoutes())->map(function ($route) {
        return [
            'uri' => $route->uri(),
            'methods' => $route->methods(),
        ];
    });

    // Iterate over each route
    foreach ($routes as $route) {
        foreach ($route['methods'] as $method) {
            $response = $this->call($method, $route['uri']);
            
            // Check if the response is successful
            $response->assertStatus(200);
        }
    }
});

```

## Source Code

You may find the source code for this demonstration API here:

https://github.com/AdyGCode/SaaS-L12-API-Scramble-Demoi


# Additional Learning

See [S07-Exercises-and-Additional-Learning](../Session-07/S07-Exercises-and-Additional-Learning.md).

# References

- Albano, J. (2019, October 25). _Baeldung_.
  Baeldung. https://www.baeldung.com/rest-api-error-handling-best-practices
- Bello, G. (2024, February 8). _Best Practices for API Error Handling | Postman Blog_. Postman
  Blog. https://blog.postman.com/best-practices-for-api-error-handling/
- _Getting started - Scramble_. (2025).
  Dedoc.co. https://scramble.dedoc.co/usage/getting-started
- Gitlin, J. (2024, June 12). _API response codes: examples and error-handling strategies_.
  Merge.dev; Merge. https://www.merge.dev/blog/api-response-codes
- Gupta, L. (2018, May 30). _HTTP Status Codes_. REST API
  Tutorial. https://restfulapi.net/http-status-codes/
- Korop, P. (2019). _Laravel API Errors and Exceptions: How to Return Responses_. Laravel
  Daily. https://laraveldaily.com/post/laravel-api-errors-and-exceptions-how-to-return-responses
- Ploesser, K. (2022, July 8). _10 Error Status Codes When Building APIs For The First Time And
  How To Fix Them_. 10 Error Status Codes When Building APIs for the First Time and How to Fix
  Them | Moesif
  Blog. https://www.moesif.com/blog/technical/monitoring/10-Error-Status-Codes-When-Building-APIs-For-The-First-Time-And-How-To-Fix-Them/
- The Postman Team. (2023, September 20). _What Are HTTP Status Codes? | Postman Blog_. Postman
  Blog. https://blog.postman.com/what-are-http-status-codes/
- Umbraco. (2019, May 3). _What are HTTP status codes?_ Umbraco.com;
  Umbraco. https://umbraco.com/knowledge-base/http-status-codes/



- https://www.binaryboxtuts.com/php-tutorials/laravel-tutorials/how-to-make-laravel-12-rest-api/
- https://medium.com/@dev.muhammadazeem/building-a-restful-api-with-laravel-a-step-by-step-guide-d9ae6dca9873
- https://medium.com/@andreelm/laravel-api-documentation-with-scramble-best-practices-and-tutorial-317950599982
- https://laravel-news.com/scramble-laravel-api-docs

---

# Found a Problem?

If you spotted any problems (including missing details) in notes or other materials, then make
sure you note that, and as a big help to your lecturer, you could fork the notes repository,
create an issue, create a fix to the issue, and submit a pull request.



---

# END
