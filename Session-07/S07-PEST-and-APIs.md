---
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
header: "![NMTAFE](../assets//Black-Red-Banner.svg)"
auto-scaling: true
size: 1920x1080
color: "#ccc"
backgroundColor: "#060606"
tags:
  - SaaS
  - APIs
  - Back-End
  - Overview
date created: 03 July 2024
date modified: 08 July 2024
created: 2024-09-05T13:45:23 (UTC +08:00)
source: https://abu-sayed.medium.com/laravel-testing-with-pest-the-complete-guide-for-beginners-a0b6680cfd71
author: Abu Sayed
---

# Laravel Testing with Pest: The Complete Guide for Beginners

by Abu Sayed | Medium


**Learn the basics and advanced techniques for testing your Laravel applications with Pest. This in-depth guide covers writing tests, mocking, factories, custom assertions, and more.**


Testing is an essential part of developing applications in Laravel. It helps ensure that new features work as expected and prevents bugs from being introduced into existing code.

One of the most popular testing frameworks for Laravel is **Pest**. Pest provides a expressive, readable syntax for writing tests. In this post, we’ll cover the basics of testing with Pest and explore some more advanced techniques.

## Getting Started with Pest

Pest is included with Laravel out of the box. To enable it, just run:

```php
php artisan pest:install
```

This will configure PHPUnit for Pest and create an example test in `tests/Feature/ExampleTest.php`.

## Writing Basic Tests

Pest tests are written as methods in test classes. For example:

```php
public function test_basic_example()
{
	$this->get('/')
       ->assertStatus(200);
}
```

The `$this` variable allows accessing Pest assertions like `assertStatus()`. Some common assertions include:

-   `assertStatus($code)` 
	- Assert response status code
-   `assertSee($text)` 
	- Assert text is present in response
-   `assertDatabaseHas($table, array $data)` 
	- Assert database has record

Pest also provides helpers like `get()`, `post()`, `put()`, etc to make requests into your app.

## Testing Responses

Pest makes it simple to test your application’s responses. For example, to test that a route returns a successful response:

```php
public function test_homepage_loads() {
  $response = $this->get('/');

  $response->assertStatus(200);
}
```

You can also assert that content is present:

```php
$response->assertSee('Welcome');
```

And easily inspect other aspects of the response:

```php

$response->assertHeader('Location', '/login');

// Assert JSON response content 
$response->assertJson([
  'name' => 'Steve'
]);
```

## Testing Database

Pest provides several assertions for testing database interactions.

For example, you can easily assert that a record now exists:

```php
public function test_user_can_register() {
  // Make request to register
  $response = $this->post('/register', [
    'name' => 'Steve'
  ]);  
  
  // Assert record was inserted into database
  $this->assertDatabaseHas('users', [
    'name' => 'Steve'
  ]);}
```

Or assert a record does not exist:

```php
$this->assertDatabaseMissing('users', [
  'name' => 'Steve'
]);
```

There are also assertions for counting records, asserting exists, etc.

## Testing Authentication

Pest provides helpers for testing authentication in your application.

For example, you can easily sign in as a user in a test:

```php
public function test_user_profile() {
	// Sign in as user
    $this->actingAs(User::factory()->create());  
    
    // Make request to profile
	$response = $this->get('/profile');
  
	// Assert successful response
	$response->assertOk();}
```

Or test authorization rules:

```php
public function test_admin_page_requires_auth() {
  // Try to hit admin page anonymously
  $response = $this->get('/admin');  
  // Assert redirect to login
  $response->assertRedirect('/login');}
```

## Mocking

Pest allows mocking classes while testing. This allows you to isolate classes and test them independently.

For example, here is mocking a service class while testing a controller:

```php
public function test_send_welcome_email() {
  // Mock email service
  Mail::shouldReceive('send')
       ->once()
       ->withArgs(['welcome', 'john@example.com']);  
       
	// Hit /register endpoint 
	$response = $this->post('/register', [
	    'email' => 'john@example.com' 
	]);  
  
  // Assert email service was called
  Mail::assertSent(function (Mailable $mailable) {
      
      // Assertions

  });
}
```

This allows you to test the controller logic without actually sending an email.

## Factories

Pest includes Laravel’s model factories to easily generate test data.

For example:

```php
public function test_display_post() {
  // Create a post
  $post = Post::factory()->create(); 
  
  // Hit route to display post
  $response = $this->get('/posts/'.$post->id);  
  // Assert post is shown
  $response->assertSee($post->title);}
```

The factories will automatically persist the model to the database for you.

## Advanced Setup

Here are some more advanced testing techniques and setup in Pest.

## **Data Providers**

Data providers allow testing a method with multiple sets of data:

```php
public function test_addition($a, $b, $expected)
{
  $this->assertEquals($expected, $a + $b);
}

public function additionProvider()
{
  return [
    [1, 1, 2],
    [5, 2, 7],
    [-3, -3, -6],
  ];
}
```

## **Hooks**

Hooks allow setup and teardown logic to be applied across test cases:

```php
public function setUp(): void
{
  
}
```

```php
public function tearDown(): void  
{
  // Executed after each test 
}
```

## **Helpers**

Pest includes a `Helper` trait with useful assertion methods:

```php
use Tests\Helpers;


public function test_admin_is_created() 
{
  $admin = makeAdminUser();  $this->assertTrue($admin->isAdmin()); // Helper assertion
  // ...
}
```

## **Custom Assertions**

You can write custom assertions by extending Pest’s `Assert` class:

```php
use Pest\Assert;

Assert::extend('hasSession', function ($name) {
  return $this->assertTrue(session()->has($name)); 
});

public function test_session()
{
  // Custom assertion
  $this->hasSession('cart');
}
```

## Conclusion

This covers the basics of testing your Laravel application with Pest! The main benefits of Pest include:

-   Simple, expressive syntax
-   Easy mocking and authentication helpers
-   Database and response assertions
-   Model factories for generating test data

Pest makes writing comprehensive tests for your Laravel app painless. Give it a try on your next project!
