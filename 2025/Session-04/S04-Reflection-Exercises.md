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
date created: 03 July 2024
date modified: 08 July 2024
created: 2024-07-31T07:52
updated: 2025-05-06T12:23
---

# Session 04 Reflection Exercises

## Software as a Service - Back-End Development

Session 03 Assessment Activity 

Developed by Adrian Gould

---

```table-of-contents
title: # Contents
style: nestedList
minLevel: 0
maxLevel: 3
includeLinks: true
```

---

# Session 03 Reflection Exercises 

## Complete the in class exercises

If you have not done so, please complete the in-class exercises that are contained in the notes.

## Tutorials

Make sure you cover the following tutorial on TDD and REST APIs - it covers the subject again, providing you with an alternative workflow, which makes a great deal of sense.

- Rosas, A. (2021, October 14). _Building an API using TDD in Laravel | Laravel.io_. Laravel.io. https://laravel.io/articles/building-an-api-using-tdd-in-laravel

Also look at completing the free Laracasts course on PEST:

- Downing, L. (2025). Laracasts. https://laracasts.com/series/pest-from-scratch
    - Free, 1.5Hrs in duration




---

## Exercises


> DO NOT USE AI - You need to practice writing code, so that you are able
> to assess easily of the code from AI systems is feasible and correct.

> - Rules of thumb: 
>   - Do not trust a User
>   - Do not trust AI.

You are to:

- Create the tests for each of the remaining methods in the API/V2/CategoryController
    - update (success & fail tests)
    - destroy (success & fail tests)
    - trash (success)
    - recoverAll (success)
    - removeAll (success)
    - recoverOne (success & fail)
    - removeOne (success & fail)

- As each test is created, write the code to:
    - Create the required route in the api_v2.php file
    - Create the corresponding controller method
    - Ensure you add basic API documentation to your code

- Make sure you test validation as well as other errors (eg. category already exists)

- NO AUTHENTICATION NEEDED AT THIS TIME
- https://github.com/AdyGCode/jokes-api-2025-s2 contains the stubs for the  
  API/V2 Controller, plus example tests for index, show and store.

---
## In and Out Of Class Activities

1. Locate a tutorial on using Sanctum to secure an API.
2. Go through the tutorial and note important steps and other information.
3. Complete the Laracasts Pest video course


## Other References

- A0mineTV. (2025, July 21). Building Comprehensive Test Suites with Pest PHP: From Validation to Authorization. DEV Community. https://dev.to/blamsa0mine/building-comprehensive-test-suites-with-pest-php-from-validation-to-authorization-3m8j
- Zulfikar Ditya. (2025, March 25). Mastering Testing in Laravel with Pest PHP: A Comprehensive Guide. Medium. https://medium.com/@zulfikarditya/mastering-testing-in-laravel-with-pest-php-a-comprehensive-guide-0d1a599f79f5
- Maduro, N. (2025). Test Coverage | Pest - The elegant PHP Testing Framework. Pestphp.com. https://pestphp.com/docs/test-coverage
- Chimeremze Prevail Ejimadu. (2025, June 28). 6 Laravel API Design Patterns I Wish I’d Known 5 Years Ago. Medium. https://medium.com/@prevailexcellent/6-laravel-api-design-patterns-i-wish-id-known-5-years-ago-f2cfe8892d34
- Ram, M. (2023, June 12). Building a RESTful API with Laravel: Best practices and tools. Medium. https://medium.com/@mukesh.ram/building-a-restful-api-with-laravel-best-practices-and-tools-907bdf4b5621



---
# Found a Problem?
 
If you spotted any problems (including missing details) in notes or other materials, then make sure you note that, and as a big help to your lecturer, you could fork the notes repository, create an issue, create a fix to the issue, and submit a pull request.



---

# END
