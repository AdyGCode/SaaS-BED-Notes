# Building a Secure RESTful API with Laravel and Passport A Step-by-Step Guide

![](https://miro.medium.com/v2/resize:fit:700/0*_CJEOIhEH3t5HphJ)

Photo by [Emile Perron](https://unsplash.com/@emilep?utm_source=medium&utm_medium=referral) on [Unsplash](https://unsplash.com/?utm_source=medium&utm_medium=referral)

APIs have become an essential part of modern web development. They provide a seamless connection between applications, allowing them to share data and services. Laravel is a popular PHP web framework that is well-suited for building APIs. It provides a simple and elegant syntax, making it easy to develop RESTful APIs. In this tutorial, we will demonstrate how to build RESTful APIs with Laravel using Laravel Passport for authentication.

## Setting Up the Project

The first step in building an API with Laravel is to set up the project. To do this, you need to have PHP and Composer installed on your computer. If you don’t have them, you can download them from their respective websites.

Once you have PHP and Composer installed, you can create a new Laravel project by running the following command:

```
<span id="57dc" data-selectable-paragraph="">composer create-project --prefer-dist laravel/laravel api</span>
```

This will create a new Laravel project in a directory called `api`.

## Setting Up Passport

The next step is to set up Passport for authentication. Passport is a Laravel package that provides a simple way to implement OAuth2 authentication. To install Passport, run the following command:

```
<span id="3b46" data-selectable-paragraph="">composer require laravel/passport</span>
```

After installing Passport, you need to run the following command to set up the migration files:

```
<span id="7bf4" data-selectable-paragraph="">php artisan passport:install</span>
```

This command will create the necessary tables for Passport to work.

## Defining Routes for the API

To define the routes for the API, we need to create a `routes/api.php` file. In this file, we can define all the routes that the API will use. Here is an example of how to define a route:

```
<span id="5014" data-selectable-paragraph=""><span>&lt;?php</span><br><br><span>use</span> <span>Illuminate</span>\<span>Http</span>\<span>Request</span>;<br><span>use</span> <span>Illuminate</span>\<span>Support</span>\<span>Facades</span>\<span>Auth</span>;<br><span>use</span> <span>Illuminate</span>\<span>Support</span>\<span>Facades</span>\<span>Route</span>;<br><span>use</span> <span>App</span>\<span>Http</span>\<span>Controllers</span>\<span>Api</span>\<span>UserController</span>;<br><br><br><span>Route</span>::<span>post</span>(<span>'register'</span>, <span>'UserController@register'</span>);<br><br><br><span>Route</span>::<span>post</span>(<span>'login'</span>, <span>'UserController@login'</span>);<br><br><br><span>Route</span>::<span>group</span>([<span>'middleware'</span> =&gt; <span>'auth:api'</span>], function () {<br>    <br>    <span>Route</span>::<span>get</span>(<span>'user'</span>, function (Request <span>$request</span>) {<br>        <span>return</span> <span>$request</span>-&gt;<span>user</span>();<br>    });<br><br>    <br>    <span>Route</span>::<span>post</span>(<span>'logout'</span>, function (Request <span>$request</span>) {<br>        <span>$request</span>-&gt;<span>user</span>()-&gt;<span>token</span>()-&gt;<span>revoke</span>();<br>        <span>return</span> <span>response</span>()-&gt;<span>json</span>([<span>'message'</span> =&gt; <span>'Successfully logged out'</span>]);<br>    });<br>});</span>
```

## Creating Controller for the API

Next, we need to create controllers for the API. Controllers are responsible for processing incoming requests and returning responses. To create a new controller, run the following command:

```
<span id="f59d" data-selectable-paragraph="">php artisan make:controller UserController --api</span>
```

This will create a new controller in the `app/Http/Controllers` directory called `UserController`. The `--api` flag tells Laravel to generate a controller with methods that are suitable for building APIs.

## Implementing Registration and Login Functionality for the API

Now that we have set up the project and created the necessary components, we can implement registration and login functionality for the API.

## Registering a User

To register a new user, we need to create a `RegisterRequest` class that will be used to validate the incoming request. Here is an example of what the `RegisterRequest` class should look like:

To create a new request class, run the following command:

```
<span id="c355" data-selectable-paragraph="">php artisan make:request RegisterRequest</span>
```

This will create a new request class in the `app/Http/Requests`directory called `RegisterRequest`.

```
<span id="b32e" data-selectable-paragraph=""><span>&lt;?php</span><br><br><span>namespace</span> <span>App</span>\<span>Http</span>\<span>Requests</span>;<br><br><span>use</span> <span>Illuminate</span>\<span>Foundation</span>\<span>Http</span>\<span>FormRequest</span>;<br><br><span><span>class</span> <span>RegisterRequest</span> <span>extends</span> <span>FormRequest</span><br></span>{<br>    <span>public</span> <span><span>function</span> <span>rules</span>()<br>    </span>{<br>        <span>return</span> [<br>            <span>'name'</span> =&gt; <span>'required|string|max:255'</span>,<br>            <span>'email'</span> =&gt; <span>'required|email|unique:users|max:255'</span>,<br>            <span>'password'</span> =&gt; <span>'required|string|min:6|confirmed'</span>,<br>        ];<br>    }<br><br>    <span>protected</span> <span><span>function</span> <span>prepareForValidation</span>()<br>    </span>{<br>        <span>$this</span>-&gt;<span>merge</span>([<br>            <span>'password'</span> =&gt; <span>bcrypt</span>(<span>$this</span>-&gt;password),<br>        ]);<br>    }<br>}</span>
```

In the `rules` method, we define the validation rules for the incoming request. In this case, we require the `name`, `email`, and `password` fields, and we specify that the `email` field should be unique in the `users` table. We also require that the `password` field be at least six characters long and that the `password_confirmation` field matches the `password` field.

In the `prepareForValidation` method, we hash the password before the validation is performed. This ensures that the password is stored securely in the database.

Next, we need to create a `register` method in the `UserController` class to handle the registration of a new user. Here is an example of what the `register` method should look like:

```
<span id="d46a" data-selectable-paragraph=""><span>&lt;?php</span><br><br><span>namespace</span> <span>App</span>\<span>Http</span>\<span>Controllers</span>;<br><br><span>use</span> <span>App</span>\<span>Http</span>\<span>Requests</span>\<span>RegisterRequest</span>;<br><span>use</span> <span>App</span>\<span>Models</span>\<span>User</span>;<br><br><span><span>class</span> <span>UserController</span> <span>extends</span> <span>Controller</span><br></span>{<br>    <span>public</span> <span><span>function</span> <span>register</span>(<span>RegisterRequest <span>$request</span></span>)<br>    </span>{<br>        <span>$user</span> = <span>User</span>::<span>create</span>(<span>$request</span>-&gt;<span>validated</span>());<br><br>        <span>$token</span> = <span>$user</span>-&gt;<span>createToken</span>(<span>'authToken'</span>)-&gt;accessToken;<br><br>        <span>return</span> <span>response</span>()-&gt;<span>json</span>([<br>            <span>'user'</span> =&gt; <span>$user</span>,<br>            <span>'access_token'</span> =&gt; <span>$token</span><br>        ], <span>201</span>);<br>    }<br>}</span>
```

In this method, we first validate the incoming request using the `RegisterRequest` class that we created earlier. If the validation passes, we create a new `User` object with the validated data and save it to the database using the `create` method. We then create an access token using the `createToken` method provided by Passport, and return the user object and access token in the response.

## Logging In a User

To log in a user, we need to create a `LoginRequest` class that will be used to validate the incoming request. Here is an example of what the `LoginRequest` class should look like:

To create a LoginRequest class, run the following command:

```
<span id="a8b7" data-selectable-paragraph="">php artisan make:request LoginRequest</span>
```

This will create a new request class in the `app/Http/Requests`directory called `LoginRequest`.

```
<span id="fc2a" data-selectable-paragraph=""><span>&lt;?php</span><br><br><span>namespace</span> <span>App</span>\<span>Http</span>\<span>Requests</span>;<br><br><span>use</span> <span>Illuminate</span>\<span>Foundation</span>\<span>Http</span>\<span>FormRequest</span>;<br><br><span><span>class</span> <span>LoginRequest</span> <span>extends</span> <span>FormRequest</span><br></span>{<br>    <span>public</span> <span><span>function</span> <span>rules</span>()<br>    </span>{<br>        <span>return</span> [<br>            <span>'email'</span> =&gt; <span>'required|email'</span>,<br>            <span>'password'</span> =&gt; <span>'required|string'</span>,<br>        ];<br>    }<br>}</span>
```

In this case, we require the `email` and `password` fields to be present in the incoming request.

Next, we need to create a `login` method in the `UserController` class to handle the login of a user. Here is an example of what the `login` method should look like:

```
<span id="d0f6" data-selectable-paragraph=""><span>&lt;?php</span><br><br><span>namespace</span> <span>App</span>\<span>Http</span>\<span>Controllers</span>;<br><br><span>use</span> <span>App</span>\<span>Http</span>\<span>Requests</span>\<span>LoginRequest</span>;<br><span>use</span> <span>Illuminate</span>\<span>Support</span>\<span>Facades</span>\<span>Auth</span>;<br><br><span><span>class</span> <span>UserController</span> <span>extends</span> <span>Controller</span><br></span>{<br>    <span>public</span> <span><span>function</span> <span>login</span>(<span>LoginRequest <span>$request</span></span>)<br>    </span>{<br>        <span>if</span> (<span>Auth</span>::<span>attempt</span>(<span>$request</span>-&gt;<span>validated</span>())) {<br>            <span>$user</span> = <span>Auth</span>::<span>user</span>();<br>            <span>$token</span> = <span>$user</span>-&gt;<span>createToken</span>(<span>'authToken'</span>)-&gt;accessToken;<br><br>            <span>return</span> <span>response</span>()-&gt;<span>json</span>([<br>                <span>'user'</span> =&gt; <span>$user</span>,<br>                <span>'access_token'</span> =&gt; <span>$token</span><br>            ], <span>200</span>);<br>        } <span>else</span> {<br>            <span>return</span> <span>response</span>()-&gt;<span>json</span>([<br>                <span>'error'</span> =&gt; <span>'Unauthorized'</span><br>            ], <span>401</span>);<br>        }<br>    }<br>}</span>
```

In this method, we first validate the incoming request using the `LoginRequest` class that we created earlier. If the validation passes, we attempt to log in the user using the `attempt` method provided by Laravel's authentication system. If the login is successful, we create an access token and return the user object and access token in the response. If the login fails, we return an error response with a status code of 401.

## Testing the API Using Postman

Now that we have implemented registration and login functionality for the API, we can test it using Postman. To test the API, we will send HTTP requests to the API endpoints using Postman.

To get started, we need to make sure that our Laravel application is running. We can start the application by running the following command from the terminal:

```
<span id="5124" data-selectable-paragraph="">php artisan serve</span>
```

This command starts a local development server that listens on port 8000.

Now, let’s open Postman and create a new request by clicking on the “New” button in the top-left corner of the Postman window. We will use this request to register a new user.

## Registering a New User

To register a new user, we need to send a `POST` request to the `/api/register` endpoint with the user's name, email, and password in the request body.

In Postman, we can create a new `POST` request by selecting the `POST` method from the dropdown list next to the URL input field. We then need to enter the API endpoint URL in the URL input field:

```
<span id="2bb9" data-selectable-paragraph="">http://localhost:8000/api/register</span>
```

![](https://miro.medium.com/v2/resize:fit:700/1*7ApxW_8-5jK21ElmoXqVDA.png)

Example where we need to put url

Next, we need to add the request body. We can do this by selecting the “Body” tab below the URL input field, selecting “raw” as the input type, and choosing “JSON” from the dropdown list. We can then enter the following JSON data in the request body:

![](https://miro.medium.com/v2/resize:fit:700/1*DttJci5zSG5jFlqr6bREpQ.png)

Example how to insert data and call register api

```
<span id="d5bd" data-selectable-paragraph=""><span>{</span><br>    <span>"name"</span><span>:</span> <span>"John Doe"</span><span>,</span><br>    <span>"email"</span><span>:</span> <span>"john.doe@example.com"</span><span>,</span><br>    <span>"password"</span><span>:</span> <span>"secret"</span><span>,</span><br>    <span>"password_confirmation"</span><span>:</span> <span>"secret"</span><br><span>}</span></span>
```

This data represents the user’s name, email, and password.

We can then click on the “Send” button to send the request. If the request is successful, we should receive a response that contains the user object and access token:

```
<span id="7540" data-selectable-paragraph=""><span>{</span><br>    <span>"user"</span><span>:</span> <span>{</span><br>        <span>"id"</span><span>:</span> <span>1</span><span>,</span><br>        <span>"name"</span><span>:</span> <span>"John Doe"</span><span>,</span><br>        <span>"email"</span><span>:</span> <span>"john.doe@example.com"</span><span>,</span><br>        <span>"email_verified_at"</span><span>:</span> <span><span>null</span></span><span>,</span><br>        <span>"created_at"</span><span>:</span> <span>"2023-03-27T09:12:37.000000Z"</span><span>,</span><br>        <span>"updated_at"</span><span>:</span> <span>"2023-03-27T09:12:37.000000Z"</span><br>    <span>}</span><span>,</span><br>    <span>"access_token"</span><span>:</span> <span>"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY5YjY5YmY5YjY5NGQwZDRhNGQ1OTI5NTJjMDVmYjg1MTZkN2MzOGM2YmJkNzMwMjhlYzE1YzdlOTNkNDIyNzNlYjY2Y2JmNjg5ODc5ZjMyIn0.eyJhdWQiOiIxIiwianRpIjoiZjl ... "</span><br><span>}</span></span>
```

## Logging In a User

To log in a user, we need to send a `POST` request to the `/api/login` endpoint with the user's email and password in the request body.

In Postman, we can create a new `POST` request by selecting the `POST` method from the dropdown list next to the URL input field. We then need to enter the API endpoint URL in the URL input field:

![](https://miro.medium.com/v2/resize:fit:700/1*HA8IP6PU8jccTXdJ_rh7Zw.png)

```
<span id="ca4a" data-selectable-paragraph="">http://localhost:8000/api/login</span>
```

Next, we need to add the request body. We can do this by selecting the “Body” tab below the URL input field, selecting “raw” as the input type, and choosing “JSON” from the dropdown list. We can then enter the following JSON data in the request body:

![](https://miro.medium.com/v2/resize:fit:700/1*dPsL9Sg-Caofn7LhlTU4Mw.png)

```
<span id="f8b0" data-selectable-paragraph=""><span>{</span><br>    <span>"email"</span><span>:</span> <span>"john.doe@example.com"</span><span>,</span><br>    <span>"password"</span><span>:</span> <span>"secret"</span><br><span>}</span></span>
```

This data represents the user’s email and password.

We can then click on the “Send” button to send the request. If the request is successful, we should receive a response that contains the user object and access token:

```
<span id="ae7e" data-selectable-paragraph=""><span>{</span><br>    <span>"user"</span><span>:</span> <span>{</span><br>        <span>"id"</span><span>:</span> <span>1</span><span>,</span><br>        <span>"name"</span><span>:</span> <span>"John Doe"</span><span>,</span><br>        <span>"email"</span><span>:</span> <span>"john.doe@example.com"</span><span>,</span><br>        <span>"email_verified_at"</span><span>:</span> <span><span>null</span></span><span>,</span><br>        <span>"created_at"</span><span>:</span> <span>"2023-03-27T09:12:37.000000Z"</span><span>,</span><br>        <span>"updated_at"</span><span>:</span> <span>"2023-03-27T09:12:37.000000Z"</span><br>    <span>}</span><span>,</span><br>    <span>"access_token"</span><span>:</span> <span>"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImY5YjY5YmY5YjY5NGQwZDRhNGQ1OTI5NTJjMDVmYjg1MTZkN2MzOGM2YmJkNzMwMjhlYzE1YzdlOTNkNDIyNzNlYjY2Y2JmNjg5ODc5ZjMyIn0.eyJhdWQiOiIxIiwianRpIjoiZjl ... "</span><br><span>}</span></span>
```

## Accessing Protected Routes

Now that we have registered and logged in a user, we can access the protected API endpoints by including the access token in the request header. We can do this by adding a new header to the request with the key `Authorization` and the value `Bearer <access_token>`.

For example, to access the `/api/user` endpoint, we can create a new `GET` request in Postman, enter the following API endpoint URL in the URL input field:

```
<span id="64f8" data-selectable-paragraph="">http://localhost:8000/api/user</span>
```

Then, we need to add the authorization header to the request. We can do this by selecting the “Headers” tab below the URL input field and adding a new header with the key `Authorization` and the value `Bearer <access_token>`, where `<access_token>` is the access token we received when we logged in the user.

![](https://miro.medium.com/v2/resize:fit:700/1*-92iNCZmm1VbH-DC3KE4XA.png)

We can then click on the “Send” button to send the request. If the request is successful, we should receive a response that contains the user object:

```
<span id="cb0e" data-selectable-paragraph=""><span>{</span><br>    <span>"id"</span><span>:</span> <span>1</span><span>,</span><br>    <span>"name"</span><span>:</span> <span>"John Doe"</span><span>,</span><br>    <span>"email"</span><span>:</span> <span>"john.doe@example.com"</span><span>,</span><br>    <span>"email_verified_at"</span><span>:</span> <span><span>null</span></span><span>,</span><br>    <span>"created_at"</span><span>:</span> <span>"2023-03-27T09:12:37.000000Z"</span><span>,</span><br>    <span>"updated_at"</span><span>:</span> <span>"2023-03-27T09:12:37.000000Z"</span><br><span>}</span></span>
```

This shows that we have successfully accessed the protected API endpoint using the access token.

We can also test the `/api/logout` endpoint by sending a `POST` request with the access token in the request header. To do this, we can create a new `POST` request in Postman, enter the following API endpoint URL in the URL input field:

```
<span id="528c" data-selectable-paragraph="">http://localhost:8000/api/logout</span>
```

Then, we need to add the authorization header to the request. We can do this by selecting the “Headers” tab below the URL input field and adding a new header with the key `Authorization` and the value `Bearer <access_token>`, where `<access_token>` is the access token we received when we logged in the user.

![](https://miro.medium.com/v2/resize:fit:700/1*Rxk2qML2HG-vD0KLBM2UYw.png)

We can then click on the “Send” button to send the request. If the request is successful, we should receive a response that contains a message indicating that the user has been logged out:

```
<span id="a407" data-selectable-paragraph=""><span>{</span><br>    <span>"message"</span><span>:</span> <span>"Logged out successfully"</span><br><span>}</span></span>
```

## Conclusion

In this blog post, we have seen how to build RESTful APIs with Laravel using Laravel Passport for authentication. We have gone through the process of setting up a new Laravel project, installing and configuring Laravel Passport, defining routes, creating controllers and models, and implementing registration, login, and logout functionality for the API.

We have also seen how to test the API using Postman by sending HTTP requests to the API endpoints and verifying the responses.

Laravel Passport is a powerful tool for building secure and scalable API authentication systems. With its intuitive API and robust feature set, it can help developers build complex API authentication systems with ease.

## About me:

An experienced Code Debugger with a strong track record of identifying and resolving complex software issues. I aim to contribute my analytical skills and expertise in debugging tools to ensure efficient and reliable software operations and deliver high-quality software products that meet customer requirements.

> If you found this content valuable, please show your support by following me on Medium, LinkedIn, Twitter and GitHub. Your support will motivate me to create more informative content in the future. Don’t forget to give a clap or share this blog with others if you found it helpful!  
> 👏 [Medium](https://medium.com/@mwaqasiu) 👥 [LinkedIn](https://www.linkedin.com/in/mwaqasiu/) 🐦 [Twitter](https://twitter.com/mwaqasiu) 💻 [GitHub](https://github.com/mwaqasiu)