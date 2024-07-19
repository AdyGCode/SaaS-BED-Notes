---
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
header: "![NMTAFE](../images/Black-Red-Banner.svg)"
auto-scaling: true
size: 4k
tags: SaaS, APIs, Back-End

date created: 03 July 2024
date modified: 07 July 2024
---

# Laravel and APIs

**Software as a Service - Back-End Development**

**Session 01**

Developed by Adrian Gould

![](saas-addiction.jpg)

---
<div class="page-break" style="page-break-before: always;"></div>

```table-of-contents
title: # Contents
style: nestedList
minLevel: 0
maxLevel: 3
includeLinks: true
```

---
<div class="page-break" style="page-break-before: always;"></div>

# Requirements

Please see the Development Environments article for details on what we use for developing and teaching at NM TAFE.

> **Note**: 
> During development a few items have been found to cause issues. These include:
> 
> - We must use PHP 8.2.x as `nnjeim/world` package seems to have an issue with PHP 8.3.x
> - PHP script memory must be set to `2048`MB for migration and seeding of the `nnjeim/world` package
> - Once this migration is complete, memory may be reduced to `128`MB.
> - … 

---

# Creating a New Laravel API Application

Open Windows Terminal (or equivalent)

Update the laravel installer and any other global packages:

```shell
composer global upgrade --no-interaction
```

Create a new Laravel application:

```shell
laravel new 
```

When asked, answer these questions:

- What is the name of your project? **workopia-api-xxx** 
  **`xxx`** is replaced by your initials.
- Would you like to install a starter kit? **No Starter Kit**
- Which testing framework do you prefer? **Pest**
- Would you like to initialize a Git repository? **Yes**
- Which database will your application use? **SQLite** (you may opt to use another DBMS if you wish)
- Would you like to run the default database migrations? **Yes**
- The SQLite database … Would you like to create it? **Yes**

 Move into the new application folder:

 ```shell
 cd workopia-api-xxx
```

<div class="page-break" style="page-break-before: always;"></div>

## Laravel and `.env`, `APP_ENV` & `APP_DEBUG`

In your `.env` file you will note that there is a variable called `APP_ENV`. This is the application's execution environment. There are two main `APP_ENV` values:

- `local`
- `production`

During **development** we ALWAYS use `local` and when the application is **live** we use `production`.

To go along with this there is the `APP_DEBUG` variable, which turns debugging mode on and off.

In practice, `APP_DEBUG` is set to:

- `true` when `APP_ENV` is `local`
- `false` when `APP_ENV` is `production`

You could use a configuration that allows for "testing" in a sandbox with a copy of production data:

```ini
APP_ENV=production
APP_DEBUG=true
```

You will often keep a local and production `.env` file so as to make sure you enable the correct environment. 

When learning, you could copy the `.env` to `.env.local` and `.env.production`. You could even have one for staging/testing, `.env.staging` and `.env.testing`.

Remember that in reality you would **NOT** version control a `.env` file as it is a security risk.

<div class="page-break" style="page-break-before: always;"></div>

## Package Installation

Before we go any further we will add some packages ready for later development, including:

- Laravel Sanctum - for authentication of users.
- Scribe - an API documentation generator.
- Laravel Pint (if not already installed) - a code linter.
- Spatie's Laravel-Tags - Adds tagging to any model.
and others.

### Laravel Pint

Install Pint using the following steps:

``` shell
composer require --dev laravel/pint
```

It is then possible to integrate Pint into PhpStorm so that on commit your code is tidied up.

### Laravel Sanctum

Add Laravel's Sanctum authentication package:

```shell
composer require laravel/sanctum
```

### Scribe Documentation Generator

Install using composer then publish the configuration file.

```shell
composer require --dev knuckleswtf/scribe
php artisan vendor:publish --tag=scribe-config
```

We will leave configuration for a later stage.

### Spatie's Laravel Tags

Install and publish Spatie's Laravel Tags package:

