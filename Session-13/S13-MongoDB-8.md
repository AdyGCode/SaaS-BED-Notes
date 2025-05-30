---
banner: "![[Black-Red-Banner.svg]]"
created: 2024-07-31T07:52
updated: 2025-05-30T08:43
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
header: ICT50220 - Adv Prog - SaaS 2 - BED
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
  - Overview
  - MongoDB
  - NoSQL
---

# NoSQL 8

## Software as a Service - Back-End Development

### Session 13 MongoDB and Laravel

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


# Session 13

This session demonstrates the Laravel and MongoDB integration.


# MongoDB University Target Lessons

By this week you should have completed all the MongoDB University chapters.

If you have not done so, refer to the notes in [MongoDB-Learning-Path](../Session-09/S09-MongoDB-Learning-Path.md) for details on signing up for MongoDB University and the Course(s) that are to be undertaken for free.

> It is STRONGLY suggested that you update composer on a regular schedule using `composer self-update`


# Using MongoDB (and xDebug) with Laravel

We need xDebug and MongoDB drivers for our development work.

Here is how to download and install the required Windows based drivers.


## MongoDB PHP Driver

Head to the following and download the version of the drivers for MongoDB that match your version of PHP:

- https://github.com/mongodb/mongo-php-driver/releases/

Information on the drivers is found at:

- MongoDB PHP Drivers: https://www.mongodb.com/docs/drivers/php-drivers/
- Installation Details: https://www.php.net/manual/en/mongodb.installation.php

Extract the drivers and rename them to remove the version details.

For example, we are using `php-8.4.7-nts-Win32-vs17-x64`, so we downloaded files to suit this...

| Step                 | Filename                                      | New Filename        |
| -------------------- | --------------------------------------------- | ------------------- |
| Download File:       | php_mongodb-2.0.0-8.4-nts-vs17-x86_64.zip     |                     |
| Extract into Folder: | php_mongodb-2.0.0-8.4-nts-vs17-x86_64         |                     |
| Rename File:         | php_mongodb-2.0.0-8.4-nts-vs17-x86_64.dll.sig | php_mongodb.dll.sig |
| Rename File:         | php_mongodb-2.0.0-8.4-nts-vs17-x86_64.dll     | php_mongodb.dll     |
| Rename File:         | php_mongodb-2.0.0-8.4-nts-vs17-x86_64.pdb     | php_mongodb.pdb     |

We then move these renamed files into the appropriate `ext` folder:

- TAFE: `C:\ProgramData\Laragon\bin\php\php-VERSION\ext`
- BYOD/L3-06: `C:\Laragon\bin\php\php-VERSION\ext`

So, for PHP 8.4.7 Non Thread-Safe (compiled with VS17, 64bit), we moved the `php_mongodb.*` files into the folder `C:\ProgramData\Laragon\bin\php\php-8.4.7-nts-Win32-vs17-x64\ext`

We will enable the driver by editing PHP.INI in a moment...


## xDebug Driver

Head to the following and download the version of the drivers for xDebug that match your version of PHP:

- xDebug Downloads: https://xdebug.org/download

The download will be the DLL.

Rename the driver to remove any version details

For example, we are using `php-8.4.7-nts-Win32-vs17-x64`, so we downloaded the required `dll`.

| Step               | Details                                    |
| ------------------ | ------------------------------------------ |
| Download Location: | https://xdebug.org/download                |
| Download File:     | `php_xdebug-3.4.3-8.4-nts-vs17-x86_64.dll` |
| Rename File To:    | `php_xdebug.dll`                           |



We then move the renamed file into the appropriate `ext` folder:

- TAFE: `C:\ProgramData\Laragon\bin\php\php-VERSION\ext`
- BYOD/L3-06: `C:\Laragon\bin\php\php-VERSION\ext`

So, for PHP 8.4.7 Non Thread-Safe (compiled with VS17, 64bit), we moved the `php_xdebug.dll` file into the folder `C:\ProgramData\Laragon\bin\php\php-8.4.7-nts-Win32-vs17-x64\ext`

## Edit the PHP.INI 

Before you edit the `PHP.INI` file...

