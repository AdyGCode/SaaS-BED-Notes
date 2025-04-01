---
banner: "![[Black-Red-Banner.svg]]"
created: 2025-03-24T09:08
updated: 2025-04-01T15:05
---
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
updated: 2025-03-27T17:56
---

# Session 06 Using Scramble to Document an API

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

# Session 06 Scramble

We will demo how to document your API using a small project.

Follow the steps to set a demo up.

> **Important**: 
> 
> Lecturers sometimes "add errors" to code to encourage you to *discover problems and fix* them. This is a highly desirable trait for any developer.
> 
> This assists your ability to develop effectively and *encourages the investigative mindset* that is key to learning.

## Set Up Demo Laravel 12 App

Update the Laravel installer: 
```shell
composer global require laravel/installer
```

Create a new Laravel 12 project: 
```shell
laravel new SaaS-L12-API-Demo
```

Answer the prompts with:
- None
- SQLite
- Yes

Move into the 'Demo' folder: 
```shell
cd SaaS-L12-API-Demo
```

### Install Sanctum: 
```shell
composer require laravel/sanctum
```

### Install Scramble: 
```shell
composer require dedoc/scramble
```

> ### ⚠️ Hints & Tips
> 
> you can also do these in one go: 
> ```shell
> composer require laravel/sanctum dedoc/scramble
> ```

### Publish Laravel API requirements:

```shell
php artisan install:api
```


### Publish Scramble Config

Publish the Scramble config and service provider:
```shell
php artisan vendor:publish --provider="Dedoc\Scramble\ScrambleServiceProvider"
php artisan vendor:publish --tag="scramble-config"
```


## Debug Mode or Not Debug Mode

Before we being with the creation of the API in any form, we need to visit a setting or two that will make a huge difference to our development and production code.

Open your `.env` file, and change `APP_DEBUG` from `true` to `false`.

Why?

### Security

Security of any application is on the top of the requirements list.

So what difference does the `APP_DEBUG` setting make?

> If you turn it on as _true_, then all your errors will be shown with all the details, including names of the classes, DB tables etc. This is a huge security issue, so in production environment it's strictly advised to set this to _false_.
>
> ![assets/JSON-error-app-debug-true.png](../assets/JSON-error-app-debug-true.png)