```shell
composer require spatie/laravel-tags
php artisan vendor:publish --provider="Spatie\Tags\TagsServiceProvider" --tag="tags-migrations"
php artisan vendor:publish --provider="Spatie\Tags\TagsServiceProvider" --tag="tags-config"
php artisan migrate
```

Details on this package from <https://spatie.be/docs/laravel-tags>

<div class="page-break" style="page-break-before: always;"></div>

### Nnjeim World Package

Install and publish the World package:

```shell
composer require nnjeim/world
php artisan vendor:publish --tag=world
php artisan migrate
php artisan db:seed --class=WorldSeeder
```

The seeding process will take a LONG time, so beware!

Details on this package from <https://github.com/nnjeim/world>

---
<div class="page-break" style="page-break-before: always;"></div>

# Building the World Factory

Even though we have used the `nnjeim/world` package, it does not come with factories to make it easy to create tests and run them with Pest, so we will fill in this gap as part of our development.

## Country Factory

Create a new factory using:

```bash
php artisan make:factory CountryFactory
```

Open the factory file and edit/add the following:

```php
<?php  
  
namespace Database\Factories;  
  
use Illuminate\Database\Eloquent\Factories\Factory;  
use Nnjeim\World\Models\Country;  
  
/**  
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>  
 */class CountryFactory extends Factory  
{  
  
    protected $model = Country::class;  
    /**  
     * Define the model's default state.     *     * @return array<string, mixed>  
     */    public function definition(): array  
    {  
        return [  
            'iso2' => $this->faker->countryCode(),  
            'name' => $this->faker->country(),  
            'status' => 1,  
            'phone_code' => $this->faker->numberBetween(1,999),  
            'iso3' => $this->faker->countryISOAlpha3(),  
            'region' => $this->faker->word(),  
            'subregion' => $this->faker->word(),  
        ];  
    }  
}
```

What we have done here is provide a way to add dummy data into fields that are missing.

This is great for testing.

---

<div class="page-break" style="page-break-before: always;"></div>

# Creating our first API Endpoint

As a way of learning how to write an endpoint, we are going to create our own API endpoints for the World package. 

We will create API endpoints for:

- `/api/v1/countries` - to retrieve all countries
- `/api/v1/countries/{id}` - to retrieve the country with `id`

First enable the API routing and other functionality:

```bash
php artisan install:api
```

It will ask about a migration, so respond **Yes** to execute it.

## General API Response Class

We are going to create a generalised API response class so that we do not have to manipulate the output each time we need to send a response back to the client. This is DRYing our code.

```shell
php artisan make:class /Classes/ApiResponseClass
```

Edit this class and add the following code (we show it in stages, and describe what it is used for).

### Constructor

First is the constructor (`__construct`) method for the ApiResponseClass. This is automatically added by the make command.

```php
class ApiResponseClass  
{  
    /**  
     * Create a new class instance.     
     * TODO: Delete this method
     */
    public function __construct()  
    {  
        //  
    }  
```

It's empty, so delete this method as it is not needed. We will not be instantiating any objects using this class.

<div class="page-break" style="page-break-before: always;"></div>

### Rollback

The `rollback` method is defined to allow for undoing a transaction. It is best practice to use database transactions when dealing with data insertion, updates or deletes. 

When the rollback is called it will throw an error and message.

We declare the method as being static as we do not need to instantiate the class to use these methods.

```php
	/**
	* TODO: Add description and parameters for this method
	*/
    public static function rollback($e, $message = "Something went wrong! Process not completed")  
    {  
        DB::rollBack();  
        self::throw($e, $message);  
    }  
```

### Throw

The `throw` method is used by the class to log the error to file (or elsewhere), and then to send a response to the client in JSON format, with the error code 500 and the message.

We declare the method as being static as we do not need to instantiate the class to use these methods.

```php
	/**
	* TODO: Add description and parameters for this method
	*/
    public static function throw($e, $message = "Something went wrong! Process not completed")  
    {  
        Log::info($e);  
        throw new HttpResponseException(response()->json(["message" => $message], 500));  
    }  
```

