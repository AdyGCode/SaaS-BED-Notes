Notes based on conversation with Mistral: https://chat.mistral.ai/chat/ed13236c-5c7e-4104-ab17-f90c30e22e8b

Ten of the most commonly obtained HTTP response codes along with examples of their use when accessing an API via endpoints beginning with `api/v1/products`:

### 1. 200 OK

**Description**: The request was successful.
**Example**: Fetching a list of products.

Request made:

```http
GET /api/v1/products HTTP/1.1
Host: example.com
Authorization: Bearer your_sanctum_token_here
```

Response:

```http
HTTP/1.1 200 OK
Content-Type: application/json

[
  {
    "id": 1,
    "name": "Product A",
    "price": 10.00
  },
  {
    "id": 2,
    "name": "Product B",
    "price": 20.00
  }
]
```

### 2. 201 Created

**Description**: The request was successful and a new resource was created.
**Example**: Creating a new product.

Request made:

```http
POST /api/v1/products HTTP/1.1
Host: example.com
Content-Type: application/json
Authorization: Bearer your_sanctum_token_here

{
  "name": "Product C",
  "price": 30.00
}
```

Response:

```http
HTTP/1.1 201 Created
Content-Type: application/json
Location: /api/v1/products/3

{
  "id": 3,
  "name": "Product C",
  "price": 30.00
}
```

### 3. 204 No Content

**Description**: The request was successful but there is no content to send back.
**Example**: Deleting a product.

Request made:

```http
DELETE /api/v1/products/1 HTTP/1.1
Host: example.com
Authorization: Bearer your_sanctum_token_here
```

Response:

```http
HTTP/1.1 204 No Content
```

### 4. 400 Bad Request

**Description**: The request could not be understood or was missing required parameters.
**Example**: Creating a product with missing fields.

Request made:

```http
POST /api/v1/products HTTP/1.1
Host: example.com
Content-Type: application/json
Authorization: Bearer your_sanctum_token_here

{
  "name": "Product D"
}
```

Response:

```http
HTTP/1.1 400 Bad Request
Content-Type: application/json

{
  "error": "Price is required."
}
```

### 5. 401 Unauthorized

**Description**: Authentication is required and has failed or has not yet been provided.
**Example**: Accessing a protected endpoint without a valid token.

Request made:

```http
GET /api/v1/products HTTP/1.1
Host: example.com
```

Response:

```http
HTTP/1.1 401 Unauthorized
Content-Type: application/json

{
  "error": "Unauthorized"
}
```

### 6. 403 Forbidden

**Description**: The request was valid, but the server is refusing action.
**Example**: Trying to delete a product without sufficient permissions.

Request made:

```http
DELETE /api/v1/products/1 HTTP/1.1
Host: example.com
Authorization: Bearer your_sanctum_token_here
```

Response:

```http
HTTP/1.1 403 Forbidden
Content-Type: application/json

{
  "error": "You do not have permission to delete this product."
}
```

### 7. 404 Not Found

**Description**: The requested resource could not be found.
**Example**: Trying to access a non-existent product.

Request made:

```http
GET /api/v1/products/999 HTTP/1.1
Host: example.com
Authorization: Bearer your_sanctum_token_here
```

Response:

```http
HTTP/1.1 404 Not Found
Content-Type: application/json

{
  "error": "Product not found."
}
```

### 8. 409 Conflict

**Description**: The request could not be completed due to a conflict with the current state of the resource.
**Example**: Trying to create a product that already exists.

Request made:

```http
POST /api/v1/products HTTP/1.1
Host: example.com
Content-Type: application/json
Authorization: Bearer your_sanctum_token_here

{
  "name": "Product A",
  "price": 10.00
}
```

Response:

```http
HTTP/1.1 409 Conflict
Content-Type: application/json

{
  "error": "Product already exists."
}
```

### 9. 500 Internal Server Error

**Description**: The server encountered an unexpected condition that prevented it from fulfilling the request.
**Example**: An unexpected error occurs while processing a request.

Request made:

```http
GET /api/v1/products HTTP/1.1
Host: example.com
Authorization: Bearer your_sanctum_token_here
```

Response:

```http
HTTP/1.1 500 Internal Server Error
Content-Type: application/json

{
  "error": "An unexpected error occurred."
}
```

### 10. 503 Service Unavailable

**Description**: The server is currently unable to handle the request due to temporary overload or maintenance.
**Example**: The API is temporarily down for maintenance.

Request made:

```http
GET /api/v1/products HTTP/1.1
Host: example.com
Authorization: Bearer your_sanctum_token_here
```

Response:

```http
HTTP/1.1 503 Service Unavailable
Content-Type: application/json

{
  "error": "Service temporarily unavailable. Please try again later."
}
```

Back to [S08-Terminology](../Session-08/S08-Terminology.md)