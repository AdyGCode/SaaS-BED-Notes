---
created: 2025-09-09T09:12:49 (UTC +08:00)
tags: []
source: https://medium.com/@rahunn3/building-a-secure-api-with-laravel-role-based-access-control-using-spatie-permissions-5115e9d660ba
author: Bantawa Pawan
---

# Building a Secure API with Laravel: Role-Based Access Control using Spatie Permissions | by Bantawa Pawan | Medium

> ## Excerpt
> Building a Secure API with Laravel: Role-Based Access Control using Spatie Permissions Introduction In modern web applications, managing user access and permissions is crucial for security and …

---
[

![Bantawa Pawan](Building%20a%20Secure%20API%20with%20Laravel%20Role-Based%20Access%20Control%20using%20Spatie%20Permissions%20%20by%20Bantawa%20Pawan%20%20Medium/0n7CJXKo5o7gA60mC.)



](https://medium.com/@rahunn3?source=post_page---byline--5115e9d660ba---------------------------------------)

Press enter or click to view image in full size

![](Building%20a%20Secure%20API%20with%20Laravel%20Role-Based%20Access%20Control%20using%20Spatie%20Permissions%20%20by%20Bantawa%20Pawan%20%20Medium/1-_aaSHhbn8Z-PRmBo95V-w.png)

## Introduction

In modern web applications, managing user access and permissions is crucial for security and functionality. Role-Based Access Control (RBAC) provides a robust framework for controlling user access to different parts of your application. In this tutorial, we’ll explore how to implement RBAC in a Laravel API using the powerful Spatie Permission package.

### Why RBAC?

Role-Based Access Control simplifies access management by grouping permissions into roles and assigning these roles to users. Instead of managing individual permissions for each user, RBAC allows you to:

-   Create roles that represent different user types (e.g., Admin, Author, Viewer)
-   Define specific permissions for each role
-   Easily assign and manage user access through role assignments
-   Maintain cleaner, more maintainable code

### Why Spatie Permission?

The Spatie Permission package has become the de facto standard for implementing RBAC in Laravel applications because it:

-   Provides a simple, intuitive API
-   Integrates seamlessly with Laravel’s authorization system
-   Offers flexible permission inheritance
-   Supports multiple roles and direct permission assignments
-   Has excellent documentation and community support

### What We’ll Build

In this tutorial, we’ll create a blog API with role-based access control where:

-   Admins can manage all posts
-   Authors can create, edit, and delete their own posts
-   Viewers can only read posts

We’ll cover:

-   Setting up authentication with Laravel Sanctum
-   Implementing roles and permissions with Spatie
-   Creating secure API endpoints with proper authorization
-   Handling errors and unauthorized access gracefully

By the end of this tutorial, you’ll have a solid understanding of how to implement RBAC in your Laravel APIs and secure your application effectively.

## Project Setup

### Setting Up the Project

For our project, we’re using Laravel Breeze with the API-only option, which provides a lightweight authentication implementation perfect for API development. This gives us a solid foundation with:

-   API authentication scaffolding
-   Token-based authentication using Sanctum
-   Basic user registration and login endpoints

> _Note: Enter_ **_no_** _for option “Default database updated. Would you like to run the default database migrations? “ during breeze setup._

### Installing Spatie Permission

Let’s add role and permission management to our application. First, install the Spatie Permission package:

```
<span id="8260" data-selectable-paragraph="">composer require spatie/laravel-permission</span>
```

Publish the package configuration and migration

```
<span id="c3b3" data-selectable-paragraph="">php artisan vendor:publish --provider=<span>"Spatie\Permission\PermissionServiceProvider"</span></span>
```

### Configuration

Update the User model to use the HasRoles trait:

```
<span id="c4f3" data-selectable-paragraph=""><span>use</span> <span>Laravel</span>\<span>Sanctum</span>\<span>HasApiTokens</span>;<br><span>use</span> <span>Spatie</span>\<span>Permission</span>\<span>Traits</span>\<span>HasRoles</span>;<br><br><span><span>class</span> <span>User</span> <span>extends</span> <span>Authenticatable</span><br></span>{<br>    <span>use</span> <span>HasFactory</span>, <span>Notifiable</span>, <span>HasRoles</span>, <span>HasApiTokens</span>;<br>    <br>    <br>}</span>
```

## Database Structure

Let’s set up our database structure for the blog API with RBAC. We’ll need to handle posts along with the roles and permissions tables that Spatie provides.

### Post Model and Migration

Update the posts migration:

```
<span id="0294" data-selectable-paragraph=""><span>public</span> <span><span>function</span> <span>up</span>(): <span>void</span><br></span>{<br>    <span>Schema</span>::<span>create</span>(<span>'posts'</span>, function (Blueprint <span>$table</span>) {<br>        <span>$table</span>-&gt;<span>id</span>();<br>        <span>$table</span>-&gt;<span>string</span>(<span>'title'</span>);<br>        <span>$table</span>-&gt;<span>text</span>(<span>'content'</span>);<br>        <span>$table</span>-&gt;<span>foreignId</span>(<span>'user_id'</span>)-&gt;<span>constrained</span>()-&gt;<span>onDelete</span>(<span>'cascade'</span>);<br>        <span>$table</span>-&gt;<span>timestamps</span>();<br>    });<br>}</span>
```

Configure the Post model:

```
<span id="bdee" data-selectable-paragraph=""><span>&lt;?php</span><br><br><span>namespace</span> <span>App</span>\<span>Models</span>;<br><br><span>use</span> <span>Illuminate</span>\<span>Database</span>\<span>Eloquent</span>\<span>Factories</span>\<span>HasFactory</span>;<br><span>use</span> <span>Illuminate</span>\<span>Database</span>\<span>Eloquent</span>\<span>Model</span>;<br><br><span><span>class</span> <span>Post</span> <span>extends</span> <span>Model</span><br></span>{<br>    <span>use</span> <span>HasFactory</span>;<br><br>    <span>protected</span> <span>$fillable</span> = [<br>        <span>'title'</span>,<br>        <span>'content'</span>,<br>        <span>'user_id'</span><br>    ];<br><br>    <span>public</span> <span><span>function</span> <span>user</span>()<br>    </span>{<br>        <span>return</span> <span>$this</span>-&gt;<span>belongsTo</span>(<span>User</span>::<span>class</span>);<br>    }<br>}</span>
```

and add in User model:

```
<span id="eebc" data-selectable-paragraph="">    <br>   <span>public</span> <span><span>function</span> <span>posts</span>()<br>    </span>{<br>        <span>return</span> <span>$this</span>-&gt;<span>hasMany</span>(<span>Post</span>::<span>class</span>);<br>    }</span>
```

**Database Seeder**  
Create a seeder to set up initial roles and permissions:

```
<span id="848d" data-selectable-paragraph=""><span>&lt;?php</span><br><br><span>namespace</span> <span>Database</span>\<span>Seeders</span>;<br><br><span>use</span> <span>App</span>\<span>Models</span>\<span>User</span>;<br><span>use</span> <span>Illuminate</span>\<span>Database</span>\<span>Seeder</span>;<br><span>use</span> <span>Illuminate</span>\<span>Support</span>\<span>Collection</span>;<br><span>use</span> <span>Spatie</span>\<span>Permission</span>\<span>Models</span>\<span>Permission</span>;<br><span>use</span> <span>Spatie</span>\<span>Permission</span>\<span>Models</span>\<span>Role</span>;<br><br><span><span>class</span> <span>DatabaseSeeder</span> <span>extends</span> <span>Seeder</span><br></span>{<br>    <br>    <span>public</span> <span><span>function</span> <span>run</span>(): <span>void</span><br>    </span>{<br>        <span>$roles</span> = <span>$this</span>-&gt;<span>createRoles</span>();<br>        <span>$permissions</span> = <span>$this</span>-&gt;<span>createPermissions</span>();<br>        <span>$this</span>-&gt;<span>assignPermissionsToRoles</span>(<span>$roles</span>, <span>$permissions</span>);<br>        <span>$users</span> = <span>$this</span>-&gt;<span>createUsers</span>();<br>        <span>$this</span>-&gt;<span>assignRolesToUsers</span>(<span>$users</span>, <span>$roles</span>);<br>    }<br><br>    <span>private</span> <span><span>function</span> <span>createRoles</span>(): <span>array</span><br>    </span>{<br>        <span>return</span> [<br>            <span>'admin'</span> =&gt; <span>Role</span>::<span>firstOrCreate</span>([<span>'name'</span> =&gt; <span>'admin'</span>]),<br>            <span>'author'</span> =&gt; <span>Role</span>::<span>firstOrCreate</span>([<span>'name'</span> =&gt; <span>'author'</span>]),<br>            <span>'viewer'</span> =&gt; <span>Role</span>::<span>firstOrCreate</span>([<span>'name'</span> =&gt; <span>'viewer'</span>]),<br>        ];<br>    }<br><br>    <span>private</span> <span><span>function</span> <span>createPermissions</span>(): <span>Collection</span><br>    </span>{<br>        <span>$permissionNames</span> = [<br>            <span>'Read Post'</span>,<br>            <span>'Create Post'</span>,<br>            <span>'Edit Post'</span>,<br>            <span>'Delete Post'</span>,<br>        ];<br><br>        <span>foreach</span> (<span>$permissionNames</span> <span>as</span> <span>$name</span>) {<br>            <span>Permission</span>::<span>firstOrCreate</span>([<span>'name'</span> =&gt; <span>$name</span>]);<br>        }<br><br>        <span>return</span> <span>Permission</span>::<span>all</span>();<br>    }<br><br>    <span>private</span> <span><span>function</span> <span>assignPermissionsToRoles</span>(<span><span>array</span> <span>$roles</span>, Collection <span>$permissions</span></span>): <span>void</span><br>    </span>{<br>        <br>        <span>$roles</span>[<span>'author'</span>]-&gt;<span>syncPermissions</span>(<span>$permissions</span>);<br><br>        <br>        <span>$roles</span>[<span>'viewer'</span>]-&gt;<span>syncPermissions</span>(<br>            <span>$permissions</span>-&gt;<span>firstWhere</span>(<span>'name'</span>, <span>'Read Post'</span>)<br>        );<br>    }<br><br>    <span>private</span> <span><span>function</span> <span>createUsers</span>(): <span>array</span><br>    </span>{<br>        <span>$users</span> = [<br>            [<br>                <span>'name'</span> =&gt; <span>'Admin'</span>,<br>                <span>'email'</span> =&gt; <span>'admin@example.com'</span>,<br>                <span>'password'</span> =&gt; <span>'password'</span>,<br>                <span>'role'</span> =&gt; <span>'admin'</span>,<br>            ],<br>            [<br>                <span>'name'</span> =&gt; <span>'Author'</span>,<br>                <span>'email'</span> =&gt; <span>'author@example.com'</span>,<br>                <span>'password'</span> =&gt; <span>'password'</span>,<br>                <span>'role'</span> =&gt; <span>'author'</span>,<br>            ],<br>            [<br>                <span>'name'</span> =&gt; <span>'Author 1'</span>,<br>                <span>'email'</span> =&gt; <span>'author1@example.com'</span>,<br>                <span>'password'</span> =&gt; <span>'password'</span>,<br>                <span>'role'</span> =&gt; <span>'author'</span>,<br>            ],<br>            [<br>                <span>'name'</span> =&gt; <span>'Viewer'</span>,<br>                <span>'email'</span> =&gt; <span>'viewer@example.com'</span>,<br>                <span>'password'</span> =&gt; <span>'password'</span>,<br>                <span>'role'</span> =&gt; <span>'viewer'</span>,<br>            ],<br>        ];<br><br>        <span>$createdUsers</span> = [];<br>        <span>foreach</span> (<span>$users</span> <span>as</span> <span>$userData</span>) {<br>            <span>$user</span> = <span>User</span>::<span>create</span>([<br>                <span>'name'</span> =&gt; <span>$userData</span>[<span>'name'</span>],<br>                <span>'email'</span> =&gt; <span>$userData</span>[<span>'email'</span>],<br>                <span>'password'</span> =&gt; <span>bcrypt</span>(<span>$userData</span>[<span>'password'</span>]),<br>            ]);<br>            <br>            <span>if</span> (!<span>isset</span>(<span>$createdUsers</span>[<span>$userData</span>[<span>'role'</span>]])) {<br>                <span>$createdUsers</span>[<span>$userData</span>[<span>'role'</span>]] = [];<br>            }<br>            <span>$createdUsers</span>[<span>$userData</span>[<span>'role'</span>]][] = <span>$user</span>;<br>        }<br><br>        <span>return</span> <span>$createdUsers</span>;<br>    }<br><br>    <span>private</span> <span><span>function</span> <span>assignRolesToUsers</span>(<span><span>array</span> <span>$users</span>, <span>array</span> <span>$roles</span></span>): <span>void</span><br>    </span>{<br>        <span>foreach</span> (<span>$users</span> <span>as</span> <span>$role</span> =&gt; <span>$roleUsers</span>) {<br>            <br>            <span>foreach</span> (<span>$roleUsers</span> <span>as</span> <span>$user</span>) {<br>                <span>$user</span>-&gt;<span>assignRole</span>(<span>$roles</span>[<span>$role</span>]);<br>            }<br>        }<br>    }<br>}</span>
```

Run the migrations and seeders:

```
<span id="92fc" data-selectable-paragraph="">php artisan migrate &amp;&amp; php artisan <span>db</span>:seed</span>
```

After database seeding database tables should look like:

Press enter or click to view image in full size

![](Building%20a%20Secure%20API%20with%20Laravel%20Role-Based%20Access%20Control%20using%20Spatie%20Permissions%20%20by%20Bantawa%20Pawan%20%20Medium/1J81zevrUBcpipi9PKeR_pA.png)

Roles table

Press enter or click to view image in full size

![](Building%20a%20Secure%20API%20with%20Laravel%20Role-Based%20Access%20Control%20using%20Spatie%20Permissions%20%20by%20Bantawa%20Pawan%20%20Medium/1XX8aClSpln1C9hFv6WEFLA.png)

Permissions table

![](Building%20a%20Secure%20API%20with%20Laravel%20Role-Based%20Access%20Control%20using%20Spatie%20Permissions%20%20by%20Bantawa%20Pawan%20%20Medium/1WvnYtkLkAQqEh4p35iO5qg.png)

Roles has permissions

![](Building%20a%20Secure%20API%20with%20Laravel%20Role-Based%20Access%20Control%20using%20Spatie%20Permissions%20%20by%20Bantawa%20Pawan%20%20Medium/1Eo1zsHrymagxa1oG6Tg4Ug.png)

Model has roles

This sets up:

-   Posts table with user relationship
-   Roles (Admin, Author, Viewer)
-   Permissions (Read, Create, Edit, Delete)

## Implementing Authentication

In our Laravel API, we’ll implement a token-based authentication system using Laravel Sanctum. This section covers how to set up authentication endpoints for login and logout functionality.

The AuthenticatedSessionController handles user authentication with two main methods:

```
<span id="fc1a" data-selectable-paragraph=""><span>&lt;?php</span><br><br><span>namespace</span> <span>App</span>\<span>Http</span>\<span>Controllers</span>\<span>Auth</span>;<br><br><span>use</span> <span>App</span>\<span>Http</span>\<span>Controllers</span>\<span>Controller</span>;<br><span>use</span> <span>App</span>\<span>Http</span>\<span>Requests</span>\<span>Auth</span>\<span>LoginRequest</span>;<br><span>use</span> <span>App</span>\<span>Models</span>\<span>User</span>;<br><span>use</span> <span>Illuminate</span>\<span>Http</span>\<span>JsonResponse</span>;<br><span>use</span> <span>Illuminate</span>\<span>Http</span>\<span>Request</span>;<br><span>use</span> <span>Illuminate</span>\<span>Http</span>\<span>Response</span>;<br><span>use</span> <span>Illuminate</span>\<span>Support</span>\<span>Facades</span>\<span>Auth</span>;<br><br><span><span>class</span> <span>AuthenticatedSessionController</span> <span>extends</span> <span>Controller</span><br></span>{<br>    <br>    <span>public</span> <span><span>function</span> <span>store</span>(<span>LoginRequest <span>$request</span></span>): <span>JsonResponse</span><br>    </span>{<br>        <span>$validatedData</span> = <span>$request</span>-&gt;<span>validate</span>([<br>            <span>'email'</span> =&gt; [<span>'required'</span>, <span>'string'</span>, <span>'email'</span>],<br>            <span>'password'</span> =&gt; [<span>'required'</span>, <span>'string'</span>],<br>        ]);<br><br>        <span>$user</span> = <span>User</span>::<span>where</span>(<span>'email'</span>, <span>$request</span>-&gt;email)-&gt;<span>first</span>();<br><br>        <span>if</span>(!<span>Auth</span>::<span>attempt</span>(<span>$validatedData</span>)) {<br>            <span>return</span> <span>response</span>()-&gt;<span>json</span>([<br>                <span>'success'</span> =&gt; <span>false</span>,<br>                <span>'message'</span> =&gt; <span>'Login failed. Please check your credentials.'</span><br>            ], <span>401</span>);<br>        }<br><br>        <span>$token</span> = <span>$user</span>-&gt;<span>createToken</span>(<span>$user</span>-&gt;name)-&gt;plainTextToken;<br><br>        <span>return</span> <span>response</span>()-&gt;<span>json</span>([<br>            <span>'success'</span> =&gt; <span>true</span>,<br>            <span>'access_token'</span> =&gt; <span>$token</span>,<br>            <span>'user'</span> =&gt; <span>$user</span><br>        ], <span>200</span>);<br>    }<br><br>    <br>    <span>public</span> <span><span>function</span> <span>destroy</span>(<span>Request <span>$request</span></span>): <span>Response</span><br>    </span>{<br>        <span>Auth</span>::<span>guard</span>(<span>'web'</span>)-&gt;<span>logout</span>();<br><br>        <span>$request</span>-&gt;<span>session</span>()-&gt;<span>invalidate</span>();<br><br>        <span>$request</span>-&gt;<span>session</span>()-&gt;<span>regenerateToken</span>();<br><br>        <span>return</span> <span>response</span>()-&gt;<span>noContent</span>();<br>    }<br>}</span>
```

Use method in the api route

```
<span id="f6d2" data-selectable-paragraph="">Route::post(<span>'/login'</span>, [AuthenticatedSessionController::<span>class</span>, <span>'store'</span>]);<br>Route::post(<span>'/logout'</span>, [AuthenticatedSessionController::<span>class</span>, <span>'destroy'</span>])-&gt;middleware(<span>'auth:sanctum'</span>);</span>
```

## Building the Post API

In this section, we’ll implement a fully-featured Post API with role-based access control using Laravel’s Policy and Spatie’s permission system.

### Creating the Post Controller

First, create a resource controller:

```
<span id="0706" data-selectable-paragraph="">php artisan <span>make</span>:controller PostController --resource</span>
```

The controller implements CRUD operations with proper authorization:

```
<span id="c237" data-selectable-paragraph=""><span>&lt;?php</span><br><br><span>namespace</span> <span>App</span>\<span>Http</span>\<span>Controllers</span>;<br><br><span>use</span> <span>App</span>\<span>Models</span>\<span>Post</span>;<br><span>use</span> <span>Illuminate</span>\<span>Http</span>\<span>JsonResponse</span>;<br><span>use</span> <span>Illuminate</span>\<span>Http</span>\<span>Request</span>;<br><br><span><span>class</span> <span>PostController</span> <span>extends</span> <span>Controller</span><br></span>{<br><br>    <span>public</span> <span><span>function</span> <span>__construct</span>()<br>    </span>{<br>        <span>$this</span>-&gt;<span>authorizeResource</span>(<span>Post</span>::<span>class</span>, <span>'post'</span>);<br>    }<br><br>    <span>public</span> <span><span>function</span> <span>index</span>(): <span>JsonResponse</span><br>    </span>{<br>        <span>return</span> <span>response</span>()-&gt;<span>json</span>([<br>            <span>'success'</span> =&gt; <span>true</span>,<br>            <span>'data'</span> =&gt; <span>Post</span>::<span>latest</span>()-&gt;<span>get</span>()<br>        ]);<br>    }<br><br>    <span>public</span> <span><span>function</span> <span>store</span>(<span>Request <span>$request</span></span>): <span>JsonResponse</span><br>    </span>{<br>        <span>$request</span>-&gt;<span>validate</span>([<br>            <span>'title'</span> =&gt; <span>'required|string|max:255'</span>,<br>            <span>'content'</span> =&gt; <span>'required|string'</span>,<br>        ]);<br><br>        <span>$post</span> = <span>Post</span>::<span>create</span>([<br>            ...<span>$request</span>-&gt;<span>all</span>(),<br>            <span>'user_id'</span> =&gt; <span>auth</span>()-&gt;<span>id</span>()<br>        ]);<br><br>        <span>return</span> <span>response</span>()-&gt;<span>json</span>([<br>            <span>'success'</span> =&gt; <span>true</span>,<br>            <span>'message'</span> =&gt; <span>'Post created successfully'</span>,<br>            <span>'data'</span> =&gt; <span>$post</span><br>        ], <span>201</span>);<br>    }<br><br>    <span>public</span> <span><span>function</span> <span>show</span>(<span>Post <span>$post</span></span>): <span>JsonResponse</span><br>    </span>{<br>        <span>return</span> <span>response</span>()-&gt;<span>json</span>([<br>            <span>'success'</span> =&gt; <span>true</span>,<br>            <span>'data'</span> =&gt; <span>$post</span><br>        ]);<br>    }<br><br>    <span>public</span> <span><span>function</span> <span>update</span>(<span>Request <span>$request</span>, Post <span>$post</span></span>): <span>JsonResponse</span><br>    </span>{<br>        <span>$request</span>-&gt;<span>validate</span>([<br>            <span>'title'</span> =&gt; <span>'required|string|max:255'</span>,<br>            <span>'content'</span> =&gt; <span>'required|string'</span>,<br>        ]);<br>        <br>        <span>$post</span>-&gt;<span>update</span>([<br>            <span>'title'</span> =&gt; <span>$request</span>-&gt;title,<br>            <span>'content'</span> =&gt; <span>$request</span>-&gt;content<br>        ]);<br><br>        <span>return</span> <span>response</span>()-&gt;<span>json</span>([<br>            <span>'success'</span> =&gt; <span>true</span>,<br>            <span>'message'</span> =&gt; <span>'Post updated successfully'</span>,<br>            <span>'data'</span> =&gt; <span>$post</span><br>        ], <span>200</span>);<br>    }<br><br>    <span>public</span> <span><span>function</span> <span>destroy</span>(<span>Post <span>$post</span></span>): <span>JsonResponse</span><br>    </span>{<br>        <span>$post</span>-&gt;<span>delete</span>();<br><br>        <span>return</span> <span>response</span>()-&gt;<span>json</span>([<br>            <span>'success'</span> =&gt; <span>true</span>,<br>            <span>'message'</span> =&gt; <span>'Post deleted successfully'</span>,<br>        ]);<br>    }<br>}</span>
```

### Base Controller Update (Laravel 11 Requirement)

For authorizeResource to work in Laravel 11, update the base controller:

```
<span id="27f2" data-selectable-paragraph=""><span>&lt;?php</span><br><br><span>namespace</span> <span>App</span>\<span>Http</span>\<span>Controllers</span>;<br><span>use</span> <span>Illuminate</span>\<span>Foundation</span>\<span>Auth</span>\<span>Access</span>\<span>AuthorizesRequests</span>;<br><br><span>abstract</span> <span><span>class</span> <span>Controller</span> <span>extends</span> \<span>Illuminate</span>\<span>Routing</span>\<span>Controller</span><br></span>{<br>    <span>use</span> <span>AuthorizesRequests</span>;<br>}</span>
```

### Post Policy Implementation

Create a policy for the Post model:

```
<span id="1564" data-selectable-paragraph="">php artisan <span>make</span>:policy PostPolicy --model=Post</span>
```

**Important: Permission Naming Convention**  
The permission names in your policy must exactly match the names in your permissions table:

```
<span id="0ce6" data-selectable-paragraph=""><span><span>class</span> <span>PostPolicy</span><br></span>{<br>    <span>public</span> <span><span>function</span> <span>viewAny</span>(<span>User <span>$user</span></span>): <span>bool</span><br>    </span>{<br>        <span>return</span> <span>$user</span>-&gt;<span>can</span>(<span>'Read Post'</span>);    <br>    }<br><br>    <span>public</span> <span><span>function</span> <span>create</span>(<span>User <span>$user</span></span>): <span>bool</span><br>    </span>{<br>        <span>return</span> <span>$user</span>-&gt;<span>can</span>(<span>'Create Post'</span>);  <br>    }<br><br>    <span>public</span> <span><span>function</span> <span>update</span>(<span>User <span>$user</span>, Post <span>$post</span></span>): <span>bool</span><br>    </span>{<br>        <span>return</span> <span>$user</span>-&gt;<span>can</span>(<span>'Edit Post'</span>) &amp;&amp; <span>$user</span>-&gt;id === <span>$post</span>-&gt;user_id;  <br>    }<br><br>    <span>public</span> <span><span>function</span> <span>delete</span>(<span>User <span>$user</span>, Post <span>$post</span></span>): <span>bool</span><br>    </span>{<br>        <span>return</span> <span>$user</span>-&gt;<span>can</span>(<span>'Delete Post'</span>) &amp;&amp; <span>$user</span>-&gt;id === <span>$post</span>-&gt;user_id;  <br>    }<br>}</span>
```

### Permission Names in Database

The following permission names must exist in your permissions table:

-   Read Post
-   Create Post
-   Edit Post
-   Delete Post

These are created by our DatabaseSeeder, but it’s crucial to maintain this exact naming for the policy to work correctly.

**Giving all access to admin user  
**In AppServiceProvider.php

```
<span id="bd6d" data-selectable-paragraph="">    <span>public</span> <span><span>function</span> <span>boot</span>(): <span>void</span><br>    </span>{<br>        <span>ResetPassword</span>::<span>createUrlUsing</span>(function (<span>object</span> <span>$notifiable</span>, <span>string</span> <span>$token</span>) {<br>            <span>return</span> <span>config</span>(<span>'app.frontend_url'</span>).<span>"/password-reset/<span>$token</span>?email=<span>{$notifiable-&gt;getEmailForPasswordReset()}</span>"</span>;<br>        });<br><br>        <span>Gate</span>::<span>after</span>(function (<span>$user</span>, <span>$ability</span>) {<br>           <span>if</span>(<span>$user</span>-&gt;<span>hasRole</span>(<span>'admin'</span>)){<br>               <span>return</span> <span>true</span>;<br>           }<br>           <span>return</span> <span>false</span>;<br>        });<br>    }</span>
```

This is a global authorization gate that runs after all other authorization checks. It grants users with the ‘admin’ role full access to all actions, effectively making them super admins. The admin can bypass all permission checks and access any functionality in the application.

Finally use PostController in api route:

```
<span id="3609" data-selectable-paragraph=""><span>&lt;?php</span><br><br><span>use</span> <span>App</span>\<span>Http</span>\<span>Controllers</span>\<span>Auth</span>\<span>AuthenticatedSessionController</span>;<br><span>use</span> <span>App</span>\<span>Http</span>\<span>Controllers</span>\<span>PostController</span>;<br><span>use</span> <span>Illuminate</span>\<span>Http</span>\<span>Request</span>;<br><span>use</span> <span>Illuminate</span>\<span>Support</span>\<span>Facades</span>\<span>Route</span>;<br><br><br><span>Route</span>::<span>post</span>(<span>'/login'</span>, [<span>AuthenticatedSessionController</span>::<span>class</span>, <span>'store'</span>]);<br><span>Route</span>::<span>post</span>(<span>'/logout'</span>, [<span>AuthenticatedSessionController</span>::<span>class</span>, <span>'destroy'</span>])-&gt;<span>middleware</span>(<span>'auth:sanctum'</span>);<br><span>Route</span>::<span>middleware</span>([<span>'auth:sanctum'</span>])-&gt;<span>group</span>(function() {<br>    <span>Route</span>::<span>get</span>(<span>'/debug-user'</span>, function(Request <span>$request</span>) { <br>        <span>return</span> [<br>            <span>'user'</span> =&gt; <span>$request</span>-&gt;<span>user</span>(),<br>            <span>'roles'</span> =&gt; <span>$request</span>-&gt;<span>user</span>()-&gt;roles-&gt;<span>pluck</span>(<span>'name'</span>),<br>            <span>'permissions'</span> =&gt; <span>$request</span>-&gt;<span>user</span>()-&gt;<span>getPermissionsViaRoles</span>()<br>        ];<br>    });<br>    <span>Route</span>::<span>apiResource</span>(<span>'/posts'</span>, <span>PostController</span>::<span>class</span>);<br>    <span>Route</span>::<span>get</span>(<span>'/user'</span>, function (Request <span>$request</span>) {<br>        <span>return</span> <span>$request</span>-&gt;<span>user</span>();<br>    });<br>});</span>
```

This setup ensures:

-   All routes are protected by authentication
-   Each CRUD operation is authorized by the corresponding policy method
-   Permissions are properly checked against the database
-   Only post owners can update or delete their posts

## Error Handling

Since our API is consumed by frontend applications, we’ll replace Laravel’s default error pages with consistent JSON responses. This ensures that all errors are handled uniformly and can be properly processed by the frontend.

```
<span id="8729" data-selectable-paragraph=""><span>&lt;?php</span><br><br><span>use</span> <span>App</span>\<span>Http</span>\<span>Middleware</span>\<span>EnsureEmailIsVerified</span>;<br><span>use</span> <span>Illuminate</span>\<span>Auth</span>\<span>Access</span>\<span>AuthorizationException</span>;<br><span>use</span> <span>Illuminate</span>\<span>Database</span>\<span>Eloquent</span>\<span>ModelNotFoundException</span>;<br><span>use</span> <span>Illuminate</span>\<span>Foundation</span>\<span>Application</span>;<br><span>use</span> <span>Illuminate</span>\<span>Foundation</span>\<span>Configuration</span>\<span>Exceptions</span>;<br><span>use</span> <span>Illuminate</span>\<span>Foundation</span>\<span>Configuration</span>\<span>Middleware</span>;<br><span>use</span> <span>Illuminate</span>\<span>Validation</span>\<span>ValidationException</span>;<br><span>use</span> <span>Laravel</span>\<span>Sanctum</span>\<span>Http</span>\<span>Middleware</span>\<span>EnsureFrontendRequestsAreStateful</span>;<br><span>use</span> <span>Spatie</span>\<span>Permission</span>\<span>Middleware</span>\<span>PermissionMiddleware</span>;<br><span>use</span> <span>Spatie</span>\<span>Permission</span>\<span>Middleware</span>\<span>RoleMiddleware</span>;<br><span>use</span> <span>Spatie</span>\<span>Permission</span>\<span>Middleware</span>\<span>RoleOrPermissionMiddleware</span>;<br><span>use</span> <span>Symfony</span>\<span>Component</span>\<span>HttpKernel</span>\<span>Exception</span>\<span>MethodNotAllowedHttpException</span>;<br><span>use</span> <span>Symfony</span>\<span>Component</span>\<span>HttpKernel</span>\<span>Exception</span>\<span>NotFoundHttpException</span>;<br><br><span>return</span> <span>Application</span>::<span>configure</span>(<span>basePath</span>: <span>dirname</span>(<span>__DIR__</span>))<br>    -&gt;<span>withRouting</span>(<br>        <span>web</span>: <span>__DIR__</span>.<span>'/../routes/web.php'</span>,<br>        <span>api</span>: <span>__DIR__</span>.<span>'/../routes/api.php'</span>,<br>        <span>commands</span>: <span>__DIR__</span>.<span>'/../routes/console.php'</span>,<br>        <span>health</span>: <span>'/up'</span>,<br>    )<br>    -&gt;<span>withMiddleware</span>(function (Middleware <span>$middleware</span>) {<br>        <span>$middleware</span>-&gt;<span>api</span>(<span>prepend</span>: [<br>            <span>EnsureFrontendRequestsAreStateful</span>::<span>class</span>,<br>        ]);<br><br>        <span>$middleware</span>-&gt;<span>alias</span>([<br>            <span>'verified'</span> =&gt; <span>EnsureEmailIsVerified</span>::<span>class</span>,<br>        ]);<br><br>        <span>$middleware</span>-&gt;<span>alias</span>([<br>            <span>'role'</span> =&gt; <span>RoleMiddleware</span>::<span>class</span>,<br>            <span>'permission'</span> =&gt; <span>PermissionMiddleware</span>::<span>class</span>,<br>            <span>'role_or_permission'</span> =&gt; <span>RoleOrPermissionMiddleware</span>::<span>class</span>,<br>        ]);<br>    })<br>    -&gt;<span>withExceptions</span>(function (Exceptions <span>$exceptions</span>) {<br>        <span>$exceptions</span>-&gt;<span>render</span>(function(ModelNotFoundException <span>$e</span>) {<br>            <span>return</span> <span>response</span>()-&gt;<span>json</span>([<br>                <span>'success'</span> =&gt; <span>false</span>,<br>                <span>'message'</span> =&gt; <span>'Resource not found'</span><br>            ], <span>404</span>);<br>        });<br>        <span>$exceptions</span>-&gt;<span>render</span>(function(NotFoundHttpException <span>$e</span>) {<br>            <span>return</span> <span>response</span>()-&gt;<span>json</span>([<br>                <span>'success'</span> =&gt; <span>false</span>,<br>                <span>'message'</span> =&gt; <span>'Resource not found'</span><br>            ], <span>404</span>);<br>        });<br>        <span>$exceptions</span>-&gt;<span>render</span>(function(AuthorizationException <span>$e</span>) {<br>            <span>return</span> <span>response</span>()-&gt;<span>json</span>([<br>                <span>'success'</span> =&gt; <span>false</span>,<br>                <span>'message'</span> =&gt; <span>'You are not authorized to perform this action'</span><br>            ], <span>403</span>);<br>        });<br><br>        <span>$exceptions</span>-&gt;<span>render</span>(function(ValidationException <span>$e</span>) {<br>            <span>return</span> <span>response</span>()-&gt;<span>json</span>([<br>                <span>'success'</span> =&gt; <span>false</span>,<br>                <span>'message'</span> =&gt; <span>'Validation failed'</span>,<br>                <span>'errors'</span> =&gt; <span>$e</span>-&gt;<span>errors</span>()<br>            ], <span>422</span>);<br>        });<br>        <span>$exceptions</span>-&gt;<span>render</span>(function(MethodNotAllowedHttpException <span>$e</span>) {<br>            <span>return</span> <span>response</span>()-&gt;<span>json</span>([<br>                <span>'success'</span> =&gt; <span>false</span>,<br>                <span>'message'</span> =&gt; <span>'Method is not allowed for the requested route'</span><br>            ], <span>405</span>);<br>        });<br>        <span>$exceptions</span>-&gt;<span>render</span>(function(\<span>Throwable</span> <span>$e</span>) {<br>            <span>return</span> <span>response</span>()-&gt;<span>json</span>([<br>                <span>'success'</span> =&gt; <span>false</span>,<br>                <span>'message'</span> =&gt; <span>'An error occurred'</span>,<br>                <span>'error'</span> =&gt; <span>$e</span>-&gt;<span>getMessage</span>()<br>            ], <span>500</span>);<br>        });<br><br>    })-&gt;<span>create</span>();</span>
```

## Testing with Postman

## Conclusion

Our Laravel API with Role-Based Access Control (RBAC) implementation provides a robust and secure foundation for managing blog posts. Let’s summarize the key aspects:

### Permission Structure

**Admin Role**

-   Full access to all posts regardless of ownership
-   Can bypass all permission checks through global Gate
-   Perfect for content moderation and system management

**Author Role**

-   Can view all posts in the system
-   Create new posts
-   Edit and delete only their own posts
-   Cannot modify other authors’ content
-   Ideal for content creators

**Viewer Role**

-   Read-only access to all posts
-   Cannot create, edit, or delete posts
-   Perfect for regular users

### Technical Implementation Highlights

1.  Authentication

-   Secure token-based authentication with Laravel Sanctum
-   Clean JSON responses for login/logout
-   Protected API routes

2\. Authorization

-   Granular permission control with Spatie Permission
-   Policy-based access control
-   Ownership validation for content modification
-   Global admin access through Gate::after

3\. API Design

-   RESTful endpoints
-   Consistent JSON response structure
-   Comprehensive error handling
-   Clear separation of concerns

This implementation provides a solid foundation that can be extended to:

-   Add more roles and permissions
-   Include additional content types
-   Implement content moderation features
-   Add user management functionality

The combination of Laravel’s built-in features, Sanctum, and Spatie Permission creates a secure, scalable, and maintainable RBAC system for your API.

Repository:  
[https://github.com/bantawa04/laravel-rabc](https://github.com/bantawa04/laravel-rabc)