<div class="page-break" style="page-break-before: always;"></div>

### Send Response

Finally we get to where we actually send the response, the `sendResponse` method.

We pass the data to be sent to the client, a success message, and the required result code (default 200, OK) to the method, and it constructs an array with these items.

The response is then sent back to the client in JSON format.

We declare the method as being static as we do not need to instantiate the class to use these methods.

```php
  	/**
	* TODO: Add description and parameters for this method
	*/
    public static function sendResponse($result, $message, $code = 200)  
    {  
        $response = [  
            'success' => true,  
            'message'=>$message??null,  
            'data' => $result  
        ];  
        return response()->json($response, $code);  
    }  
    
/**
 * End of ApiResponseClass
 */
}
```

This generalised response class can be reused over and over again - a very useful tool in your arsenal.

You will see how it is used within the API Controller.

<div class="page-break" style="page-break-before: always;"></div>

## Country API Controller

Now we are ready to create our first Controller that will be part of the API.

There are many ways to go about this, but if we separate the API from a management application, then we can use the same naming as previously done. That is CountryController, UserController, etc.

Some people would advocate the use of an API namespace for the ability to have a single code base. This could become a very large monolithic application by doing this. 

We are splitting the code base for our learning. 

### Create the Controller

Unlike creating a standard resourceful controller we will tell artisan to make an API controller using the `--api` switch rather than the `--resource` switch.

Create the Country API controller:

```bash
php artisan make:controller CountryController --api
```

### Edit the Country Controller Class

Next edit the `CountryController` class, by updating the `index` method.

We are going to retrieve all the countries. We are not going to filter, or paginate the results.

```php
public function index()  
{  
    $countries = Country::all();  
    return ApiResponseClass::sendResponse($countries, "Countries retrieved successfully.", 200);  
}
```

Note how we use our `ApiResponseClass` to send the response. The countries are a collection (array) of results, and the message is set so that we could take this and report to the user if needed. The response code is `200 OK` - but this could be omitted as the default for the `sendResponse` method is `200`.

<div class="page-break" style="page-break-before: always;"></div>

## Create the Routes

We are ready to now hook the controller and the routing up so we can make use of it.

Open the `api.php` file in the `routes` folder, which was created when we told artisan to `install:api`.

Create a new route for us to use the CountryController's Resourceful API methods:

```php
Route::group(['prefix' => 'v1'], function () {  
    Route::apiResource('/countries', CountryController::class);  
});
```

What's special about this?

- We group these routes into `v1` of our API.
- We use the ApiResource method from the Route class to automagically add `index`, `show`, `create`, `update` and `delete` methods to the routes.

### Listing the Routes

Use the `php artisan route:list` command to see the routes you now have.

You should find these five routes listed, plus others generated by other components we installed previously.

| VERB         | Endpoint                     | Alias               | Method                      |
| ------------ | ---------------------------- | ------------------- | --------------------------- |
| `GET\|HEAD`  | `api/v1/countries`           | `countries.index`   | `CountryController@index`   |
| `POST`       | `api/v1/countries`           | `countries.store`   | `CountryController@store`   |
| `GET\|HEAD`  | `api/v1/countries/{country}` | `countries.show`    | `CountryController@show`    |
| `PUT\|PATCH` | `api/v1/countries/{country}` | `countries.update`  | `CountryController@update`  |
| `DELETE`     | `api/v1/countries/{country}` | `countries.destroy` | `CountryController@destroy` |

---

<div class="page-break" style="page-break-before: always;"></div>

# Testing our Endpoint

We can perform testing in a number of ways:

- Manual testing using a browser
- Manual testing using the CLI and the `curl` command
- Unit testing using Pest or similar
- Testing via a 3rd party GUI (eg. Postman)

Each has pros and cons, for example:

- Manual testing using a browser
	- may not be able to test when it comes to authenticated users
