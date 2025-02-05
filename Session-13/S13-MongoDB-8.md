---
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
header: ICT50220 - Adv Prog - SaaS 2 - BED
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
  - Overview
  - MongoDB
  - NoSQL
created: 2024-07-31T07:52
updated: 2024-11-25T09:27
---

# NoSQL 8

## Software as a Service - Back-End Development

### Diploma of Information Technology (Advanced Programming)  

### Diploma of Information Technology (Back-End Development)

### Session 13

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

If you have not done so, refer to the notes in [MongoDB-Learning-Path](../Session-09/S09-MongoDB-Learning-Path) for details on signing up for MongoDB University and the Course(s) that are to be undertaken for free.


# Using MongoDB with Laravel

- Install MongoDB PHP Driver

Windows PHP 8.3 Thread Safe MongoDB Drivers (plus xdebug)
![](../assets/php-8.3-ext-mongodb-xdebug.zip)

Uncompress and then move the DLLs to the `laragon/bin/php/php-xxxx/ext` folder.


### Edit the PHP.INI 

This has to happen for any version of PHP you are using.

Move to the end of the `.ini` file and add teh lines below:

> NOte: If you have installed xDebug previously, you may want to move the `zend_entension` from its original location to this new spot.
> In many ways, keeping the extension and settings together can be very useful for quickly locating all related parts.

```
[xdebug]
zend_extension=xdebug
xdebug.profiler_enable = 1
xdebug.profiler_output_dir = "C:\\ProgramData\laragon\\www\\xdebug"
xdebug.mode=coverage

[mongodb]
extension=php_mongodb.dll
```

When you have done this, you should stop and start Apache, if you are using Laragon.

### Create Laravel App

Before we create the shell of the application, let's do a check if the laravel installer or any of the required packages need updating:

```shell
composer global require laravel/installer
```

Now you may run the installer.

When you do, you may either replace `APPLICATION_NAME` with the name of the app, or leave it blank and be prompted for the details.


```shell
laravel new APPLICATION_NAME
```


### Install MongoDB packages

```shell

composer require mongodb/mongodb mongodb/laravel-mongodb

```

### Update `database.php` configuration

Locate the `database.php` in the config folder. Edit the file. Add the following to the connections .

```php
'mongodb' => [  
	'driver' => 'mongodb',  
	'host' => env('MONGODB_HOST', '127.0.0.1'),  
	'port' => env('MONGODB_PORT', 27017),  
	'database' => env('MONGODB_DATABASE', 'your_database_name'),  
	'username' => env('MONGODB_USERNAME', ''),  
	'password' => env('MONGODB_PASSWORD', ''),  
	'options' => [  
		'database' => 'admin', // Default database for user authentication (if not needed, comment out)  
	],  
],
```

### Update `.env`

```ini

MONGODB_CONNECTION=mongodb  
MONGODB_HOST=127.0.0.1  
MONGODB_PORT=27017  
MONGODB_DATABASE=your_database_name  
MONGODB_USERNAME=your_username  
MONGODB_PASSWORD=your_password

DB_CONNECTION=mongodb

```

To any model you wish to have on MongoDB add:

```php
protected $connection = 'mongodb';  
```


> TODO: Check on `mongodb+srv` connections

You may also give the collection name using:

```php
 protected $collection = 'COLLECTION_NAME';  
```

## A Blog Quick Demo

### Create a Migration

Now, we will create a migration for the **posts** table using the Laravel PHP Artisan command.

```php
php artisan make:migration create_posts_table --create=posts
```

Update the migration schema to include:

```php
    Schema::create('posts', function (Blueprint $table) {   
            $table->bigIncrements('id');  
			$table->string('title');  
			$table->longText('body')->nullable();  
			$table->string('slug')->nullable();
            $table->timestamps();  
        });  
    }  
```

Execute the migration:

```shell
php artisan migrate
```

> **IMPORTANT:**
> There could be a problem with creating and using seeder classes.
> If you encounter this, please use alternative ways to seed your database.


### Create the Web Route

Add a resourceful route to the `routes/web.php` file:

```php
Route::resource('posts', PostController::class);
```


### Create Post Controller and Model


Create a new controller and the Post model stubs using:

```shell
php artisan make:controller PostController --resource --model=Post
```

### Update the Post Model

```php
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
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

**resources/views/posts/layout.blade.php**

<!DOCTYPE html>  
<html>  
<head>  
    <title>How to Create Laravel 11 MongoDB CRUD Operation - Techsolutionstuff</title>  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">  
</head>  
<body>  
    
<div class="container" style="margin-top: 15px;">  
    @yield('content')  
</div>  
     
</body>  
</html>

**resources/views/posts/index.blade.php**

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

**resources/views/posts/create.blade.php**

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

**resources/views/posts/edit.blade.php**

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

**resources/views/posts/show.blade.php**

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

**Step 8: Run Laravel 11 MongoDB CRUD Operations**

Now, we will run the laravel 11 application using the following command.

https://medium.com/@noumcpe0007/how-to-create-laravel-11-mongodb-crud-operation-5eb05a11f9fc

https://medium.com/@noumcpe0007/how-to-install-and-setup-mongodb-in-laravel-10-10a65f03a07b

# END

Next up - [S13 MongoDB 6 Practice Exercises](Session-13/S13-MongoDB-6.md)
