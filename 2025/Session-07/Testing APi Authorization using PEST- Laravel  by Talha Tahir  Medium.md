---
created: 2025-09-02T10:22:21 (UTC +08:00)
tags: []
source: https://medium.com/@talha_tahir/testing-api-authorization-using-pest-laravel-085b16ca43ca
author: Talha Tahir
---

# Testing APi Authorization using PEST- Laravel | by Talha Tahir | Medium

> ## Excerpt
> Testing APi Authorization using PEST- Laravel
Ensuring Route Authorization in Laravel with Pest
When building secure web applications, the concepts of authentication and authorization are paramount …

---
[

![Talha Tahir](../assets/1WsOXJz0WGKkZTtDCqtL1tw.jpeg)



](https://medium.com/@talha_tahir?source=post_page---byline--085b16ca43ca---------------------------------------)

## Ensuring Route Authorization in Laravel with Pest

When building secure web applications, the concepts of authentication and authorization are paramount. While authentication verifies who a user is, authorization determines what that user can do. In this blog post, we’ll focus on the importance of authorization in Laravel applications and demonstrate how to ensure that all routes are properly authorized using Pest — a delightful PHP testing framework.

## Understanding Authorization

**Authorization** is the process that dictates user permissions within your application. It ensures that authenticated users can only access resources and perform actions for which they have been granted permission. Failing to implement robust authorization can lead to serious security vulnerabilities, data breaches, and a compromised user experience.

## Why is Authorization Important?

1.  **Data Security**: Authorization prevents unauthorized access to sensitive information. Proper checks ensure that only users with the right permissions can view or manipulate data.
2.  **Role-Based Access Control**: Effective authorization allows the implementation of role-based access control (RBAC), simplifying the management of user permissions based on their roles.
3.  **Compliance**: Many industries are subject to regulations requiring strict access controls. Proper authorization helps organizations comply with these laws.
4.  **User Experience**: A well-implemented authorization system enhances user experience by showing users only the features relevant to them.

## Common Authorization Pitfalls

Despite its significance, many developers overlook authorization:

-   **Assuming Authentication is Sufficient**: Just because a user is authenticated doesn’t mean they should have access to everything.
-   **Hardcoding Permissions**: This approach can lead to errors and make it difficult to manage permissions.
-   **Inconsistent Implementation**: Inconsistent authorization checks can leave some parts of the application vulnerable.

## Setting Up the Test with Pest

In our Laravel application, we want to ensure that all routes with the prefix `api` and the `auth:sanctum` middleware are properly authorized. We'll create a Pest test to verify that each relevant route’s controller method contains a guard statement.

## Step 1: Create the Test File

First, create a new Pest test file:bCopy cod

```
<span id="3858" data-selectable-paragraph="">php artisan make:<span>test</span> AuthorizationTest --pest</span>
```

Now, open the newly created test file and add the following code:phCopy code

## Step 2: Write the Test

```
<span id="af63" data-selectable-paragraph=""><span>&lt;?php</span><br><br><span>use</span> <span>Illuminate</span>\<span>Routing</span>\<span>Router</span>;<br><br><span>it</span>(<span>'ensures all api-prefixed routes with auth:sanctum middleware use Gate'</span>, function () {<br>    <span>$router</span> = <span>app</span>(<span>Router</span>::<span>class</span>);<br><br>    <br>    <span>$routes</span> = <span>collect</span>(<span>$router</span>-&gt;<span>getRoutes</span>())-&gt;<span>filter</span>(function (<span>$route</span>) {<br>        <span>return</span> <span>str_starts_with</span>(<span>$route</span>-&gt;<span>uri</span>(), <span>'api/'</span>) &amp;&amp; <span>in_array</span>(<span>'auth:sanctum'</span>, <span>$route</span>-&gt;<span>middleware</span>());<br>    });<br><br><br>    <br>    <span>expect</span>(<span>$routes</span>-&gt;<span>isNotEmpty</span>())-&gt;<span>toBeTrue</span>();<br>    <span>$skipControllers</span> = [];<br><br>    <br>    <span>$routes</span>-&gt;<span>each</span>(function (<span>$route</span>) <span>use</span> ($<span>skipControllers</span>) {<br>        $<span>action</span> = $<span>route</span>-&gt;<span>getAction</span>();<br><br>        <br>        <span>expect</span>(<span>$action</span>[<span>'uses'</span>])-&gt;<span>toBeString</span>();<br><br>        <br>        [<span>$controller</span>, <span>$method</span>] = <span>explode</span>(<span>'@'</span>, <span>$action</span>[<span>'uses'</span>]);<br><br><br>        <br>        <span>if</span> (!<span>method_exists</span>(<span>$controller</span>, <span>$method</span>) ||  <span>in_array</span>(<span>$controller</span>, <span>$skipControllers</span>)) {<br>            <span>return</span>; <br>        }<br><br>        <br>        <span>$reflector</span> = <span>new</span> <span>ReflectionMethod</span>(<span>$controller</span>, <span>$method</span>);<br>        <span>$methodContent</span> = <span>file</span>(<span>$reflector</span>-&gt;<span>getFileName</span>());<br><br>        <span>$methodLines</span> = <span>array_slice</span>(<span>$methodContent</span>, <span>$reflector</span>-&gt;<span>getStartLine</span>() - <span>1</span>, <span>$reflector</span>-&gt;<span>getEndLine</span>() - <span>$reflector</span>-&gt;<span>getStartLine</span>());<br>        <span>$methodBody</span> = <span>implode</span>(<span>''</span>, <span>$methodLines</span>);<br><br><br>         <br>         <span>preg_match</span>(<span>'/{(.*)}/s'</span>, <span>$methodBody</span>, <span>$matches</span>);<br>         <span>$methodBodyInsideBraces</span> = <span>$matches</span>[<span>1</span>] ?? <span>''</span>;<br><br><br>        <br>        <span>$codeWithoutComments</span> = <span>trim</span>(<span>preg_replace</span>([<span>'!/\*.*?\*/!s'</span>, <span>'/\/\/[^\n]*/'</span>], <span>''</span>, <span>$methodBodyInsideBraces</span>));<br><br><br>        <br>        <span>if</span> (<span>empty</span>(<span>$codeWithoutComments</span>)) {<br>            <span>return</span>; <br>        }<br><br>        <br><br>        <span>if</span> (<span>strpos</span>(<span>$methodBody</span>, <span>'Gate'</span>) === <span>false</span>) {<br>            <br>            <span>$message</span> = <span>"Failed asserting that the method [<span>{$controller}</span>::<span>{$method}</span>] contains 'Gate'."</span>;<br>            <span>throw</span> <span>new</span> <span>Exception</span>(<span>$message</span>);<br>        }<br>    });<br>});</span>
```

## Explanation of the Test

1.  **Route Collection**: We gather all routes that have the `shop` prefix and utilize the `auth:sanctum` middleware.
2.  **Route Assertions**: We ensure that at least one relevant route exists.
3.  **Controller Method Inspection**: For each route, we inspect the corresponding controller method using PHP’s Reflection API.
4.  **Method Body Extraction**: We extract the method body and remove comments to check for actual executable PHP code.
5.  **Guard Verification**: Finally, we verify that the method includes a guard statement, ensuring that proper authorization checks are in place.

## Running the Test

To execute the test, simply run:

```
<span id="563b" data-selectable-paragraph="">./vendor/bin/pest</span>
```

Pest will run the test, and you’ll see output indicating whether the test passed or failed. This feedback helps ensure that your routes are properly secured.

## Conclusion

Authorization is a crucial component of web application security that must not be neglected. While authentication verifies the identity of users, authorization ensures that they can only access the resources and functionalities they are permitted to.

## Get Talha Tahir’s stories in your inbox

Join Medium for free to get updates from this writer.

By using Pest to test your routes, you can maintain a robust authorization system, protecting sensitive data and ensuring compliance with security best practices. This proactive approach not only secures your application but also enhances the overall user experience.

Take the time to implement thorough authorization checks and leverage testing frameworks like Pest to keep your Laravel applications safe and secure.

You can follow me on https//x.com/talha\_wish or [https://pinkary.com/@talha](https://pinkary.com/@talha)