- Manual testing using the CLI and the `curl` command
	- 
- Unit testing using Pest or similar
	- 
- Testing via a 3rd party GUI (eg. Postman)
	- 

## Red and Green

Unit testing has two states:

- Red
	- Test errors.
- Green
	- Test passes.

You are aiming for ALL GREEN!

![](cli-pest-green.png)

Above is an image from running tests on the command line, and giving an ALL GREEN response.

<div class="page-break" style="page-break-before: always;"></div>

### Manual Testing Route via Browser

Ok, let's try our new index route.

\
Open a browsers and go to: `http://workopia-api-xxx.test/api/v1/countries` and you should get data similar to (this is an extract as there are 250 countries in the database):

```text
{
	"success":true,
	"message":"Countries retrieved successfully.",
	"data":[
		{
			"id":1,
			"iso2":"AF",
			"name":"Afghanistan",
			"status":1,
			"phone_code":"93",
			"iso3":"AFG",
			"region":"Asia",
			"subregion":"Southern Asia"
		}, {
			"id":2,
			"iso2":"AX",
			"name":"Aland Islands",
			"status":1,
			"phone_code":"358",
			"iso3":"ALA",
			"region":"Europe",
			"subregion":"Northern Europe"
		},
		...
	]
}
```

**Note:** You will probably find your display will not be split into lines as we have above.

<div class="page-break" style="page-break-before: always;"></div>

## Testing with PEST

Pest is a unit testing framework that is built upon the PhpUnit framework. It has a very expressive syntax.

> **Note:**
> Whilst we are developing and using Pest based testing, we will be 'refreshing' the database regularly. This means that any existing data will be destroyed before tests are executed.
> .
> You **must not** use test systems on a `production` application. 
> 
> Testing **must always be** completed on the `local` development or in the CI/CD testing phase.

To begin we will look at the example test, and then build a test for the above method.

In practice, though, we write the tests FIRST.

### Example Test

Open the `tests/Feature/ExampleTest.php` file.

In here you will see:

```php
<?php  
  
it('returns a successful response', function () {  
    $response = $this->get('/');  
  
    $response->assertStatus(200);  
});
```

This is a Pest test, but it is longer than it needs to be, so replace the content of the file with:

```php
<?php  
  
it('has welcome page')->get('/')->assertStatus(200);
```

Do you think that syntax reads really nicely?

<div class="page-break" style="page-break-before: always;"></div>

### Writing the CountryController `index` Test

Create the CountryControllerTest using:

```bash
php artisan pest:test CountryControllerTest --unit
```

Opening this file reveals the following:

```php
<?php  
  
test('countrycontroller', function () {  
    expect(true)->toBeTrue();  
});
```

Let's make some changes here.

After the above test (we will leave it there for now), add the following test code:

```php
it('can fetch all countries', function () {  
  // Test data
  $data = [  
    'message' => 'Countries retrieved successfully.',  
    "success" => true,  
    'data' => [  
        [  
          "id" => 1, "iso2" => "AF", "name" => "Afghanistan", "status" => 1, 
          "phone_code" => "93", "iso3" => "AFG", "region" => "Asia", 
          "subregion" => "Southern Asia"  
        ], [  
          "id" => 2, "iso2" => "AX", "name" => "Aland Islands", "status" => 1, 
          "phone_code" => "358", "iso3" => "ALA", "region" => "Europe", 
          "subregion" => "Northern Europe",  
        ]
     ]  
   ];  
  
    // Inseet the above test data into the Country model 
    foreach ($data['data'] as $datum) {  
        Country::create($datum);  
    } 
     
	// Get a response from calling the API endpoint
    $response = $this->getJson("/api/v1/countries");
    // Check the response was as expected:
    //   - 200 OK
    //   - The correct JSON data (matches the sample data)
    $response->assertStatus(200)->assertJson($data);  
});
```

---

<div class="page-break" style="page-break-before: always;"></div>

# Documenting an Endpoint

