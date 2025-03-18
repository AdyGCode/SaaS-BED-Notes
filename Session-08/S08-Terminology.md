---
created: 2025-03-04T08:33
updated: 2025-03-18T10:27
---
# Terminology Review

This set of notes is based on a conversation with "Mistral": https://chat.mistral.ai/chat/ed13236c-5c7e-4104-ab17-f90c30e22e8b

### 1) REST API Features

#### 1.1) HTTP Headers

HTTP headers are like the cover letter of a request or response. 

They provide additional information about the request or response, such as the type of data being sent (Content-Type), the length of the data (Content-Length), and authentication details (Authorization).

Example:

```http
POST /api/users/1/profile-photo HTTP/1.1
Host: example.com
Content-Type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW
Authorization: Bearer your_sanctum_token_here
Content-Length: 256000

```
#### 1.2) HTTP Request Anatomy

An HTTP request is made up of several parts:

- **Method**: The action you want to perform (e.g., GET, POST).
- **URL**: The address of the resource you're interacting with.
- **Headers**: Additional information about the request.
- **Body**: The data being sent to the server (optional, depending on the method).

Example:

```http
------WebKitFormBoundary7MA4YWxkTrZu0gW
Content-Disposition: form-data; name="profile_photo"; filename="profile.jpg"
Content-Type: image/jpeg

<binary data of the JPEG image>

------WebKitFormBoundary7MA4YWxkTrZu0gW--

```

#### 1.3) HTTP Response Anatomy

An HTTP response also has several parts:

- **Status Code**: A number indicating the result of the request (e.g., 200 for success, 404 for not found).
- **Headers**: Additional information about the response.
- **Body**: The data being sent back to the client.

See [S08 Ten Common HTTP Responses](S08-Ten-Common-HTTP-Responses.md) for examples of ten of the most common HTTP responses.


### 2) HTTP Methods and their features

- **Method**: The HTTP method (GET, POST, PUT, PATCH, DELETE, OPTIONS).
- **URL**: The endpoint you're interacting with (e.g., `/api/v1/users`).
- **Headers**: Additional information about the request.
    - `Host`: The domain of the server.
    - `Content-Type`: The type of data being sent (e.g., `application/json`).
    - `Authorization`: The Sanctum token used for authentication.
    - `Accept`: The type of data the client expects in the response.

#### 2.1) GET

The GET method is used to retrieve data from the server. It's like asking the server for information. For example, fetching a list of users.

```http
GET /api/v1/users HTTP/1.1
Host: example.com
Accept: application/json
Authorization: Bearer your_sanctum_token_here
```

#### 2.2) POST

The POST method is used to send data to the server to create a new resource. For example, creating a new user.

```http 
POST /api/v1/users HTTP/1.1
Host: example.com
Content-Type: application/json
Authorization: Bearer your_sanctum_token_here

{
  "name": "John Doe",
  "email": "john.doe@example.com",
  "password": "password123"
}

```

#### 2.3) PUT/PATCH

The PUT and PATCH methods are used to update an existing resource on the server. For example, updating a user's information.

PUT replaces *all* the current resource's data with new data.

```http 
PUT /api/v1/users/1 HTTP/1.1
Host: example.com
Content-Type: application/json
Authorization: Bearer your_sanctum_token_here

{
  "name": "John Doe",
  "email": "john.doe@example.com",
  "password": "newpassword123"
}

```

PATCH replaces *only* the updated parts of the resource's data.

```http 
PATCH /api/v1/users/1 HTTP/1.1
Host: example.com
Content-Type: application/json
Authorization: Bearer your_sanctum_token_here

{
  "email": "john.newemail@example.com"
}

```

#### 2.4) DELETE

The DELETE method is used to remove a resource from the server. For example, deleting a user.

```http 
DELETE /api/v1/users/1 HTTP/1.1
Host: example.com
Authorization: Bearer your_sanctum_token_here

```

#### 2.5) OPTIONS

The OPTIONS method is used to describe the communication options for the target resource. It's often used for CORS preflight requests.

```http 
OPTIONS /api/v1/users HTTP/1.1
Host: example.com
Authorization: Bearer your_sanctum_token_here

```

### 3) Features and different applications that apply to the HTTP network protocol

HTTP is the foundation of data communication on the web. It allows clients (like web browsers) to communicate with servers. Features include:

- **Statelessness**: Each request is independent of others.
- **Caching**: Responses can be stored to improve performance.
- **Authentication**: Mechanisms to verify the identity of users.

### 4) Language used in programming languages

#### 4.1) Sequences, Selections, Iterations

- **Sequences**: Executing statements one after another.
- **Selections**: Making decisions based on conditions (e.g., if-else statements).
- **Iterations**: Repeating a block of code multiple times (e.g., loops).

#### 4.2) Class, Method, Property

- **Class**: A blueprint for creating objects.
- **Method**: A function that belongs to a class.
- **Property**: A variable that belongs to a class.

#### 4.3) OOP

Object-Oriented Programming (OOP) is a programming paradigm that uses objects and classes. It helps in organizing code into reusable pieces.

#### 4.4) MVC

Model-View-Controller (MVC) is a design pattern that separates an application into three main components:

- **Model**: Handles data logic.
- **View**: Handles the display of data.
- **Controller**: Handles user input and updates the model and view accordingly.

### 5) CORS and the CORS methodology

CORS (Cross-Origin Resource Sharing) is a security feature implemented by web browsers to prevent web pages from making requests to a different domain than the one that served the web page. It helps in controlling how resources on a web server are shared with other domains.

### 6) Secure REST API with authentication and authorisation

To secure a REST API, you typically use:

- **Authentication**: Verifying the identity of the user (e.g., using tokens like JWT).
- **Authorization**: Determining what the authenticated user is allowed to do (e.g., using roles and permissions).

### 7) Documenting REST API work

Documenting a REST API involves creating clear and concise documentation that explains:

- **Endpoints**: The URLs and methods available.
- **Parameters**: The data required for each endpoint.
- **Responses**: The data returned by each endpoint.
- **Examples**: Sample requests and responses.

In Laravel, you can use tools like Swagger or Postman to generate and maintain API documentation.

By understanding these concepts, you'll be well-equipped to develop and maintain a REST API using Laravel version 11.