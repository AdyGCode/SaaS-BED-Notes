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
date created: 03 July 2024
date modified: 08 July 2024
created: 2024-07-31T07:52
updated: 2024-10-03T09:15
---

# Adding Roles and Permissions to an API

## <span style="color:#990000">Important</span>

This code has not been tested!

## Note

Remember that AI Generated Code is not 100% reliable, and as such you should check all code that is generated.

We **extremely strongly** advise that you write your test cases and your code by hand until such time as you are familiar with and able to explain your code without assistance from any AI or system such as Grammarly.

This session's notes were developed with the assistance of Mistral AI, and other resources. These include:

Mistral Conversation: https://chat.mistral.ai/chat/6b0872dd-1304-4e11-aedd-59fd82ffe810

Sure! Let's walk through the process of adding roles and permissions to a simple product listing application using Laravel 11 and Spatie's Permissions package.

### Step 1: Install Spatie's Permissions Package

First, you need to install the Spatie Permissions package via Composer. Open your terminal and run:

```bash
composer require spatie/laravel-permission
```

### Step 2: Publish the Configuration File

Next, publish the configuration file to customize the package settings:

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

### Step 3: Add Traits to User Model

In your `User` model, add the `HasRoles` trait to enable role and permission functionality:

```php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    // Other model code...
}
```

### Step 4: Create Roles and Permissions

You can create roles and permissions using a migration or a seeder. Let's use a seeder for simplicity.

Create a new seeder:

```bash
php artisan make:seeder RolesAndPermissionsSeeder
```

In the `RolesAndPermissionsSeeder`, define the roles and permissions:

```php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);

        // Create roles and assign permissions
        $superRole = Role::create(['name' => 'Super']);
        $superRole->givePermissionTo(Permission::all());

        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->givePermissionTo(['view products', 'create products', 'edit products', 'delete products']);

        $staffRole = Role::create(['name' => 'Staff']);
        $staffRole->givePermissionTo(['view products', 'create products', 'edit products']);

        $clientRole = Role::create(['name' => 'Client']);
        $clientRole->givePermissionTo(['view products']);

        $guestRole = Role::create(['name' => 'Guest']);
        $guestRole->givePermissionTo(['view products']);
    }
}
```

Run the seeder to populate the database:

```bash
php artisan db:seed --class=RolesAndPermissionsSeeder
```

### Step 5: Assign Roles to Users

You can assign roles to users in your application logic. For example, when creating a new user:

```php
use App\Models\User;
use Spatie\Permission\Models\Role;

$user = User::find(1); // Find the user by ID
$user->assignRole('Admin'); // Assign the 'Admin' role
```

### Step 6: Protect Routes with Middleware

To protect routes based on roles and permissions, you can use the provided middleware.

In your `routes/api.php` file, add the middleware to your routes:

```php
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:Admin'])->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'permission:view products'])->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
});
```

### Step 7: Check Permissions in Controllers

You can also check permissions directly in your controllers:

```php
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('view products')) {
            // Fetch and return products
        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->can('create products')) {
            // Create and return the new product
        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    }

    // Other controller methods...
}
```


## Extending to include a User Management API

Extend the API by providing endpoints for managing users and their roles. 

We'll create routes, controllers, and methods to handle user creation, updating, and assigning roles.

### Step 1: Create UserController

First, create a new controller for managing users:

```bash
php artisan make:controller UserController
```

### Step 2: Define Routes

In your `routes/api.php` file, define the routes for managing users and their roles:

```php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware(['auth:sanctum', 'role:Admin|Super'])->group(function () {
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::post('/users/{id}/roles', [UserController::class, 'assignRole']);
    Route::delete('/users/{id}/roles/{role}', [UserController::class, 'removeRole']);
});

Route::middleware(['auth:sanctum', 'role:Admin|Super|Staff'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
});
```

### Step 3: Implement UserController Methods