As you saw in the set-up of the application we installed the Knuckle SWTF Scribe package. This package provides us with a robust way to document our API.

Just in case you forgot to install the Scribe package execute the following:

```shell
composer require --dev knuckleswtf/scribe
php artisan vendor:publish --tag=scribe-config
```

### Configuring Scribe

Open the configuration file in PhpStorm (<kbd>shift</kbd> <kbd>shift</kbd> type in `apidoc-` and find the `config/scribe.php` file.)

Make these changes, with strings being in quotes, and booleans being unquoted…

- type: `laravel`,
- title: `Workopia API`,
- description: `Developed by YOUR_NAME_HERE`,
- use_csrf: `true`,
- example_languages: `bash`, `javascript`, `php`, `python`

This configuration means that Scribe will use the Laravel routing and …

It will also add CSRF to form requests, and automatically generate examples of the API using Bash (curl), JavaScript, PHP and Python.

<div class="page-break" style="page-break-before: always;"></div>

### Adding Documentation to the API

Adding documentation to the API is done by using PHP Doc block comments.

Here is an example:

```php
/**  
 * Return all countries 
 * 
 * @group Country  
 * 
 * @response status=200 scenario="Country Found" {  
 *  "success": true,  
 *  "message": "Countries retrieved successfully.", 
 *  "data": [ 
 *      {  
 *          "id": 1,  "iso2": "AF", "name": "Afghanistan", "status": 1, "phone_code": "93",
 *          "iso3": "AFG", "region": "Asia", "subregion": "Southern Asia" 
 *      },  
 *      {  
 *          "id": 2,  
 *          "iso2": "AX", "name": "Aland Islands", "status": 1, "phone_code": "358", 
 *          "iso3": "ALA", "region": "Europe", "subregion": "Northern Europe" 
 *      }  
 *  ]  
 * }  
 * 
 * @return \Illuminate\Http\JsonResponse  
 */
public function index()  
{  
    $countries = Country::all();  
    return ApiResponseClass::sendResponse($countries, "Countries retrieved successfully.", 200);  
}
```

You are probably thinking, OMG! 

Yes, in the example above the documentation via the PHP Doc comments is 5x the code for the method itself.

The reason for this is that the comments contain:

- Grouping - to keep related API documentation together and make it easier to locate.
- Response - is an example response for display in the documentation without accessing live data.

In the above example, there is no need to add an parameters as the method does not contain them.

Note that you DO NOT remove the method documentation such as the `@return` comment as this is used by the IDE to assist you when building the application.

<div class="page-break" style="page-break-before: always;"></div>

### Generating and Publishing the API Docs

To generate the Docs you will perform an artisan command:

```bash
php artisan scribe:generate
```

You should now be able to view the documentation at: <http://workopia-api-xxx.text/docs>

###### Example of API Documentation Home Page

![Image: Home page for the generated Scribe API Documentation](scribe-docs-home.png)

###### Example of Grouped API Endpoints