> You MUST rename the xDebug and MongoDB extensions.
> For example: > `extension=php_mongodb`

> ## ⚠️ Make sure you have the CORRECT version of the files for YOUR version of PHP!

Editing the `PHP.INI` file will happen for any version of PHP you are using.

If using Laragon you can Right Mouse Click on the Laragon UI, Highlight PHP, Highlight the PHP.INI option and click

This will usually open NotePad++ to edit the file.

![[Obsidian_urW6fZphBB.gif]]


Locate the section where we have the extensions listed that are available and enabled.

After the line "`extension=zip`" add the following:

```ini
[xdebug]
zend_extension=xdebug
xdebug.profiler_enable = 1
xdebug.profiler_output_dir = "C:\\ProgramData\laragon\\www\\xdebug"
xdebug.mode=coverage

[mongodb]
extension=php_mongodb
```


> **Note**: If you have installed xDebug previously, you may want to move the `zend_entension` from its original location to this new spot.
> 
> In many ways, keeping the extension and settings together can be very useful for quickly locating all related parts.

When you have done this, you should stop and start Apache, if you are using Laragon.



# Install Laravel MongoDB package

Before you ar able to use MongoDB within your application you will need to install the relevant composer package.

**IMPORTANT** - we presume you have your basic application started before this point. We go through creating a basic application in the section....


Using the composer command below will install the `mongodb/mongodb` PHP package along with the Laravel specific code, `mongodb/laravel-mongodb`.

```shell
composer require mongodb/laravel-mongodb
```

Whilst waiting for this to complete we may update the database configuration.

### Update `database.php` configuration

Locate the `database.php` in the `config` folder. 

Edit the file, adding the following to the connections section of the file:

```php
'mongodb' => [  
	'driver' => 'mongodb',  
	'host' => env('MONGODB_HOST', '127.0.0.1'),  
	'port' => env('MONGODB_PORT', 27017),  
//	'dsn' => env('MONGODB_URI', 'mongodb://localhost:27017'),
	'database' => env('MONGODB_DATABASE', 'your_database_name'),  
	'username' => env('MONGODB_USERNAME', ''),  
	'password' => env('MONGODB_PASSWORD', ''),  
	'options' => [  
		'database' => 'admin', // Default database for user authentication (if not needed, comment out)  
	],  
],
```

> **Important:**
> 
> If you are connecting to a remote MongoDB instance, such as one on MongoDB Atlas, then you MUST do the following
> 
> - comment out the `host` and `port` lines of the database config above
> - uncomment the `dsn` line of the database config

Now we need to edit the `.env` file

### Update `.env`

Edit your .env by adding the following **IMMEDIATELY** after the `DB_` section:

```ini

MONGODB_CONNECTION=mongodb  
MONGODB_HOST=127.0.0.1  
MONGODB_PORT=27017  
MONGODB_DATABASE=your_database_name  
MONGODB_USERNAME=  
MONGODB_PASSWORD=
MONGODB_URI="mongodb+srv://<username>:<password>@<cluster>.mongodb.net/<dbname>?retryWrites=true&w=majority"2MONGODB_DATABASE="laravel_app"
```

Update the `DB_CONNECTION` to use MongoDB if you will be using this as the primary Database type:

```ini
DB_CONNECTION=mongodb
```

> ### Important:
> 
> If you are connecting to a remote MongoDB instance, such as one on MongoDB Atlas, then you MUST do the following:
> 
> - comment out the `MONGODB_DATABASE`, `MONGODB_USER`, `MONGODB_PASSWORD`, `MONGODB_HOST` and `MONGODB_PORT` lines of the `.env`
> - uncomment the `MONGODB_URI` line of the database config, and
> - add the URI for your MongoDB instance:
> 	- `MONGODB_URI="mongodb+srv://<username>:<password>@<cluster>.mongodb.net/<dbname>?retryWrites=true&w=majority"2MONGODB_DATABASE="laravel_app"`
>  
> For example:
> 
> If the user was `EileenDover`, the password `SomeComplexPassword`,and the database was `laravel_application_db`, then the `MONGODB_URI` line will become:
>
> ```ini
> MONGODB_URI="mongodb+srv://eileendover:SomeComplexPassword@atlas-cluster-1854738.mongodb.net/laravel_application_db?retryWrites=true&w=majority"
> ```
 
