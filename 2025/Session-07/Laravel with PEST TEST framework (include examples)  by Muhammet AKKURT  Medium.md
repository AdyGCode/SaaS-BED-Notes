---
created: 2025-09-02T10:18:59 (UTC +08:00)
tags: []
source: https://muhammetakkurt.medium.com/laravel-with-pest-test-framework-include-examples-c78d7bd29cf0
author: Muhammet AKKURT
---

# Laravel with PEST TEST framework (include examples) | by Muhammet AKKURT | Medium

> ## Excerpt
> Hello everyone, hope so everything is fine. Today I’d like to talk about test cases in Laravel but not the PHPUnit test. Today’s topic is pest. Of course, the developer who has mastered the project…

---
[

![Muhammet AKKURT](Laravel%20with%20PEST%20TEST%20framework%20(include%20examples)%20%20by%20Muhammet%20AKKURT%20%20Medium/0cOL5roZkIPibbN2c.jpeg)



](https://muhammetakkurt.medium.com/?source=post_page---byline--c78d7bd29cf0---------------------------------------)

Hello everyone, hope so everything is fine. Today I’d like to talk about test cases in Laravel but not the PHPUnit test. Today’s topic is pest.

![](Laravel%20with%20PEST%20TEST%20framework%20(include%20examples)%20%20by%20Muhammet%20AKKURT%20%20Medium/1Ml3Md78II7xhptqlkIKj2g.gif)

> Pest is a Testing Framework with a focus on simplicity. It was carefully crafted to bring the joy of testing to PHP.

## Why does TEST important?

Of course, the developer who has **_mastered_** the project may not write buggy code. During the pandemic period, many new developers from other sectors are now _trying_ to write code. But, tests are usually a nice way to get around the buggy situation.

Errors or unexpected situations can always happen.

**_Everyone_** can make mistakes. From time to time, new developers will appear and sometimes **_experienced_** developers will not want to change their minds about new technologies.

Anyway, we can say that tests can be used to **_verify_** if our _API endpoints, JSON responses_ (from database to client), and our functions are working **correctly** or **not**.

So, we may write many reasons or benefits…

## Example:

**Question;** There should be an API with login progress, how we should write login progress with tests?

Let’s create a new project which is running with sanctum.

## **Installation**

```
<span id="2b5d" data-selectable-paragraph="">composer create-project laravel/laravel laravel-pest-example<br>composer require laravel/sanctum<br>composer require pestphp/pest-plugin-laravel --dev<br>php artisan pest:install</span>
```

Then, I’ve removed tests/Feature and tests/Unit folders which almost exist in Laravel, because these are PHPUnit classes. We wanted to create new pest classes.

```
<span id="e69d" data-selectable-paragraph="">php artisan make:<span>test</span> Auth/AuthTest --pest</span>
```

It has created a new file like that which has also an example.

> **“ — unit”** property creates Unit test. If we don’t use this, it will have created a Feature test file.
> 
> **“ — pest”** property creates Pest test file that has functions file.

```
<span id="c12f" data-selectable-paragraph=""><span>&lt;?php</span><br><br><br><span>test</span>(<span>'example'</span>, function () {<br>    <span>$response</span> = <span>$this</span>-&gt;<span>get</span>(<span>'/'</span>);<br>    <span>$response</span>-&gt;<span>assertStatus</span>(<span>200</span>);<br>});</span>
```

I also want to create a new Unit test file

```
<span id="ebdc" data-selectable-paragraph="">php artisan make:<span>test</span> Auth/AuthTest --pest --unit</span>
```

This file includes a comparison, different from than feature test.

```
<span id="08f1" data-selectable-paragraph=""><span>&lt;?php</span><br><br><br><span>test</span>(<span>'example'</span>, function () {<br>    <span>expect</span>(<span>true</span>)-&gt;<span>toBeTrue</span>();<br>});</span>
```

So, we can run our tests 😊

```
<span id="dc54" data-selectable-paragraph="">./vendor/bin/pest<br>or<br>php artisan <span>test</span></span>
```

Press enter or click to view image in full size

![](Laravel%20with%20PEST%20TEST%20framework%20(include%20examples)%20%20by%20Muhammet%20AKKURT%20%20Medium/1CdqzNrP0_w8lKM6nsfJcQw.png)

No tests executed?? But we created two tests, **where are they??**  
Because we couldn’t prepare _/phpunit.xml_ file for working on which folders and which files are testable.

```
<span id="0b25" data-selectable-paragraph=""><span>&lt;<span>testsuites</span>&gt;</span><br>        <span>&lt;<span>testsuite</span> <span>name</span>=<span>"Unit"</span>&gt;</span><br>            <span>&lt;<span>directory</span> <span>suffix</span>=<span>"Test.php"</span>&gt;</span>./tests/Unit<span>&lt;/<span>directory</span>&gt;</span><br>        <span>&lt;/<span>testsuite</span>&gt;</span><br>        <span>&lt;<span>testsuite</span> <span>name</span>=<span>"Feature"</span>&gt;</span><br>            <span>&lt;<span>directory</span> <span>suffix</span>=<span>"Test.php"</span>&gt;</span>./tests/Feature<span>&lt;/<span>directory</span>&gt;</span><br>        <span>&lt;/<span>testsuite</span>&gt;</span><br><span>&lt;/<span>testsuites</span>&gt;</span></span>
```

If we are using both test packages like Pest and PHPUnit, we can separate with suffix property while creating new test files. Currently, I’m using only Pest, so I named “Test.php” like _Auth/User_**_Test.php_**. The run command will have run the test functions which have **_“Test.php”_** in their filename.

Press enter or click to view image in full size

![](Laravel%20with%20PEST%20TEST%20framework%20(include%20examples)%20%20by%20Muhammet%20AKKURT%20%20Medium/1DGAjgmQld81bwFwFqiHjwg.png)

Yes! Our tests **_work_**!

## Get Muhammet AKKURT’s stories in your inbox

Join Medium for free to get updates from this writer.

I’m going to add a few Users to our Seeder file for our tests…

```
<span id="c3e3" data-selectable-paragraph="">php artisan make:seed UserSeeder</span>
```

It should be like this.

```
<span id="daa8" data-selectable-paragraph=""><span>&lt;?php</span><br><br><span>namespace</span> <span>Database</span>\<span>Seeders</span>;<br><br><span>use</span> <span>App</span>\<span>Models</span>\<span>User</span>;<br><span>use</span> <span>Illuminate</span>\<span>Database</span>\<span>Seeder</span>;<br><br><span><span>class</span> <span>UserSeeder</span> <span>extends</span> <span>Seeder</span><br></span>{<br>    <span>public</span> <span><span>function</span> <span>run</span>()<br>    </span>{<br>        <span>User</span>::<span>factory</span>()-&gt;<span>create</span>([<br>            <span>'name'</span> =&gt; <span>'Muhammet AKKURT'</span>,<br>            <span>'email'</span> =&gt; <span>'m_akkurt@live.com'</span>,<br>        ]);<br>        <br>        <span>User</span>::<span>factory</span>(<span>10</span>)-&gt;<span>create</span>();<br>    }<br>}</span>
```

We should add this class to our DatabaseSeeder file.

```
<span id="c557" data-selectable-paragraph=""><span>&lt;?php</span><br><br><span>namespace</span> <span>Database</span>\<span>Seeders</span>;<br><br><span>use</span> <span>Illuminate</span>\<span>Database</span>\<span>Seeder</span>;<br><br><span><span>class</span> <span>DatabaseSeeder</span> <span>extends</span> <span>Seeder</span><br></span>{<br>    <span>public</span> <span><span>function</span> <span>run</span>()<br>    </span>{<br>        <span>$this</span>-&gt;<span>call</span>([<br>            <span>UserSeeder</span>::<span>class</span>,<br>        ]);<br>    }<br>}</span>
```

Firstly, we should restart our migrations and seeds when beginning to run our tests because the tests should run with _a clean database_.

```
<span id="9ced" data-selectable-paragraph=""><span>&lt;?php</span><br><br><span>namespace</span> <span>Tests</span>;<br><br><span>use</span> <span>Illuminate</span>\<span>Foundation</span>\<span>Testing</span>\<span>TestCase</span> <span>as</span> <span>BaseTestCase</span>;<br><span>use</span> <span>Illuminate</span>\<span>Support</span>\<span>Facades</span>\<span>Artisan</span>;<br><br><span>abstract</span> <span><span>class</span> <span>TestCase</span> <span>extends</span> <span>BaseTestCase</span><br></span>{<br>    <span>use</span> <span>CreatesApplication</span>;<br><br>    <span>protected</span> <span><span>function</span> <span>setUp</span>(): <span>void</span><br>    </span>{<br>        <span>parent</span>::<span>setUp</span>();<br>        <br>        <span>Artisan</span>::<span>call</span>(<span>'migrate:fresh --seed'</span>);<br>    }<br>}</span>
```

## When should we use the Feature or Unit test?

Actually, every single functions and all HTTP responses must have detailed tests. I mean, we need to use tests for client (Front-end, mobile or monolithic system) expectations with all cases. It’s also depending the expected coverage rate.

## **How** should **we use the Feature or Unit test?**

We use feature tests for our _HTTP_ requests.

**How?**  
We generate an _HTTP_ request which can be _GET, POST, PUT, PATCH,_ or _DELETE_ with their Header parameters and Request Body, then we are comparing and working with our rules.

Let’s create a login example for that.

Creating controller and request file.

```
<span id="5820" data-selectable-paragraph="">php artisan make:controller API/V1/Auth/AuthController<br>php artisan make:request Auth/LoginRequest</span>
```

and route

```
<span id="af9c" data-selectable-paragraph=""><span>&lt;?php</span><br><br><br><span>use</span> <span>App</span>\<span>Http</span>\<span>Controllers</span>\<span>API</span>\<span>V1</span>\<span>Auth</span>\<span>AuthController</span>;<br><span>use</span> <span>Illuminate</span>\<span>Http</span>\<span>Request</span>;<br><span>use</span> <span>Illuminate</span>\<span>Support</span>\<span>Facades</span>\<span>Route</span>;<br><br><span>Route</span>::<span>post</span>(<span>'/login'</span>, [<span>AuthController</span>::<span>class</span>, <span>'postLogin'</span>])<br>    -&gt;<span>name</span>(<span>'auth.login'</span>);</span>
```

The route name is important for our test cases for easy to find.

```
<span id="7f0c" data-selectable-paragraph=""><span>public</span> <span><span>function</span> <span>render</span>(<span><span>$request</span>, <span>Throwable</span> <span>$exception</span></span>)<br></span>{<br>        <span>return</span> <span>response</span>()-&gt;<span>json</span>([<span>$exception</span>-&gt;<span>getMessage</span>()], <span>Response</span>::<span>HTTP_UNPROCESSABLE_ENTITY</span>);<br>}</span>
```

I’ve added a render function for exception Handler. You can _customize_ that function for _HTTP status_ and _Exception messages_… This example is always throwing the same Exception class here. But you can create and catch new exceptions with artisan via this command.

> php artisan make:exception {exceptionName}

And that case should include these tests.

Everything seems fine, we can run our tests. 🤭

Press enter or click to view image in full size

![](Laravel%20with%20PEST%20TEST%20framework%20(include%20examples)%20%20by%20Muhammet%20AKKURT%20%20Medium/1Axm0fkVlo3Zfdr5qkKaZMA.png)

Feature tests seem like AJAX or Axios’ request. One different thing, they are running for our code quality, and also that is answering that question, is this HTTP response really correct or not? This is already our main goal.

## **So, How about the Unit test?**

It’s a bit different, I’d like to write unit tests of this login progress. But, In this case, we directly used our logic in a controller function (I know, you also don’t like these useless methodologies). If we want useful and testable codes, we should use Dependency Injections, and Service containers in our project. Thus, we can use unit tests for all logic…

We can create custom functions in our _tests/Pest.php_ file like this. I’ve created a function for manipulating requests with the class variable therefore I will use Custom requests in Service Containers. We can pass the request into the service function with that function. If we don’t use our Custom Request while using this function, our request will pass which is created by artisan command

All unit tests here…

There are many expectations linked below. We can use them for what we need. Also, we can create _custom_ expectations.  
[https://pestphp.com/docs/expectations](https://pestphp.com/docs/expectations)

Press enter or click to view image in full size

![](Laravel%20with%20PEST%20TEST%20framework%20(include%20examples)%20%20by%20Muhammet%20AKKURT%20%20Medium/1riRabp8I49uchFmuL23Cqw.png)

I’ve moved login progress into the _AuthService_ from the Controller method. No longer, It is **_testable_**.

Press enter or click to view image in full size

![](Laravel%20with%20PEST%20TEST%20framework%20(include%20examples)%20%20by%20Muhammet%20AKKURT%20%20Medium/1xZrCTlYFyQKy5lDAMFx-kw.png)

Yes, we passed… we can create a pull request now 🤓

We can filter our tests for running. You don’t need to run all tests when you’re developing your task.

```
<span id="c941" data-selectable-paragraph="">php artisan test --filter={text}</span>
```

Press enter or click to view image in full size

![](Laravel%20with%20PEST%20TEST%20framework%20(include%20examples)%20%20by%20Muhammet%20AKKURT%20%20Medium/1tLZgGy3WoRAT9QzbCOwYww.png)

Have a nice day and happy code. :)

Github Repository; [https://github.com/muhammetakkurt/laravel-pest-example](https://github.com/muhammetakkurt/laravel-pest-example)  
LinkedIn Profile; [https://www.linkedin.com/in/muhammet-akkurt/](https://www.linkedin.com/in/muhammet-akkurt/)

**_References;_**  
[https://laravel.com/docs/9.x/installation](https://laravel.com/docs/9.x/installation)  
[https://laravel.com/docs/9.x/seeding](https://laravel.com/docs/9.x/seeding)  
[https://pestphp.com/docs/installation](https://pestphp.com/docs/installation)  
[https://laravel.com/docs/9.x/testing#creating-tests](https://laravel.com/docs/9.x/testing#creating-tests)  
[https://pestphp.com/docs/assertions](https://pestphp.com/docs/assertions)
