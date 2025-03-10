---
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
header: "![NMTAFE](/assets//Black-Red-Banner.svg)"
auto-scaling: true
size: 1920x1080
color: "#ccc"
backgroundColor: "#060606"
tags:
  - SaaS
  - APIs
  - Back-End
  - Journal
date created: 03 July 2024
date modified: 08 July 2024
created: 2024-07-31T07:52
updated: 2025-03-10T17:28
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

## Set Up Demo Laravel 12 App

Update the Laravel installer: 
```shell
composer require laravel
```

Create a new Laravel 12 project: 
```shell
laravel new SaaS-L12-API-Demo
```

Answer the prompts with:
- No
- SQLite
- Yes

Move into the 'Demo' folder: 
```shell
cd SaaS-L12-API-Demo
```

Install Sanctum: 
```shell
composer require laravel/sanctum
```

Install Scramble: 
```shell
composer require dedoc/scramble
```

> you can also do these in one go: 
> ```shell
> composer require laravel/sanctum dedoc/scramble
> ```

Publish Laravel API requirements:

```shell
php artisan install:api
```


## Run the Dev Server from Command Line

In MS Terminal split into two sessions

In new session:
```shell
cd SaaS-L12-API-Demo
```

and then execute 
```shell
composer run dev
```

## Publish Scramble Config

Publish the Scramble config:
```shell
php artisan vendor:publish --provider="Dedoc\Scramble\ScrambleServiceProvider" --tag="scramble-config"
```


### Open Scramble API Docs in browser to test

Open a new browser window and go to `http://localhost:8000/docs/api`

![](assets/S06-Using-Scramble-to-Document-an-API-20250310172017067.png)

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
        'email_verified_at' => now(),  
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


## Create a Model with the trimmings

execute: 

```shell
php artisan make:model Category --api -a
```

Open the `database\migrations\..._create_categories_table.php` migration.

Add to the UP method the two fields:
```php
$table->string('name',64)->required();  
$table->string('description')->nullable();
```


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

Execute the migration and seeders.

```shell
php artisan migrate
php artisan db:seed
```


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

![](assets/S06-Using-Scramble-to-Document-an-API-20250310172604676.png)



# References

- https://scramble.dedoc.co/usage/getting-started
- https://www.binaryboxtuts.com/php-tutorials/laravel-tutorials/how-to-make-laravel-12-rest-api/
- https://medium.com/@dev.muhammadazeem/building-a-restful-api-with-laravel-a-step-by-step-guide-d9ae6dca9873
- https://medium.com/@andreelm/laravel-api-documentation-with-scramble-best-practices-and-tutorial-317950599982
- https://laravel-news.com/scramble-laravel-api-docs



---
# Found a Problem?
 
If you spotted any problems (including missing details) in notes or other materials, then make sure you note that, and as a big help to your lecturer, you could fork the notes repository, create an issue, create a fix to the issue, and submit a pull request.



---

# END
