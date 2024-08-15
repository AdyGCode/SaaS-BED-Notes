---
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
header: "![NMTAFE](../assets//Black-Red-Banner.svg)"
auto-scaling: true
size: 4k
color: "#ccc"
backgroundColor: "#060606"
tags:
- SaaS
- APIs
- Back-End
- Overview
date created: 03 July 2024
date modified: 08 July 2024
created: 2024-07-31T07:52
updated: 2024-08-09T09:06
---

# Securing APIs

Software as a Service - Back-End Development

Session 05

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

### Acknowledgement

This tutorial is based on [Laravel 10 REST API Authentication using Sanctum (vidvatek.com)](https://vidvatek.com/post/laravel-10-rest-api-authentication-using-sanctum).

---

# Creating an Authenticated API

For this tutorial we will start a fresh Laravel application. You may then apply the principles to your own code.

## Create new Laravel 11 Application

```shell
cd ~/Source/Repos
laravel new SaaS-Laravel-11-Sanctum-API
```

Respond to the questions with the following:

- Would you like to install a starter kit? `breeze`
- Which Breeze stack would you like to install? `api`
- Which testing framework do you prefer? `Pest`
- Would you like to initialise a Git repository? `yes`
- Which database will your application use? `SQLite`
- Would you like to run the default database migrations? `yes`

Change into the new project folder:

```shell
cd SaaS-Laravel-11-Sanctum-API/
```

Because we have selected the Breeze and API options, the Sanctum configuration and database migrations have been completed during this installation process.


## Configure Sanctum

Make sure that the `app\bootstrap\app.php` file contains the following lines:

```php
->withMiddleware(function (Middleware $middleware) {  
    $middleware->api(prepend: [  
        \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,  
    ]);
```

### Add HasApiTokens to the User Model

Edit the `app\Models\User.php` file and add the required `HasApiTokens` trait.

Before the `class User` line add:

```php
use Laravel\Sanctum\HasApiTokens;
```

In the `class` definition update the `use` line to read:

```php
use HasFactory, Notifiable, HasApiTokens;
```

This enables us to use tokens for verifying login status and whom  originated requests.

## Add Migration and Models

We will create a new products table migration:

```shell
php artisan make:migration create_products_table
```

Now edit the new `database\migrations\yyyy_mm_dd_hhmmss_create_products_table.php` file and add the following definitions:

| field name | type   | size | other    |
| ---------- | ------ | ---- | -------- |
| name       | string | 128  |          |
| detail     | text   |      | nullable |

## Create Route Tests

Create the Product Feature Test Pest test file:

```shell
php artisan make:test --pest ProductFeatureTest
```

Edit the `tests/Feature/ProductFeatureTest.php` file and add a new test, and ensure the database is reset between tests:

```php
  
use Illuminate\Foundation\Testing\RefreshDatabase;  
  
uses(RefreshDatabase::class);  
  
it('has products page')  
    ->get('/api/v1/products')  
    ->assertStatus(200);
```

Run the test to see the failures:

```shell
php artisan test
```

Result:

```text

   FAIL  Tests\Feature\ProductFeatureTest
  ⨯ it has products page                                                                                         0.16s
  ────────────────────────────────────────────────────────────────────────────────────────────────────────────────────
   FAILED  Tests\Feature\ProductFeatureTest > it has products page
  Expected response status code [200] but received 404.
Failed asserting that 404 is identical to 200.
```


## Create Routes

Edit the `routes\api.php` file and add the products route:

```php
  
Route::group(['prefix' => 'v1'], function () {  
    Route::apiResource('/products', ProductController::class);  
});
```

Run the tests again.... this time we get a different error:

```text
   FAIL  Tests\Feature\ProductFeatureTest
  ⨯ it has products page                                                                                         3.84s
  ────────────────────────────────────────────────────────────────────────────────────────────────────────────────────
   FAILED  Tests\Feature\ProductFeatureTest > it has products page
  Expected response status code [200] but received 500.
Failed asserting that 500 is identical to 200.

The following exception occurred during the last request:

ReflectionException: Class "ProductController" does not exist in C:\Users\5001775\Source\Repos\SaaS-Laravel-11-Sanctum-API\vendor\laravel\framework\src\Illuminate\Container\Container.php:938
```

We need to create our controllers...

## Create Base Controller

In a previous tutorial we created a class to deal with the responses... this time we will extend the Controller class to create a new "Base Controller" and in here create the responses we need.

```bash
php artisan make:controller BaseController
```

Now edit the controller...

First add a `sendResponse` method:

```php
<?php  
    /**  
     * success response method.
     *
	 * @return \Illuminate\Http\JsonResponse  
     */  
    public function sendResponse($result, $message): JsonResponse  
    {  
        $response = [  
            'success' => true,  
            'data' => $result,  
            'message' => $message,  
        ];  
  
        return response()->json($response, 200);  
    }  
```

Next add the `sendError` method:

```php
    /**  
     * return error response.
     *
	 * @return \Illuminate\Http\JsonResponse  
     */  
    public function sendError($error, $errorMessages = [], $code = 404): JsonResponse  
    {  
        $response = [  
            'success' => false,  
            'message' => $error,  
        ];  
  
        if (!empty($errorMessages)) {  
            $response['data'] = $errorMessages;  
        }  
  
        return response()->json($response, $code);  
    }  
}
```

## Create Products Controller

```shell
php artisan make:controller ProductController
```

> Remember that **ONLY** tables and routes use plurals.

## Run tests

```shell
php artisan test
```

We get...

```text

```

This is because we do not have the `ProductController` class included in the routes class, make sure to add this to the top of the file:

```php
use App\Http\Controllers\ProductController;
```

Running the test again... it will still fail, but it is ok...

```text
   FAIL  Tests\Feature\ProductFeatureTest
  ⨯ it has products page                                                                                         3.76s
  ────────────────────────────────────────────────────────────────────────────────────────────────────────────────────
   FAILED  Tests\Feature\ProductFeatureTest > it has products page
  Expected response status code [200] but received 500.
Failed asserting that 500 is identical to 200.

The following exception occurred during the last request:

Error: Call to undefined method App\Http\Controllers\ProductController::index() 
```

We haven't got our index method!


## Edit the Product Controller

Edit the Product controller to use the `BaseController` class...

```php

```

## Add Products Index method

We are now ready to 




## Create User Register Tests


## Create User Register Controller









## Postman Tests


### Create Collection


### Create Endpoint Requests

| API Name           | Verb   | URI                                     |
| ------------------ | ------ | --------------------------------------- |
| **Register**       | GET    | http://localhost:8000/api/register      |
| **Login**          | GET    | http://localhost:8000/api/login         |
| **Logout**         |        |                                         |
| **Product List**   | GET    | http://localhost:8000/api/products      |
| **Product Create** | POST   | http://localhost:8000/api/products      |
| **Product Show**   | GET    | http://localhost:8000/api/products/{id} |
| **Product Update** | PUT    | http://localhost:8000/api/products/{id} |
| **Product Delete** | DELETE | http://localhost:8000/api/products/{id} |

### Add header details to Postman


### Test Endpoint Requests

