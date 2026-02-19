
## Laravel 12: ETags in HTTP / REST APIs

**Agenda**
- What ETags are
- Strong vs weak ETags
- Implementing ETags via middleware (Laravel 12)
- Testing ETags with PEST

<!-- Speaker notes:
Open with the purpose: ETags are entity tags—identifiers for a specific representation of a resource. They power conditional requests (If-None-Match / If-Match), saving bandwidth (304 Not Modified) and enabling optimistic concurrency (412 Precondition Failed). Sources: MDN, RFC 7232, Wikipedia. citeturn10search9turn10search15turn10search11
-->
---

## ETags — the idea

- **Entity Tag** identifying a **specific version** of a resource
- Enables **conditional requests**: `If-None-Match`, `If-Match`
- Results: **304 Not Modified** or **412 Precondition Failed** when preconditions fail
- Improves caching & prevents **lost updates** (optimistic concurrency)

<!-- Speaker notes:
ETag is an opaque identifier; generation method not mandated (hash, version number, timestamp). Conditional GET with If-None-Match returns 304 when unchanged; If-Match protects updates and returns 412 on mismatch. citeturn10search9turn10search11turn10search15
-->
---

## Strong vs Weak ETags

- **Strong ETag**: byte-for-byte identical required; ideal for precise comparisons and range requests
- **Weak ETag**: `W/"..."`; semantically equivalent allowed; easier to compute; not suitable for range or safe updates
- Use strong for **If-Match** updates; weak OK for **cache validation**

<!-- Speaker notes:
MDN: W/ prefix marks weak validators; strong ideal but harder to generate. Wikipedia/RFC detail that strong implies identical representation bytes; weak allows equivalent semantics (e.g., different compression). citeturn10search9turn10search11turn10search12
-->
---

## Conditional Requests at a Glance

- **Client → Server**: `If-None-Match: "etag"` → **304** if unchanged
- **Client → Server**: `If-Match: "etag"` → **412** if changed
- Pair with **Cache-Control** & **Last-Modified** as needed

<!-- Speaker notes:
If-None-Match validates cache freshness for GET/HEAD; If-Match guards updates (PUT/PATCH/DELETE). Use with standard caching headers to design robust HTTP behavior. citeturn10search15turn10search9
-->
---

## Implementing ETags in Laravel 12 (Middleware)

```php
// app/Http/Middleware/GenerateEtag.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GenerateEtag
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        // Only for successful, cacheable responses (e.g., GET/HEAD, 200/206)
        if (!in_array($request->method(), ['GET', 'HEAD'])) return $response;
        if ($response->isSuccessful() === false) return $response;
        if ($response->headers->has('ETag')) return $response; // don't overwrite

        // Compute a strong ETag from the actual response content bytes
        $etag = '"'.sha1($response->getContent()).'"';
        $response->headers->set('ETag', $etag);

        // Handle conditional GET: If-None-Match
        $ifNoneMatch = $request->headers->get('If-None-Match');
        if ($ifNoneMatch && $ifNoneMatch === $etag) {
            // Not Modified
            $response->setStatusCode(304);
            $response->setContent('');
        }

        return $response;
    }
}
```

```php
// app/Http/Kernel.php (register in web/api stacks as appropriate)
protected $middlewareGroups = [
    'api' => [
        // ... existing middleware
        \App\Http\Middleware\GenerateEtag::class,
    ],
];
```

<!-- Speaker notes:
This example adds a strong ETag using a SHA-1 of the response body for GET/HEAD 2xx responses and returns 304 on matching If-None-Match. You can switch to weak ETags by prefixing with W/ and/or computing on a canonicalized representation. Ensure consistency across nodes in a cluster. citeturn10search9turn10search11
-->
---

## Optional: Weak ETags in Laravel

```php
// In GenerateEtag@handle, after computing content hash
$weakEtag = 'W/"'.sha1($response->getContent()).'"';
$response->headers->set('ETag', $weakEtag);
```

**When to prefer weak:** different encodings (gzip vs none), whitespace/minification differences, or high-frequency updates where semantic stability matters.