In the `UserController`, implement the methods to handle user management and role assignments:

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name', $user->name);
        $user->email = $request->input('email', $user->email);
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }

    public function assignRole(Request $request, $id)
    {
        $this->validate($request, [
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = User::findOrFail($id);
        $role = Role::findByName($request->role);
        $user->assignRole($role);

        return response()->json($user);
    }

    public function removeRole($id, $role)
    {
        $user = User::findOrFail($id);
        $role = Role::findByName($role);
        $user->removeRole($role);

        return response()->json($user);
    }
}
```

### Step 4: Test the API

You can now test the API endpoints using tools like Postman or cURL. Here are some example requests:

#### Create a User

```bash
curl -X POST http://your-app-url/api/users \
-H "Authorization: Bearer your-sanctum-token" \
-H "Content-Type: application/json" \
-d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "secret"
}'
```

#### Update a User

```bash
curl -X PUT http://your-app-url/api/users/1 \
-H "Authorization: Bearer your-sanctum-token" \
-H "Content-Type: application/json" \
-d '{
    "name": "John Doe Updated",
    "email": "john.updated@example.com"
}'
```

#### Assign a Role to a User

```bash
curl -X POST http://your-app-url/api/users/1/roles \
-H "Authorization: Bearer your-sanctum-token" \
-H "Content-Type: application/json" \
-d '{
    "role": "Admin"
}'
```

#### Remove a Role from a User

```bash
curl -X DELETE http://your-app-url/api/users/1/roles/Admin \
-H "Authorization: Bearer your-sanctum-token"
```

That's it! You've now extended the application to include API endpoints for managing users and their roles.


## Adding Roles/Permissions to API Endpoints

To implement the specified role-based access control, we need to adjust the middleware, routes, and controller methods accordingly. Here's how you can achieve this:

### Step 1: Update Middleware for Role-Based Access

First, create custom middleware to handle the specific role-based access control.

```bash
php artisan make:middleware RoleMiddleware
```

In the `RoleMiddleware`, define the logic for role-based access:

```php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if (!$user->hasRole($role)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
```

Register the middleware in `app/Http/Kernel.php`:

```php
protected $routeMiddleware = [
    // Other middleware...
    'role' => \App\Http\Middleware\RoleMiddleware::class,
];
```

### Step 2: Update Routes with Role-Based Middleware

Update the `routes/api.php` file to apply the role-based middleware:

```php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Super and Admin can access all features
Route::middleware(['auth:sanctum', 'role:Super|Admin'])->group(function () {
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::post('/users/{id}/roles', [UserController::class, 'assignRole']);
    Route::delete('/users/{id}/roles/{role}', [UserController::class, 'removeRole']);
});

// Staff can access put/patch, post, get, delete but with restrictions
Route::middleware(['auth:sanctum', 'role:Staff'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::post('/users/{id}/roles', [UserController::class, 'assignRole']);
    Route::delete('/users/{id}/roles/{role}', [UserController::class, 'removeRole']);
});

// Client can access put/patch, get their own account details only
Route::middleware(['auth:sanctum', 'role:Client'])->group(function () {
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
});

// Guest has no access to any of the User management
Route::middleware(['guest'])->group(function () {
    // No routes for guests
});
```

### Step 3: Update UserController Methods

In the `UserController`, add logic to enforce the specific restrictions for each role:

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('Staff')) {
            return response()->json(User::whereHas('roles', function ($query) {
                $query->where('name', 'Client');
            })->get());
        }

        return response()->json(User::all());
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->hasRole('Client') && Auth::id() != $id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return response()->json($user);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
        ]);

        $user = User::findOrFail($id);

        if (Auth::user()->hasRole('Client') && Auth::id() != $id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        if (Auth::user()->hasRole('Staff') && $user->hasRole(['Admin', 'Super', 'Staff'])) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $user->name = $request->input('name', $user->name);
        $user->email = $request->input('email', $user->email);
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->hasRole('Staff') && $user->hasRole(['Admin', 'Super', 'Staff'])) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        if (Auth::user()->hasRole('Client') || Auth::id() == $id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $user->delete();

        return response()->json(null, 204);
    }

    public function assignRole(Request $request, $id)
    {
        $this->validate($request, [
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = User::findOrFail($id);
        $role = Role::findByName($request->role);

        if (Auth::user()->hasRole('Staff') && $user->hasRole(['Admin', 'Super', 'Staff'])) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $user->assignRole($role);

        return response()->json($user);
    }

    public function removeRole($id, $role)
    {
        $user = User::findOrFail($id);
        $role = Role::findByName($role);

        if (Auth::user()->hasRole('Staff') && $user->hasRole(['Admin', 'Super', 'Staff'])) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $user->removeRole($role);

        return response()->json($user);
    }
}
```

### Step 4: Test the API

You can now test the API endpoints using tools like Postman or cURL. Here are some example requests:

#### Create a User (Admin/Super Only)

```bash
curl -X POST http://your-app-url/api/users \
-H "Authorization: Bearer your-sanctum-token" \
-H "Content-Type: application/json" \
-d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "secret"
}'
```

#### Update a User (Admin/Super/Staff, with restrictions)

```bash
curl -X PUT http://your-app-url/api/users/1 \
-H "Authorization: Bearer your-sanctum-token" \
-H "Content-Type: application/json" \
-d '{
    "name": "John Doe Updated",
    "email": "john.updated@example.com"
}'
```

#### Assign a Role to a User (Admin/Super Only)

```bash
curl -X POST http://your-app-url/api/users/1/roles \
-H "Authorization: Bearer your-sanctum-token" \
-H "Content-Type: application/json" \
-d '{
    "role": "Admin"
}'
```

#### Remove a Role from a User (Admin/Super Only)

```bash
curl -X DELETE http://your-app-url/api/users/1/roles/Admin \
-H "Authorization: Bearer your-sanctum-token"
```

That's it! You've now implemented the specified role-based access control for managing users and their roles in your Laravel application.
