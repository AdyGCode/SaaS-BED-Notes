---
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
header: "![NMTAFE](../assets//Black-Red-Banner.svg)"
auto-scaling: true
size: 1920x1080
color: "#ccc"
backgroundColor: "#060606"
tags:
  - SaaS
  - APIs
  - Back-End
  - Journal
date created: 07 July 2024
date modified: 08 Aug 2024
created: 2024-08-08T13:45
updated: 2025-05-06T12:23
---

# Paginating API Responses

We know from previous work that we can add pagination to the browse method (index) very easily.

## Adding pagination to the API

For example, for our REST API, it is a simple case of replacing the `all()` with `paginate(n)` where n is the number of resources per page.

```php
public function index()  
{  
    $regions = Region::paginate(2);  
    return ApiResponseClass::sendResponse(  
        $regions,  
        "regions retrieved successfully",  
        200  
    );  
}
```

When we do this with an API, the resulting response will look similar to this:

```json
{
  "success": true,
  "message": "regions retrieved successfully",
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "name": "Africa",
        "created_at": "2024-08-08T08:32:32.000000Z",
        "updated_at": "2024-08-08T08:32:32.000000Z"
      },
      {
        "id": 2,
        "name": "Americas",
        "created_at": "2024-08-08T08:32:32.000000Z",
        "updated_at": "2024-08-08T08:32:32.000000Z"
      }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/v1/regions?page=1",
    "from": 1,
    "last_page": 3,
    "last_page_url": "http://127.0.0.1:8000/api/v1/regions?page=3",
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/api/v1/regions?page=1",
        "label": "1",
        "active": true
      },
      {
        "url": "http://127.0.0.1:8000/api/v1/regions?page=2",
        "label": "2",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/api/v1/regions?page=3",
        "label": "3",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/api/v1/regions?page=2",
        "label": "Next &raquo;",
        "active": false
      }
    ],
    "next_page_url": "http://127.0.0.1:8000/api/v1/regions?page=2",
    "path": "http://127.0.0.1:8000/api/v1/regions",
    "per_page": 2,
    "prev_page_url": null,
    "to": 2,
    "total": 6
  }
}
```

That is a lot of extra information.

The extra information is created to comply with the standard responses for an API, plus it also provides some of the HATEOS requirements to add links to other resources.

## Navigating to "pages"

The next problem we have is now allowing our API to navigate to the previous and next pages, or even to jump to numbered page.

Because the page number is passed as a request parameter, it is a simple modification to our controller method to handle this and the number of items per page.

First add the following use line at the start of the Controller class:

```php
use Illuminate\Http\Request;
```


Next modify the `index` method to include the request, and handle the situation where there is no per page submitted:

```php
$per_page=2;  
if($request->has('per_page')) {  
    $per_page = $request->per_page;  
}  
  
$regions = Region::paginate($per_page);  
return ApiResponseClass::sendResponse(  
    $regions,  
    "regions retrieved successfully",  
    200  
);
```

When we execute this, we now get the number of regions (2), but we can request more, and navigate to other pages.

Getting page 2 of data:

```http
https://some-domain-name.com/api/v1/regions?page=2
```

This gives a result similar to this (*we have trimmed out the links data*):

```json
{
  "success": true,
  "message": "regions retrieved successfully",
  "data": {
    "current_page": 2,
    "data": [
      {
        "id": 3,
        "name": "Asia",
        "created_at": "2024-08-08T08:32:32.000000Z",
        "updated_at": "2024-08-08T08:32:32.000000Z"
      },
      {
        "id": 4,
        "name": "Europe",
        "created_at": "2024-08-08T08:32:32.000000Z",
        "updated_at": "2024-08-08T08:32:32.000000Z"
      }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/v1/regions?page=1",
    "from": 3,
    "last_page": 3,
    "last_page_url": "http://127.0.0.1:8000/api/v1/regions?page=3",
    "links": [
      ...
    ],
    "next_page_url": "http://127.0.0.1:8000/api/v1/regions?page=3",
    "path": "http://127.0.0.1:8000/api/v1/regions",
    "per_page": 2,
    "prev_page_url": "http://127.0.0.1:8000/api/v1/regions?page=1",
    "to": 4,
    "total": 6
  }
}
```

