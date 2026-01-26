---
created: 2025-12-17T09:36:01 (UTC +08:00)
tags: []
source: https://medium.com/@rivanalamsyah/how-to-implement-roles-and-permissions-in-laravel-using-laravel-spatie-fb35d1e950cc
author: Waking the Fallen
---

# How to Implement Roles and Permissions in Laravel Using Laravel Spatie. | by Waking the Fallen | Medium

> ## Excerpt
> How to Implement Roles and Permissions in Laravel Using Laravel Spatie. “Roles and permissions aren’t just about security; they’re about crafting a seamless user experience where every action …

---

> **“Roles and permissions aren’t just about security; they’re about crafting a seamless user experience where every action is intentional and every access is justified.”**

Hey there, fellow developers! 😎 Let’s dive into something super important for making your Laravel applications more secure and well-structured: **Roles and Permissions**. Ever felt the pain of managing who can access what on your site? Well, Laravel Spatie is here to save the day. In this guide, we’ll take you through the nitty-gritty details of implementing roles and permissions using Laravel Spatie. So, buckle up, because by the end of this, your application will be more secure, organized, and ready to handle user access like a pro!

1.  **Understanding Roles and Permissions**

Before jumping into the code, let’s break down what roles and permissions actually mean.

-   **Role**: Think of roles as “positions” or “titles” within your application, like **admin**, **editor**, or **regular user**. A role is a way to group permissions for a specific kind of user.
-   **Permission**: These are the “abilities” or “rights” that dictate what a user can or cannot do. For example, an admin might have permissions to “edit posts” and “delete users,” while a regular user might only be allowed to “view posts.”

**2\. Installing Laravel Spatie**

The first step in our journey is installing the **Laravel Spatie** package, which is tailor-made for handling roles and permissions. Open your terminal and run the following command:

```shell
composer require spatie/laravel-permission
```

Once the package is installed, we need to publish the configuration file:

```shell
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

This command will create a configuration file at `config/permission.php` and generate migration files for the roles and permissions tables.

Next, we’ll migrate the tables into our database:

```shell
php artisan migrate

```

This migration creates the necessary tables (`roles`, `permissions`, and `model_has_roles`) to store our roles and permissions data.

**3\. Setting Up the User Model**

To make the **User** model use the Spatie package’s features, we need to add the **HasRoles** trait to it. Open the `User.php` file located in `App\Models` and include the trait:

```php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    // Other properties and methods...
}
```

By adding this trait, our User model can now leverage all the powerful methods provided by Spatie for managing roles and permissions.

**4\. Creating Roles and Permissions**

Now it’s time to create some roles and permissions. We can do this either through Tinker, artisan commands, or by using seeders. Let’s go with seeders to automate the process.

Here’s a sample seeder that creates roles and permissions:

```php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Create permissions
        $editPermission = Permission::create(['name' => 'edit articles']);
        $viewPermission = Permission::create(['name' => 'view articles']);

        // Assign permissions to roles
        $adminRole->givePermissionTo($editPermission, $viewPermission);
        $userRole->givePermissionTo($viewPermission);

        // Assign role to user
        $user = User::find(1); // Example user with ID 1
        $user->assignRole('admin');
    }
}
```

Run the seeder with the following command:

```shell
php artisan db:seed --class=RolePermissionSeeder
```

In this example, we’ve created two roles: **admin** and **user**. The **admin** role has permissions to edit and view articles, while the **user** role can only view articles. We’ve also assigned the **admin** role to a user with ID 1.

**5\. Configuring Middleware for Roles and Permissions**

To ensure that only authorized users can access certain routes, we’ll integrate roles and permissions with middleware. Middleware checks whether a user has the correct role or permission before allowing access to a route.

Here’s how you can protect routes with a role-based middleware:

```php
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    // Other routes only accessible by admins
});
```

And here’s how to use middleware to check for specific permissions:

```php
Route::group(['middleware' => ['permission:edit articles']], function () {
    Route::get('/articles/edit/{id}', [ArticleController::class, 'edit'])->name('articles.edit');
    // Other routes that require specific permissions
});
```

By using middleware, you can enforce role and permission checks at the route level, ensuring that only users with the proper authorization can access certain parts of your application.

**6\. Displaying Role-Based Content in Blade Templates**

To enhance user experience, you can tailor the UI based on the user’s role or permissions. This means showing or hiding certain elements depending on what the logged-in user is allowed to do.

For example, to show an “Admin Panel” link only to admin users:

```php
@if(auth()->user()->hasRole('admin'))
    <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
@endif
```

Or to display an “Edit Article” button only to users who can edit articles:

```php
@if(auth()->user()->can('edit articles'))
    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-primary">Edit Article</a>
@endif
```

This approach not only improves the UX but also adds an extra layer of security by preventing unauthorized users from seeing actions they can’t perform.

**7\. Testing and Debugging Roles and Permissions**

Testing is crucial to ensure that your roles and permissions are set up correctly. You can use **Artisan Tinker** to quickly test if roles and permissions are working as expected:

```shell
php artisan tinker
```

Inside Tinker, try assigning roles or checking permissions:

```php
$user = User::find(1);
$user->assignRole('admin');
$user->hasRole('admin'); // returns true
```

Additionally, you should create unit tests or feature tests to automate the verification of roles and permissions in your application.

**8\. Advanced Tips and Best Practices**

-   **Caching**: Spatie automatically caches roles and permissions to boost performance. If you update roles or permissions during runtime, make sure to clear the cache using `php artisan permission:cache-reset`.
-   **Guard Management**: Laravel Spatie supports multiple guards. If you’re working with more than one guard (e.g., `web`, `api`), make sure to configure them properly in `config/auth.php` and `config/permission.php`.
-   **Dynamic Roles and Permissions**: If your application requires dynamic roles (e.g., custom roles created by users), make sure to handle the creation and assignment of these roles and permissions carefully to avoid potential security issues.
-   **Database Structure**: Regularly review and optimize your roles and permissions tables, especially as your application scales. Proper indexing and efficient queries can help maintain performance.

**Conclusion**

Implementing roles and permissions in Laravel using Laravel Spatie is not as daunting as it might seem. With the steps outlined above, your application will be more secure, structured, and ready to manage user access like a pro. Don’t forget to explore other features of Spatie and Laravel to further enhance your app. Keep coding, and enjoy the process! 🚀