## Using MongoDB connections 

To use the MongoDB connection we need to tell the Model where its data is stored.

To any model you wish to have on MongoDB add:

```php
protected $connection = 'mongodb';  
```

Also, to make it easier for the framework, you may specify the collection (these are the 'table' names in your migrations):

```php
 protected $collection = 'COLLECTION_NAME';  
```

### Namespace Changes in Model

Also, when you use the MongoDB connection, you will need to make a change to your use lines in the model.

Comment out the line:

```php

```

Add the new line:

```php

```

# Creating a MongoDB Based Laravel Application

Because Laravel 12 has changed the way it works with starter kits, we have developed a starter kit for use in this situation that uses Blade based pages, without the use of Livewire, React or such.

These steps take you through using this starter kit.

## Create GitHub Empty Repository 

Before you do anything else, create an EMPTY GitHub remote repository with the name of you application (APPLICATION_NAME).

> Remember that we are using MS Terminal with the Bash CLI from the Laragon Git 
> (more details at URL_FROM_HELPDESK)

## Creating the Base Application  Code

You have two options:
- Clone the kit
- Use the `laravel new` command


## Clone The Kit Method

Open Terminal and change into the locate you wish to use for developing (On TAFE systems this is usually `Source/Repos`).

Run the command (APPLICATION_NAME is the name of the application you will develop).

```shell
git clone https://github.com/AdyGCode/retro-blade-kit APPLICATION_NAME
```

For our example we will call it `laravel-12-and-mongodb`, so the command will be: 

```shell
git clone https://github.com/AdyGCode/retro-blade-kit laravel-12-and-mongodb
```

Now change into the new folder:

```shell
cd APPLICATION_NAME
```

e.g.
```shell
cd laravel-12-and-mongodb
```

We now need to change the remote repository details.

If you run `git remote -v` you will see:

```text
 git remote -v
origin  https://github.com/AdyGCode/retro-blade-kit (fetch)
origin  https://github.com/AdyGCode/retro-blade-kit (push)
```

To remove the remote use:

```shell
git remote remove origin
```

Now add your empty repository details to the remote:

```shell
git remote add origin https://YOUR-REPOSITORY-URL
```

For example: `https://github.com/adygcode/laravel-12-and-mongodb`

We are ready to commit and push to the remote:

```shell
git add .
git commit -m "init: Start application using AdyGCode/retro-starter-kit"
git push -u origin main
```

### Copy the `.env.example`

Duplicate the `.env.example` and rename to `.env`

```shell
cp .env.example .env
```


### Run the Application Key Generation

Execute:

```shell
php artisan key:generate
```

### Install the PHP and NodeJS Packages

We now need to install (and update) the Node and PHP packages using:

```shell
composer install
composer update
npm i
```

This takes a while, but once complete you are ready to go...