![The documentation for the Scribe documentation's Country group](scribe-docs-country.png)

---

## Autogenerating Documentation

When using Scribe, you could have it automatically regenerate the docs by using GitHub's Workflows, otherwise you will need to generate the documentation using the command we used previously.

---

<div class="page-break" style="page-break-before: always;"></div>

# Creating another endpoint

We have the "all countries" endpoint created and tested.

This time we will reverse the process, and create the test FIRST, execute to see it fail, then add code to make it pass.

This is one of the best practice methods to employ when developing.

## 1) Create New Test

We already have a CountryController Test file, so no need to create one.

Edit the existing file and add tests to verify if we are able to retrieve a single country correctly using (a) a record ID, and (b) the ISO 2 Letter Code.

The first test checks for using the ID to retrieve the country:

```php
it('can fetch one country by ID', function () {  
  
    $data = [  
        "success" => true,  
        'message' => 'Country Found',  
        'data' => [  
            [  
                "id" => 2, "iso2" => "AX", "name" => "Aland Islands", "status" => 1, 
                "phone_code" => "358", "iso3" => "ALA", 
                "region" => "Europe", "subregion" => "Northern Europe",  
            ], 
        ],  
    ];  
  
    // Add test data  
    foreach ($data['data'] as $datum) {  
        Country::create($datum);  
    }  
  
  
    $response = $this->getJson("/api/v1/countries/2");  
    $response->assertStatus(200)->assertJson($data);  
});
  
```

<div class="page-break" style="page-break-before: always;"></div>

The next test adds checking to see if we can use the ISO 2 Letter code to retrieve the country:

```  php
it('can fetch one country by ISO-2 code', function () {  
  
    $data = [  
        "success" => true,  
        'message' => 'Country Found',  
        'data' => [  
            [  
                "id" => 2, "iso2" => "AX", "name" => "Aland Islands", "status" => 1, 
                "phone_code" => "358", "iso3" => "ALA", 
                "region" => "Europe", "subregion" => "Northern Europe",  
            ],        
        ]  
    ];  
  
    // Add test data  
    foreach ($data['data'] as $datum) {  
        Country::create($datum);  
    }  
  
    $response = $this->getJson("/api/v1/countries/AX");  
    $response->assertStatus(200)->assertJson($data);  
});
```

<div class="page-break" style="page-break-before: always;"></div>

## 2) Execute the Tests

You may execute the tests in two ways:

1) Command Line
2) Within PhpStorm

### Executing from the command line

To execute the tests from the command line use:

```bash
php artisan test
```

The result will be information about the tests that passed and those that failed (screenshot):

![](CleanShot%202024-07-06%20at%2013.35.40.png)

<div class="page-break" style="page-break-before: always;"></div>

The results is also shown here as plain text:

```text
   FAIL  Tests\Unit\CountryControllerTest
  ✓ countrycontroller                                                                      0.49s
  ✓ it can fetch all countries                                                             0.05s
  ⨯ it can fetch one country by ID                                                         0.02s
  ⨯ it can fetch one country by ISO-2 code                                                 0.01s

   PASS  Tests\Unit\ExampleTest
  ✓ that true is true

   PASS  Tests\Feature\ExampleTest
  ✓ it has welcome page                  
 ────────────────────────────────────────────────────────────────────────────────────────────────
  FAILED  Tests\Unit\CountryControllerTest > it can fetch one country by ID
                                                                             AssertionFailedError
  Invalid JSON was returned from the route.

  at tests/Unit/CountryControllerTest.php:72
     68▕         Country::create($datum);
     69▕     }
     70▕
     71▕     $response = $this->getJson("/api/v1/countries/2");
  ➜  72▕     $response->assertStatus(200)->assertJson($data);
     73▕ });
     74▕
     75▕
     76▕ it('can fetch one country by ISO-2 code', function () {

  ───────────────────────────────────────────────────────────────────────────────────────────────
   FAILED  Tests\Unit\CountryControllerTest > it can fetch one country by ISO-2 code
                                                                             AssertionFailedError
  Invalid JSON was returned from the route.

  at tests/Unit/CountryControllerTest.php:95
     91▕         Country::create($datum);
     92▕     }
     93▕
     94▕     $response = $this->getJson("/api/v1/countries/AX");
  ➜  95▕     $response->assertStatus(200)->assertJson($data);
     96▕ });
     97▕


  Tests:    2 failed, 4 passed (9 assertions)
  Duration: 0.76s
  ```

<div class="page-break" style="page-break-before: always;"></div>

### Executing Tests in PhpStorm

It is possible to run your tests in PhpStorm. This is done by:

- Open the Test File (Country Controller Test)
- At the top of the file, you will see a double chevron :LiChevronsRight:, click this to run all tests in the file:
  ![](CleanShot%202024-07-06%20at%2013.45.39.png)
  
- Alternatively to run a single test, find an arrow :LiChevronRightSquare: , cross :LiCross: or tick :LiCheck: next to the test and click this:  ![](CleanShot%202024-07-06%20at%2013.49.25.png)