<!-- Speaker notes:
Weak validators are easier to generate and treat semantically equivalent representations as equal; good for caching but not for range requests or If-Match concurrency updates. citeturn10search9turn10search12
-->
---

## Optimistic Concurrency with ETags (If-Match)

- Return ETag on **GET /resource/{id}**
- Require `If-Match` on **PUT/PATCH/DELETE**
- If mismatch → **412 Precondition Failed**; client must refetch and retry

```php
// Example snippet inside controller update()
$clientTag = $request->header('If-Match');
$currentTag = '"'.sha1($resource->toJson()).'"';

abort_if(!$clientTag || $clientTag !== $currentTag, 412);

$resource->update($validated);
```

<!-- Speaker notes:
Pattern: client GETs resource (receives ETag), then sends If-Match on update. On mismatch, return 412 to prevent lost updates. Some orgs document this as API policy. citeturn10search15turn10search23turn10search24
-->
---

## Testing ETags with PEST (GET + 304)

```php
// tests/Feature/Api/EtagCacheTest.php
use function Pest\Laravel\getJson;

it('returns 304 when ETag matches', function () {
    $first = getJson('/api/v1/courses')
        ->assertOk()
        ->assertHeader('etag');

    $etag = $first->headers->get('etag');

    getJson('/api/v1/courses', ['If-None-Match' => $etag])
        ->assertStatus(304);
});
```

<!-- Speaker notes:
This validates cache revalidation behavior. Expect ETag on first 200; second request with If-None-Match should get 304 with empty body. citeturn10search9
-->
---

## Testing Concurrency with PEST (PUT + 412)

```php
// tests/Feature/Api/EtagIfMatchTest.php
use function Pest\Laravel\{getJson, putJson};
use App\Models\Course;

it('guards updates with If-Match', function () {
    $course = Course::factory()->create(['title' => 'A']);

    // Client A fetches current ETag
    $res = getJson(route('api.v1.courses.show', $course))
        ->assertOk();
    $etag = $res->headers->get('etag');

    // Simulate concurrent change (server-side)
    $course->update(['title' => 'B']);

    // Client A attempts update with stale ETag
    putJson(route('api.v1.courses.update', $course), ['title' => 'C'], [
        'If-Match' => $etag,
        'Accept' => 'application/json'
    ])->assertStatus(412);
});
```

<!-- Speaker notes:
We simulate a concurrent update and assert 412 Precondition Failed when the client uses a stale ETag via If-Match. This is standard optimistic concurrency using ETags. citeturn10search23turn10search24
-->
---

## Practical Tips & Gotchas

- Keep ETag generation **consistent across servers**
- Add `Cache-Control` metadata that matches your caching intent
- Avoid weak ETags for **If-Match** and **range requests**
- Include ETag on **304 responses** too

<!-- Speaker notes:
Clusters must compute identical tags for the same representation; otherwise, clients thrash caches. RFC/MDN: servers should include validators consistently; range & strong validators interplay; ETag present on 304 responses. citeturn10search12turn10search9
-->
---

## Recap Checklist (1–5 words)

**Concepts**
- ETag = version fingerprint
- Conditional requests
- 304 vs 412
- Strong vs weak
- Prevent lost updates

**Laravel**
- Middleware computes ETag
- Respect If-None-Match
- Use If-Match updates
- Consistent hashing
- Add Cache-Control

**Testing**
- PEST 200 → 304
- Assert ETag header
- If-Match → 412
- Cluster consistency
- Include 304 ETag

<!-- Speaker notes:
Short reminders aligned to implementation and tests. Sources used across slides for definitions and semantics. citeturn10search9turn10search15
-->
---

## Exit Journal Questions

1) **Where will you use ETags?**  
Pick one endpoint and describe which validator (strong/weak) you’ll use and why.

2) **How will you test it?**  
Outline a PEST test (status, headers) and a Postman check for cache/concurrency.

<!-- Speaker notes:
Encourage students to connect theory to a concrete endpoint and to outline their test plan—including success and conflict paths. Link to conditional headers behavior. citeturn10search15
-->
---