You are ready to [Install MongoDB packages ](#Install-MongoDB-packages)by skipping the next section.

## Laravel New Application Method

This method will only work once the starter kit has been added to the Laravel New Community starter kits repository (https://github.com/tnylea/laravel-new).


> ### Retro Starter Kit was not available when checked on 2025-05-20.


### Create Laravel App

Before we create the shell of the application, let's do a check if the Laravel installer or any of the required packages need updating:

```shell
composer global require laravel/installer
```

Now you may run the installer.

When you do, you may either replace `APPLICATION_NAME` with the name of the app, or leave it blank and be prompted for the details.


```shell
laravel new APPLICATION_NAME --using=retro-starter-kit
```


# Development Services

Before we commence our building, once we have all the above steps done we need to:

- update the `composer.json` file to include MailPit
- start the development server

### Add MailPit to the Dev Server

Open the `composer.json`.

Locate the "dev" item in the `scripts` section.

You have two choices... update the dev section, or duplicate and edit...

We will go for the latter.

Follow these steps:

- duplicate the `dev` section
- rename the copy to `dev-no-mail`
- Edit the `dev` section to become:

```json
"dev": [  
    "Composer\\Config::disableProcessTimeout",  
    "npx concurrently -c \"#93c5fd,#c4b5fd,#fb7185,#fdba74\" \"php artisan serve\" \"php artisan queue:listen --tries=1\" \"npm run dev\" \"mailpit --smtp=0.0.0.0:2525\" --names=server,queue,vite"],
```

You need to ensure that `mailpit.exe` is available in your System Environment Variables path, or have an alias set up to point at the correct spot. 

Details are available on the SQuASH Help Desk, an a quick animation to remind you:

![[ftmZq1dJwC.gif]]

Remember if you update the Environment Variables you MUST close and reopen Terminal or any application that uses the CLI.


# Set the Application Environment

Before we add any code to the application we need to update the `.env` and available database drivers.

### Edit `.env` 

Edit the `.env` and update the following properties to the values shown:

```ini
APP_NAME="Laravel 12 & MongoDB"  
APP_URL=http://localhost:8000  
APP_LOCALE=en_AU

```

Remember to also add the MongoDB items!

```ini
DB_CONNECTION=mongodb
  
MONGODB_CONNECTION=mongodb    
MONGODB_HOST=127.0.0.1    
MONGODB_PORT=27017    
MONGODB_DATABASE=your_database_name    
MONGODB_USERNAME=    
MONGODB_PASSWORD=  
# MONGODB_URI="mongodb+srv://<username>:<password>@<cluster>.mongodb.net/<dbname>?retryWrites=true&w=majority"2MONGODB_DATABASE="laravel_app"
```

### Add the `mongodb` section to the Database Config

Remember to add:

```php
'mongodb' => [    
    'driver' => 'mongodb',    
    'host' => env('MONGODB_HOST', '127.0.0.1'),    
    'port' => env('MONGODB_PORT', 27017),    
//  'dsn' => env('MONGODB_URI', 'mongodb://localhost:27017'),  
    'database' => env('MONGODB_DATABASE', 'your_database_name'),    
    'username' => env('MONGODB_USERNAME', ''),    
    'password' => env('MONGODB_PASSWORD', ''),    
    'options' => [    
       'database' => 'admin', // Default database for user authentication (if not needed, comment out)    
    ],    
],
```

To the connection part of the `config/database.php` file.

### Add MongoDB Package

Execute...

```shell
composer require mongodb/laravel-mongodb
```


### Start Dev Server

In the command line execute:

```shell
composer run dev
```


### Update the Version Control

At this point we should update the repository:

```shell
git add .
git commit -m "init: Start of application"
git push
```

# Adding the Post Feature

To begin we need to:
- create a migration
- create a seeder
- create a factory
- create a controller
- add the route(s)

### Create the Migration, Seeder, Factory, and Controller

We will shortcut the development by using switches when creating a Model:

```php
php artisan make:model Post --controller --factory --resource --migration --seed --pest --policy --requests
```

We can shorten this to:

```shell
php artisan make:model Post -ars --pest
```

## Edit the Migration

Open the `create_posts` migration (Remember the <kbd>SHIFT</kbd><kbd>SHIFT</kbd> method in PhpStorm).

Update the migration schema to include:

```php
    Schema::create('posts', function (Blueprint $table) {   
            $table->id('id');  
			$table->string('title');  
			$table->longText('body')->nullable();  
			$table->string('slug')->nullable();
            $table->timestamps();  
        });  
    }  
```

You are probably thinking... but MongoDB is schema-less... 

You are correct, but by having migrations you are also:
- documenting to your fellow developers the expected data structure
- able to switch to and from NoSQL to SQL if needed
- mix NoSQL and SQL databases in the same application

## Execute the migrations

As this is the first time we have run these migrations we will simply execute:

```shell
php artisan migrate
```

### Create the Web Route

Add a resourceful route to the `routes/web.php` file:

```php
Route::resource('posts', PostController::class);
```


### Edit the Post Model


```php
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
// use Illuminate\Database\Eloquent\Model;  
use MongoDB\Laravel\Eloquent\Model;
  
class Post extends Model  
{  
	use HasFactory;  
    protected $connection = 'mongodb';  
    protected $collection = 'posts';  
  
    protected $fillable = [  
        'id', 
        'title', 
        'body', 
        'slug',  
    ];  
}

```  


### Update Post Controller

Edit the post controller, and add this code to each of the indicated methods:

#### index

```php
$posts = Post::latest()->paginate(5);  

return view('posts.index',compact('posts'))
	->with('i', (request()->input('page', 1) - 1) * 5);  

```

#### create

```php
return view('posts.create');  
```

#### store

```php 
$validated = validate([  
    'title'=>['required', 'string',],  
    'body'=>['sometimes','nullable','string',],  
    'slug'=>['sometimes','nullable','string',],  
]);  
  
$post = Post::create($validated);

return redirect()
	->route('posts.index')
	->with('success','Post created successfully.');  

```

#### show

```php
return view('posts.show',compact('post'));  
```

#### edit

```php
return view('posts.edit',compact('post'));  
```

#### update

```php
    
$request->validate([  
	'name' => 'required',  
	'detail' => 'required',  
]);  

$post->update($request->all());  

return redirect()
	->route('posts.index')
	->with('success','Post updated successfully');  

```

#### destroy

```php
        $post->delete();  
    
        return redirect()
	        ->route('posts.index')
	        ->with('success','Post deleted successfully');  

```  


## Views for Post

Create
1. Navigate to the `resources/views` directory in your Laravel project.
2. Inside the `views` directory, create a folder named after your resource (e.g., "posts").
3. Inside the resource-specific folder, create the following Blade view files:

- `index.blade.php`: This file will display a list of all resource items.
- `create.blade.php`: Create a new resource item form.
- `edit.blade.php`: Edit an existing resource item form.
- `show.blade.php`: Display details of a specific resource item.

These Blade view files will be used to render the user interface for your CRUD operations.

### Add the folder

```shell
mkdir -p resources/views/posts
```

Create `resources/views/posts/index.blade.php`

```php

@extends('post.layout')  
   
@section('content')  
    <div class="row">  
        <div class="col-lg-12 margin-tb">  
            <div class="pull-left">  
                <h2>How to Create Laravel 11 MongoDB CRUD Operation - Techsolutionstuff</h2>  
            </div>  
            <div class="pull-right">  
                <a class="btn btn-success" href="{{ route('posts.create') }}"> Create New Post</a>  
            </div>  
        </div>  
    </div>  
     
    @if ($message = Session::get('success'))  
        <div class="alert alert-success">  
            <p>{{ $message }}</p>  
        </div>  
    @endif  
     
    <table class="table table-bordered">  
        <tr>  
            <th>No</th>  
            <th>Name</th>  
            <th>Details</th>  
            <th width="280px">Action</th>  
        </tr>  
        @foreach ($posts as $post)  
        <tr>  
            <td>{{ ++$i }}</td>  
            <td>{{ $post->name }}</td>  
            <td>{{ $post->detail }}</td>  
            <td>  
                <form action="{{ route('posts.destroy',$post->id) }}" method="POST">  
     
                    <a class="btn btn-info" href="{{ route('posts.show',$post->id) }}">Show</a>  
      
                    <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">Edit</a>  
     
                    @csrf  
                    @method('DELETE')  
        
                    <button type="submit" class="btn btn-danger">Delete</button>  
                </form>  
            </td>  
        </tr>  
        @endforeach  
    </table>  
    
    {!! $posts->links() !!}  
        
@endsection
```

**resources/views/posts/create.blade.php**

```php
@extends('post.layout')  
    
@section('content')  
<div class="row">  
    <div class="col-lg-12 margin-tb">  
        <div class="pull-left">  
            <h2>Add New Post</h2>  
        </div>  
        <div class="pull-right">  
            <a class="btn btn-primary" href="{{ route('posts.index') }}"> Back</a>  
        </div>  
    </div>  
</div>  
     
@if ($errors->any())  
    <div class="alert alert-danger">  
        <strong>Error!</strong> <br>  
        <ul>  
            @foreach ($errors->all() as $error)  
                <li>{{ $error }}</li>  
            @endforeach  
        </ul>  
    </div>  
@endif  
     
<form action="{{ route('posts.store') }}" method="POST">  
    @csrf  
    
     <div class="row">  
        <div class="col-xs-12 col-sm-12 col-md-12">  
            <div class="form-group">  
                <strong>Name:</strong>  
                <input type="text" name="name" class="form-control" placeholder="Name">  
            </div>  
        </div>  
        <div class="col-xs-12 col-sm-12 col-md-12">  
            <div class="form-group">  
                <strong>Detail:</strong>  
                <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>  
            </div>  
        </div>  
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">  
                <button type="submit" class="btn btn-primary">Submit</button>  
        </div>  
    </div>  
     
</form>  
@endsection
```

**resources/views/posts/edit.blade.php**

```php
@extends('post.layout')  
     
@section('content')  
    <div class="row">  
        <div class="col-lg-12 margin-tb">  
            <div class="pull-left">  
                <h2>Edit Post</h2>  
            </div>  
            <div class="pull-right">  
                <a class="btn btn-primary" href="{{ route('posts.index') }}"> Back</a>  
            </div>  
        </div>  
    </div>  
     
    @if ($errors->any())  
        <div class="alert alert-danger">  
            <strong>Error!</strong> <br>  
            <ul>  
                @foreach ($errors->all() as $error)  
                    <li>{{ $error }}</li>  
                @endforeach  
            </ul>  
        </div>  
    @endif  
    
    <form action="{{ route('posts.update',$post->id) }}" method="POST">  
        @csrf  
        @method('PUT')  
     
         <div class="row">  
            <div class="col-xs-12 col-sm-12 col-md-12">  
                <div class="form-group">  
                    <strong>Name:</strong>  
                    <input type="text" name="name" value="{{ $post->name }}" class="form-control" placeholder="Name">  
                </div>  
            </div>  
            <div class="col-xs-12 col-sm-12 col-md-12">  
                <div class="form-group">  
                    <strong>Detail:</strong>  
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $post->detail }}</textarea>  
                </div>  
            </div>  
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">  
              <button type="submit" class="btn btn-primary">Submit</button>  
            </div>  
        </div>  
     
    </form>  
@endsection
```

**resources/views/posts/show.blade.php**

```php
@extends('post.layout')  
@section('content')  
    <div class="row">  
        <div class="col-lg-12 margin-tb">  
            <div class="pull-left">  
                <h2> Show Post</h2>  
            </div>  
            <div class="pull-right">  
                <a class="btn btn-primary" href="{{ route('posts.index') }}"> Back</a>  
            </div>  
        </div>  
    </div>  
     
    <div class="row">  
        <div class="col-xs-12 col-sm-12 col-md-12">  
            <div class="form-group">  
                <strong>Name:</strong>  
                {{ $post->name }}  
            </div>  
        </div>  
        <div class="col-xs-12 col-sm-12 col-md-12">  
            <div class="form-group">  
                <strong>Details:</strong>  
                {{ $post->detail }}  
            </div>  
        </div>  
    </div>  
@endsection
```


Test the application and use MongoDB Compass to check that documents have been added to the collections.


# References

This tutorial was based on:

- Noumcpe. (2024, May 23). _How to Install and Setup MongoDB in Laravel 10 - Noumcpe - Medium_. Medium. https://medium.com/@noumcpe0007/how-to-install-and-setup-mongodb-in-laravel-10-10a65f03a07b
- Noumcpe. (2024, May 23). _How to Create Laravel 11 MongoDB CRUD Operation - Noumcpe - Medium_. Medium. https://medium.com/@noumcpe0007/how-to-create-laravel-11-mongodb-crud-operation-5eb05a11f9fc
- _MongoDB in Laravel: Short Guide for Beginners_. (2024). Laravel Daily. https://laraveldaily.com/post/mongodb-laravel-guide-beginners
- Roshandelpoor, M. (2024, February 8). _How to Use MongoDB (NoSQL) in Laravel - Mohammad Roshandelpoor - Medium_. Medium. https://medium.com/@mohammad.roshandelpoor/how-to-use-mongodb-in-laravel-24e615ee68de
- _MongoDB - Laravel 12.x - The PHP Framework For Web Artisans_. (2025). Laravel.com. https://laravel.com/docs/12.x/mongodb



# END

Next up - [S13 MongoDB 6 Practice Exercises](../Session-13/S13-MongoDB-6.md)
