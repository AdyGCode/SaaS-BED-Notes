

An example of how to add search to the index method of a Users Controller:


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

        $trashedCount = User::onlyTrashed()->latest()->get()->count();

        return view('users.index', compact(['users', 'trashedCount', 'search']));
    }
```