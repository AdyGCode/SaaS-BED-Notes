---
created: 2025-03-24T09:08
updated: 2025-04-01T15:10
---


An example of how to add search to the index method of a Users Controller.

This example is for an application with a web front end, but it will give you a good guide to how to implement for a REST API that returns JSON data.

```php

  /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return View
     */
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'page'=>['nullable','integer'],
            ]);

        $search = $validated['search'] ?? null;
        $users = User::whereAny(['name', 'email',], 'LIKE', "%$search%")->paginate(5);

        if ($search) {
            $users->appends(['search' => $search]);
        }

        return view('users.index', compact(['users', 'search']));
    }
```