- The test is executed and details shown in the run pane: ![](phpstorm-tests-red-initial.png)

The advantage of this is that you can click on the error line in the right side to jump straight to the line with the issue. In this case the code in the test.

<div class="page-break" style="page-break-before: always;"></div>

### Alternative Ways To Run Tests in PhpStorm

You can also run all tests in PhpStorm by right clicking on the `tests` folder and selecting the relevant Run … (Pest) option. For example, right clicking on the `Unit` folder will show "Run Unit (Pest)". Doing the same on the tests` folder will allow all tests to execute.

![](phpstorm-tests-running.png)

<div class="page-break" style="page-break-before: always;"></div>

## 3) Write Code

Identify the issue to write the code for, and write the code to solve the problem.

Let's begin with retrieving by ID:

```php
 public function show(string $id)  
    {  
        $country = Country::whereID($id)->get();  
        $message = count($country) > 0 ? "Country Found" : "Country Not Found";  
        return ApiResponseClass::sendResponse($country, $message);  
    }
```

## 4) Rerun Tests

Using your preferred method, re-run the tests.

Here we see a problem:

![](phpstorm-tests-red-id-column.png)

This is a common mistake… the `whereID` needs to adhere to the Camel case rules… `whereId`.

<div class="page-break" style="page-break-before: always;"></div>

## 5) Fix the error and go back to step 4

Fix the issue, and discussed in the previous step, and re-run the tests.

```php
public function show(string $id)  
{  
    $country = Country::whereId((int)$id)->get();  
    $message = count($country) > 0 ? "Country Found" : "Country Not Found";  
    return ApiResponseClass::sendResponse($country, $message);  
}
```

Here is the result:

![](phpstorm-tests-partial-green.png)

**Note**: We have introduced a possible issue by forcing the type casting on $id. We will resolve this in a moment.

## 6) Refactor Code

Once you have done any refactoring, you **must** re-run the tests to ensure you have not introduced any problems whilst refactoring.

If all is well, then you could commit your work, and start on the next part of the development…

<div class="page-break" style="page-break-before: always;"></div>

## Writing Code to Fix the Second Failing Test

Ok, so we have the ability to retrieve a country by an integer record ID.

What about the second test: "can fetch one country by ISO-2 code"?

How can we test both the ID and the ISO 2 letter code?

Well Laravel's Eloquent ORM now has the whereAny clause that makes this so simple.

Replace the:

```php
        $country = Country::whereId((int)$id)->get();
```

with:

```php
        $country = Country::whereAny(['id', 'iso2'], $id)->first()->get();  
```

Re-run the Tests.

![](phpstorm-test-green.png)

<div class="page-break" style="page-break-before: always;"></div>

# What about Automatic Test Execution?

We can do this in PhpStorm by using the Rerun Automatically option.

Find the button with a 'circular' arrow and click this.

![](phpstorm-test-runner-autorerun.png)

You should now have automatic re-running of tests.

### PhpStorm Test Runner Icons

To quickly assist you locate the correct icons in the test runner toolbar, here is the toolbar and the icons.

![](phpstorm-test-runner-tools.png)

1) Run test(s)
2) Rerun failed tests
3) Automatic rerun
4) Stop running tests
5) Show passed
6) Show Failed
7) Sorting options
8) Import tests from file
9) Test History


---

<div class="page-break" style="page-break-before: always;"></div>

# Questions to Investigate

**You DO NOT need to provide formal answers to these questions.** They are a combination of research, review, and thought provoking ideas that may or may not be relevant to the development of an API.

**Question:** Generalised Response Class - Could we add a "success" field set to false? In either case why?

**Question**: API Code Reuse - Consider how you may be able to use the API codebase to help develop a web application so that code would not be duplicated.

**Question**: How could you use GitHub workflows to automatically generate the Scribe documentation on push/pull request?

# END

Next up: [Our First API](Our-First-API.md)