*Image care of Laravel Daily (https://laraveldaily.com/post/laravel-api-errors-and-exceptions-how-to-return-responses) used for educational purposes only.*

Another *excellent* reason for using this even when developing...


### Forces Developers to Think Like Consumers

Possibly a more important factor of this is the following:

> By turning off actual errors, you will be **forced** to think like API consumer who would receive just _"Server error"_ and no more information. In other words, you will be forced to think how to handle errors and provide useful messages from the API.


My thanks to Povilas Korop at [Laravel Daily](https://laraveldaily.com) for this tip.

- Korop, P. (2019). _Laravel API Errors and Exceptions: How to Return Responses_. Laravel Daily. https://laraveldaily.com/post/laravel-api-errors-and-exceptions-how-to-return-responses

 
We will look at more error handling within this tutorial.



## Run the Dev Server from Command Line

In MS Terminal split the terminal into two sessions (<kbd>ALT</kbd>+<kbd>SHIFT</kbd>+<kbd>MINUS</kbd>).

In the new session:
```shell
cd SaaS-L12-API-Demo
```

and then execute 
```shell
composer run dev
```


### Open Scramble API Docs in browser to test

Open a new browser window and go to `http://localhost:8000/docs/api`

![](../assets/S06-Using-Scramble-to-Document-an-API-20250310172017067.png)


### Edit Scramble Config

Open the `config/scramble.php` file

Update the following lines:

```php
'version' => env('API_VERSION', '0.5.0'),

'description' => 'This is a small demonstration API for showing how to document using SCramble.'
```

## Add User Seeder 

Create a User Seeder:
```shell
php artisan make:seeder UserSeeder
```

Open the `database\seeders\UserSeeder.php` file and add:

```php
$users = [  
    [  
        'name' => 'Ad Ministrator',  
        'email' => 'admin@example.com',  
        'email_verified_at' => now(),  
        'password' => Hash::make('Password1'),
        'remember_token' => Str::random(10),  
    ],  
];  
  
  
DB::beginTransaction();  
foreach ($users as $user) {  
    User::create($user);  
DB::commit();
```


Update the `database\seeders\DatabaseSeeder.php`:

```php
  
$this->call([  
    UserSeeder::class,  
    CategorySeeder::class,  
]);
```


## Create a Model with the Trimmings

In your shell, execute: 

```shell
php artisan make:model Category --api -a
```


### Update the Migration's Up Method

Open the `database\migrations\..._create_categories_table.php` migration.

Add to the `up` method the two fields:

```php
$table->string('name',64)->required();  
$table->string('description')->nullable();
```

### Update the Category Model

```php
<?php  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Notifications\Notifiable;  
  
class Category extends Model  
{  
  
    /** @use HasFactory<\Database\Factories\UserFactory> */  
    use HasFactory, Notifiable;  
  
    /**  
     * The attributes that are mass assignable.     
     *     
     * @var list<string>  
     */  
    protected $fillable = [  
        'name',  
        'description',  
    ];  
  
    /**  
     * The attributes that should be hidden for serialization.     
     *     
     * @var list<string>  
     */  
    protected $hidden = [  
  
    ];  
  
    /**  
     * Get the attributes that should be cast.     
     *     
     * @return array<string, string>  
     */  
    protected function casts(): array  
    {  
        return [  
  
        ];  
    }  
}
```


### Update the Category seeder

Open the `database\seeders\CategorySeeder.php` file and add:

```php
$categories = [  
    ['id'=>1,'name'=>'Unknown', 'description'=>'No category assigned'],  
    ['id'=>100, 'name'=>'dad', 'description'=>'Dad Jokes'],  
    ['name'=>'programmer', 'description'=>null],  
    ['name'=>'lightbulb', 'description'=>null],  
    ['name'=>'one-liner', 'description'=>null],  
    ['name'=>'mum', 'description'=>null],  
    ['name'=>'explicit', 'description'=>"Not for under 18 year olds"],  
];  
  
DB::beginTransaction();  
foreach ($categories as $category) {  
    Category::create($category);  
}  
DB::commit();
```

Remember to add the required Illuminate facades and models as needed.

### Execute the migrations

Execute the migration and seeders.

```shell
php artisan migrate
php artisan db:seed
```


> ### ⚠️ Hints & Tips
> 
> If you need to run a seeder individually use:
> ```shell
> 	php artisan db:seed --class=ClassNameSeeder
> ```

## Add Routes

Edit the `routes\api.php` file and add the following:

```php
Route::apiResource('categories', \App\Models\Category::class);
```

Refresh the API Documentation preview.

![](../assets/S06-Using-Scramble-to-Document-an-API-20250310172604676.png)


### Update Routes

You already have a simple route that allows for the API to be accessed using `http://domain/api`.

We will now amend this so that we are showing version 1 (`v0.5`) of the API.

Modify the route above so it is now wrapped in a Route Group:

```php
Route::group(['prefix' => 'v0.5'], function () {  
    Route::apiResource('categories', CategoryController::class);  
});
```

If you do this then make sure to update the Scramble config (`config/scramble.php`) so the version is shown to be 0.5 or similar.

When you refresh the API Docs you will now see the API version (0.5) and the endpoints with `v0.5`.


## Add `ApiResponse` Class

This generalised response class can be reused over and over again - a very useful tool in your arsenal.

Let's begin by creating the class...

### Create the class

Create the class using the command line.

```shell
php artisan make:class Classes/ApiResponseClass
```

In the new `App\Classes\ApiResponse.php` class we will remove the `__construct`, and add `Rollback`, `Throw`, `sendResponse`, `success` and `error` methods.

### Constructor

First is the constructor (`__construct`) method for the `ApiResponseClass`. This is automatically added by the make command.

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

All methods are statically called.


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



### Send Response (`sendResponse`) method

Next, we get to where we actually send the response, the `sendResponse` method.

We pass the data to be sent to the client, a message, and the required result code (default 200, OK) to the method, and it constructs an array with these items.

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

The `sendResponse` method is a generalised method.

We can use this as the base and create two separate specialised methods:
- `success`, and 
- `error`.

This both abstracts and simplifies the use of the `sendResponse` method.


### `success` method

```php
public static function success($result, $message,$code = 200)  
{  
    $success=true;  
    return self::sendResponse($result,$message,$success, $code);  
}  
  
```


### `error` method

The error method calls the `sendResponse` with default of an HTTP code 500. 

```php  
public static function error($result, $message,  $code = 500)  
{  
    $success = false;  
    return self::sendResponse($result, $message,$success, $code);  
}
```


### Commonly used Error and Success Codes

There are many HTTP Response codes that are available for use. Some of them are more commonly used that  others.

The following table shows some of the commonly and less commonly used HTTP Response Codes.

| Code | Meaning               | Common use situations                                                                                                                                                                                                         |
| ---- | --------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| 200  | OK                    | when an action succeeds successfully, unless one of 201, 202 or 204 are more appropriate                                                                                                                                      |
| 201  | Created               | Use when you add new data to the system (a new resource).   This happens AFTER the resource is created. If the system cannot create the resource immediately, then 202.                                                       |
| 202  | Accepted              | If a process takes a while to complete, then 202 is appropriate. The request may or may not get acted upon (as it it may succeed, fail or be disallowed) when finally processed. This is idea for batch processing responses. |
| 204  | No Content            | Usually the response to a PUT, PATCH or DELETE request, when the API does not want to send any form of response body back to the consuming application                                                                        |
| 400  | Bad request           | When you need to tell the consuming application they have sent a header or request in general that is badly constructed.                                                                                                      |
| 401  | Unauthorised          | When the credentials used to log-in are not correct, or missing. Also used when access to a resource is not permitted due to insufficient privileges.                                                                         |
| 403  | Forbidden             | When you need to tell the client that is authenticated (logged in) they do not have permission to access the requested resource                                                                                               |
| 404  | Not Found             | When a search gives zero results, a resource (record) does not exist, or there are no records in the resource collection                                                                                                      |
| 412  | Precondition failed   | When you need to provide response for conditions in the request header fields that shows a problem (i.e. false)                                                                                                               |
| 429  | Too many requests     | When a single application instance makes too many requests and 'floods' the API                                                                                                                                               |
| 500  | Internal server error | A problem with the server. For example a configuration issue.                                                                                                                                                                 |
| 503  | Service not available | The server is not able to service the request due to high load, it being down for maintenance etc.                                                                                                                            |

We have a number of references for you listed at the end of this tutorial.

We do recommend that you read this one:

- Gupta, L. (2018, May 30). _HTTP Status Codes_. REST API Tutorial. https://restfulapi.net/http-status-codes/ **Please read**

## Custom Error Responses

There are different ways of formulating a suitable way for JSON responses that are given by Laravel as default over the commonly created HTML based responses.

This is important for an API as the consumer (the client application) should only be given JSON responses.

### Missing Routes

The first thing we can handle is the possibility of a route not being found. AKA the 404 error.

To handle this we can add a **default fallback route** to the routes file.

Open the `routes/api.php` routes file and at the very end of the file add:

```php
Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'], 
        404);
});
```

In fact if we then use our `ApiResponse` class, we will use the following:

```php
Route::fallback(static function(){
    return ApiResponse::error(
	    [],
	    "Page Not Found. If error persists, contact info@website.com", 
	    404
	);

});
```

This would be customised for the application, and you could even have a link to a feedback form rather than the email address.


### Wherefore art thou, 404 - Model Not Found

The next error to handle will be the error created when a user tries to retrieve a record from the database that is not present.

This is usually responded to as a 404 - not found.

To create a better response we edit the `bootstrap/app.php` file and update ...

First add to the `use` lines the following:

```php
use Illuminate\Database\Eloquent\ModelNotFoundException;  
use Illuminate\Support\Facades\Request;
```


Next edit the `->withExceptions` section to read:

```php
->withExceptions(function (Exceptions $exceptions) {  
    $exceptions->render(function (ModelNotFoundException $e, Request $request) {  
        if ($request->wantsJson()) {  
            return response()->json([  
                'error' => 'Entry for ' . str_replace('App', '', $e->getModel()) . ' not found'],  
                404  
            );  
        }  
    });
```

We will come to a couple of other additional good ideas as we progress.


## Build the Requests (Store, Update and Delete Category Request)

Requests are a useful way of moving the verification of a user's permission to use an action, as well as the validation rules for the action.

This in turn simplifies the controller method.

### Store Request

Let's start with the `StoreCategoryRequest`.

Open the `App\Http\Requests\StoreCategoryRequest`  class.

We now edit the two methods, `authorise` and `rules`.

Allow the request to be used (default to true for now)

```php
public function authorize(): bool  
{  
    return true;  
}

```

Add the validation rules:

```php
    return [
	    'name' => ['required', 'string', 'max:64', 'min:3'],  
        'description' => ['optional', 'string', 'max:255'],  
    ];  
```

### Update Request

The update will look very similar to the store.

```php
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['integer','exists:categories'],
            'name' => ['required', 'string', 'max:64', 'min:3'],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }
```

### Delete Request

The delete will look very similar to the previous requests, but simpler.

Create the new request using:

```shell
artisan make:request DeleteCategoryRequest
```

Next open and edit the request to read:

```php

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        // return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        ];
    }
```


## Build the Category API

Open the `CategoryController` from the `App\Http\Controllers` namespace.

Now to update/add the API CRUD/BREAD methods:

We will do this in the order:
- Browse / Read (index method)
- Read / Read (show method)
- Add / Create (store method) 
- Edit / Update (update method)
- Delete / Delete (destroy method)

### Browse / Read (index method)

The index method will read:

```php
 /**  
  * Returns a list of the Categories. 
  * 
  */
  public function index()  
  {  
    $categories = Category::all();  
  
    if (count($categories) > 0) {  
        return ApiResponse::success($categories, "All categories");  
    }  
  
    return ApiResponse::error($categories, "No categories Found", 404);  
  }
```

### Read / Read (show method)

```php
/**
 * Display the specified Category.
 *
 * @param Category $category Use Route-Model Binding to retrieve resource
 * @return JsonResponse
 */
 public function show(Category $category)  
 {  
    return ApiResponse::success($category, "Category Found");  
 }
```


### Add / Create (store method) 

```php
/**
 * Create & Store a new Category resource.
 *
 * @param \App\Http\Requests\v2\StoreCategoryRequest $request
 * @return JsonResponse
 */
public function store(StoreCategoryRequest $request)  
{  
    $category = Category::create($request->all());  
    return ApiResponse::success($category, "Category Added", 201);  
}
```


### Edit / Update (update method)

```php
    /**
     * Update the specified Category resource.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        /* The UpdateCategoryRequest performs the validation.
         *
         * Using -->all() may result in unwanted data being updated, and lead to
         * security issues.
         *
         * Using ->validated() passes only the validated data and no more to the
         * update request. A much better solution.
         */

        $category->update($request->validated());
        return ApiResponse::success($category, "Category Updated");
    }
```

### Delete / Delete (destroy method)

```php
    /**
     * Delete the specified Category from storage.
     *
     * Will return success true, success message, and the category just removed.
     *
     * @param DeleteCategoryRequest $request
     * @return JsonResponse
     */
    public function destroy(DeleteCategoryRequest $request, Category $category): JsonResponse
    {
        $categoryToDelete = $category;
        $categoryToDelete->delete();
        return ApiResponse::success($category, "Category Deleted");
    }
```



## Authenticated Routes

Our previous version of the routes allowed for anyone to use the API to create, delete and so on. We need to protect the routes, and the easiest way to do this is to apply middleware.

After this we can add extra layers of security by using roles and permissions and other techniques.

Update the `routes/api.php` file to split the requests into *authenticatieon NOT required* and *authentication required* sections.

We use the `->only()` and/or `->except()` methods to do this.

The image shows the use of just the `only` method.

![assets/phpstorm-routes-api-1.png](../assets/phpstorm-routes-api-1.png)

The code below shows using `except` and `only`.

```php
Route::group(['prefix' => 'v1'], function () {  
    Route::apiResource('categories', CategoryController::class)  
        ->except(['update','delete',]);  
  
    Route::apiResource('categories', CategoryController::class)  
        ->only(['update','delete',])  
        ->middleware('auth:sanctum');  
});
```


### Check the Routes Out

Remember that you may list the routes the applicaiton has using the `php artisan route:list` on the CLI.

![assets/artisan-route-list-1.png](../assets/artisan-route-list-1.png)


# Testing Using Postman

This section has been moved to: [S07-Postman-and-APIs](Session-07/S07-Postman-and-APIs.md)


# Additional Learning

See [S06-Exercises-and-Additional-Learning](Session-06/S06-Exercises-and-Additional-Learning.md).

# References

- Albano, J. (2019, October 25). _Baeldung_. Baeldung. https://www.baeldung.com/rest-api-error-handling-best-practices
- Bello, G. (2024, February 8). _Best Practices for API Error Handling | Postman Blog_. Postman Blog. https://blog.postman.com/best-practices-for-api-error-handling/
- Gitlin, J. (2024, June 12). _API response codes: examples and error-handling strategies_. Merge.dev; Merge. https://www.merge.dev/blog/api-response-codes
- Gitlin, J. (2024, June 12). _API response codes: examples and error-handling strategies_. Merge.dev; Merge. https://www.merge.dev/blog/api-response-codes
- Gupta, L. (2018, May 30). _HTTP Status Codes_. REST API Tutorial. https://restfulapi.net/http-status-codes/
- Korop, P. (2019). _Laravel API Errors and Exceptions: How to Return Responses_. Laravel Daily. https://laraveldaily.com/post/laravel-api-errors-and-exceptions-how-to-return-responses
- Ploesser, K. (2022, July 8). _10 Error Status Codes When Building APIs For The First Time And How To Fix Them_. 10 Error Status Codes When Building APIs for the First Time and How to Fix Them | Moesif Blog. https://www.moesif.com/blog/technical/monitoring/10-Error-Status-Codes-When-Building-APIs-For-The-First-Time-And-How-To-Fix-Them/
- The Postman Team. (2023, September 20). _What Are HTTP Status Codes? | Postman Blog_. Postman Blog. https://blog.postman.com/what-are-http-status-codes/
- Umbraco. (2019, May 3). _What are HTTP status codes?_ Umbraco.com; Umbraco. https://umbraco.com/knowledge-base/http-status-codes/
- _Getting started - Scramble_. (2025). Dedoc.co. https://scramble.dedoc.co/usage/getting-started

 

 


- https://www.binaryboxtuts.com/php-tutorials/laravel-tutorials/how-to-make-laravel-12-rest-api/
- https://medium.com/@dev.muhammadazeem/building-a-restful-api-with-laravel-a-step-by-step-guide-d9ae6dca9873
- https://medium.com/@andreelm/laravel-api-documentation-with-scramble-best-practices-and-tutorial-317950599982
- https://laravel-news.com/scramble-laravel-api-docs



---
# Found a Problem?
 
If you spotted any problems (including missing details) in notes or other materials, then make sure you note that, and as a big help to your lecturer, you could fork the notes repository, create an issue, create a fix to the issue, and submit a pull request.



---

# END