Getting page 1, with 3 regions per page:

```http
https://some-domain-name.com/api/v1/regions?page=1&per_page=3
```

And the above produces results similar to this (*we have trimmed out the links data*):

```json
{
  "success": true,
  "message": "regions retrieved successfully",
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "name": "Africa",
        "created_at": "2024-08-08T08:32:32.000000Z",
        "updated_at": "2024-08-08T08:32:32.000000Z"
      },
      {
        "id": 2,
        "name": "Americas",
        "created_at": "2024-08-08T08:32:32.000000Z",
        "updated_at": "2024-08-08T08:32:32.000000Z"
      },
      {
        "id": 3,
        "name": "Asia",
        "created_at": "2024-08-08T08:32:32.000000Z",
        "updated_at": "2024-08-08T08:32:32.000000Z"
      }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/v1/regions?page=1",
    "from": 1,
    "last_page": 2,
    "last_page_url": "http://127.0.0.1:8000/api/v1/regions?page=2",
    "links": [
    ...
    ],
    "next_page_url": "http://127.0.0.1:8000/api/v1/regions?page=2",
    "path": "http://127.0.0.1:8000/api/v1/regions",
    "per_page": 3,
    "prev_page_url": null,
    "to": 3,
    "total": 6
  }
}

```

So what happens when we make a request for a page number more than we have? We will get an empty result set.

Sample request:

```http
http://some-domain-name.com/api/v1/regions?page=7&per_page=3
```

Sample results:
```json
{
  "success": true,
  "message": "regions retrieved successfully",
  "data": {
    "current_page": 7,
    "data": [],
    "first_page_url": "http://127.0.0.1:8000/api/v1/regions?page=1",
    "from": null,
    "last_page": 2,
    "last_page_url": "http://127.0.0.1:8000/api/v1/regions?page=2",
    "links": [
      {
        "url": "http://127.0.0.1:8000/api/v1/regions?page=6",
        "label": "&laquo; Previous",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/api/v1/regions?page=1",
        "label": "1",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/api/v1/regions?page=2",
        "label": "2",
        "active": false
      },
      {
        "url": null,
        "label": "Next &raquo;",
        "active": false
      }
    ],
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/api/v1/regions",
    "per_page": 3,
    "prev_page_url": "http://127.0.0.1:8000/api/v1/regions?page=6",
    "to": null,
    "total": 6
  }
}
```

## Validating `per_page` 

One issue we have with this is that requests may have non-integer values.

One way, and possibly the simplest, is to validate the `per_page`, and `page` values and return a suitable error when an invalid value is provided.

We will start by modifying our `ApiResponseClass` to allow us to send a `false` success message:

```php
public static function sendResponse(
	$result, string $message, bool $success = true, int $code = 200
	): JsonResponse  
{  
    $response = [  
        'success' => $success,  
        'message' => $message,  
        'data' => $result,  
    ];  
  
    return response()  
        ->json($response, $code);  
}

```

Next we update the `index` method in the `RegionController`.

We do this by adding code that does the following:
- Get the `per_page` from the query parameters, and set the default to `4` if none given,
- convert the obtained value to an integer,
- Verify the `per_page` value is between `1` and `100` inclusive,
- if not, return a `400` result, a message, and success is set to `false`.

```php
public function index(Request $request)  
{  
    $perPage = (int) $request->query('per_page', 4);  
  
    if ($perPage < 1 || $perPage > 100) {  
        return ApiResponseClass::sendResponse(  
            [],  
            "Per Page must be an integer greater than 0",  
            false,  
            400  
        );  
    }  
  
// ... code removed for brevity 

}
```

> **NOTE:** This is just one method that could be employed. There will be many other solutions to this problem.

