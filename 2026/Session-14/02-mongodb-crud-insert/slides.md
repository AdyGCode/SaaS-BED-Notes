---
theme: nmt
background: https://cover.sli.dev
title: MongoDB Exercises 2 - CRUD - Inserts
class: text-left
drawings:
  persist: false
transition: fade
mdc: true
duration: 35min
---

# MongoDB Exercises 2 - CRUD - Inserts

<br>

## Cluster: Software as a Service - Back-End Development

#### ICT50120 Diploma of Information Technology (Advanced Programming)<br>

#### ICT50120 Diploma of Information Technology (Back-End Development)

<div @click="$slidev.nav.next" class="mt-12 -mx-4 p-4" hover:bg="white op-10">
<p>Press <kbd>Space</kbd> or <kbd>RIGHT</kbd> for next slide/step <fa-solid-arrow-right /></p>
</div>

<div class="abs-br m-6 text-xl">
  <a href="https://github.com/adygcode/SaaS-FED-Notes" target="_blank" class="slidev-icon-btn">
    <fa-brands-github class="text-zinc-300 text-3xl -mr-2"/>
  </a>
</div>


<!-- Presenter Notes: 

Practice / Review Questions

-->

---
level: 2
---

# Contents

<Toc minDepth="1" maxDepth="1" columns="2" />


---
layout: default
level: 2
---

# Navigating Slides

Hover over the bottom-left corner to see the navigation's controls panel.

## Keyboard Shortcuts

|                                                     |                             |
|-----------------------------------------------------|-----------------------------|
| <kbd>right</kbd> / <kbd>space</kbd>                 | next animation or slide     |
| <kbd>left</kbd>  / <kbd>shift</kbd><kbd>space</kbd> | previous animation or slide |
| <kbd>up</kbd>                                       | previous slide              |
| <kbd>down</kbd>                                     | next slide                  |

---
layout: section
---

# Objectives

---
layout: two-cols
level: 2
---

# Objectives

::left::
By the end of this session, you will be able to:

-

::right::




---
layout: section
---

# Before you Begin: Requirements

---
level: 2
---

# Before you Begin: Requirements

You will need the following:

- MongoDB installed locally or MongoDB Atlas account
- MongoDB Shell installed locally
- MongoDB Tools installed locally
- MongoDB Compass installed locally

---
level: 2
---

# Before you Begin: Requirements

## Sample Data

Before you start you will require some sample data.

The data structure used for these exercises uses embeded documents (e.g. authors).

The sample data is given below:

- [embedded_cleaned.json](public/embedded_cleaned.json)

You may download this from GitHub:

- https://githug.com/AdyGCode/SaaS-BED-Notes/
- Open: 2026/Session-14/02-mongodb-queries/public/

The data set is much larger than the previous version, so we will not show it within this presentation.

---
level: 2
---

# Before you Begin: Requirements

## Setting Up - Using MongoDB CLI tools

Open your CLI, and ensure that you are able to run the following:

```shell
mongodbimport --version
```

## Setting Up - Using MongoDB Compass

- Open MongoDB Compass
- Create a DB called lab_exercises
- Use the database
- create a table books_embedded
- import the embedded data into this table
- create books, authors, categories tables for the referenced data
- import the relevant files into each table

---
layout: section
---

# Data for Exercises

---
level: 2
---

# Data for Exercises

The following table contains the data that you will use for the exercises.

We have replaced Published with P, Draft with D, Software Engineering with SE

The table is split over three slides.

| Title                                                 | ISBN          | Pages | Pub Date | Status | Authors       | Cat's |
|-------------------------------------------------------|---------------|------------|----------------|--------|---------------|-------|
| Test-Driven APIs with Laravel and Pest                | 9781617299010 | 320        | 2023-04-15     | P      | John Doe      | SE    |
| Laravel Beyond Code                                   | 9781617299027 | 280        | 2022-09-10     | P      | Jane Smith    | SE    |
| Full-Stack Laravel 13 and Livewire 4 + AI + Alpine.js | 9781617299034 | 410        | 2024-01-20     | P      | Carlos Mendes | SE    |
| Laravel 13 in Practice: Advanced PHP Web Development  | 9781617299041 | 365        | 2023-07-05     | P      | Emily Chen    | SE    |

---
level: 2
---

# Data for Exercises

The following table contains the data that you will use for the exercises.

We have replaced Published with P, Draft with D, Software Engineering with SE

The table is split over three slides.

| Title                                    | ISBN          | Pages | Pub Date | Status | Authors       | Cat's |
|------------------------------------------|---------------|------------|----------------|--------|---------------|-------|
| Mastering Laravel 13: Simplify           | 9781617299058 | 300        | 2022-11-11     | P      | David Turner  | SE    |
| Mastering Laravel 13 for Web Development | 9781617299065 | 355        | 2024-03-18     | P      | Sophia Patel  | SE    |
| Laravel: Up & Running, 3rd Edition       | 9781492041216 | 450        | 2019-12-15     | P      | Matt Stauffer | SE    |
| Battle Ready Laravel                     | 9781617299072 | 250        | 2023-05-01     | P      | Ash Allen     | SE    |

---
level: 2
---

# Data for Exercises

The following table contains the data that you will use for the exercises.

We have replaced Published with P, Draft with D, Software Engineering with SE

The table is split over three slides.

| Title                                              | ISBN          | Pages | Pub Date | Status | Authors                    | Cat's |
|----------------------------------------------------|---------------|------------|----------------|--------|----------------------------|-------|
| Consuming APIs with Laravel                        | 9781617299089 | 270        | 2022-06-12     | P      | Ash Allen                  | SE    |
| Mastering Laravel Validation Rules                 | 9781617299096 | 230        | 2020-08-25     | P      | Aaron Saray, Joel Clermont | SE    |
| Best Practices for Laravel Enterprise Applications | 9781617299102 | 390        | 2023-10-09     | P      | Wendell Adriel             | SE    |

---
level: 2
---

# MongoDB Exercises 1 - Inserts - Question 1

Using the books_embedded collection, write MongoDB commands to insert the following two books using individual `insertOne()` statements:

| Title                                  | Object ID to use         |
|----------------------------------------|--------------------------|
| Test-Driven APIs with Laravel and Pest | 53c2ae8528d75d572c070101 |
| Laravel Beyond Code                    | 53c2ae8528d75d572c070102 |

Your document structure must follow the format provided in the example (including _id, title, isbn, pageCount,
publishedDate, status, authors, and categories).

<!-- 
```js
db.books_embedded.insertOne({
  _id: ObjectId("53c2ae8528d75d572c070101"),
  title: "Test-Driven APIs with Laravel and Pest",
  isbn: "9781617299010",
  pageCount: 320,
  publishedDate: ISODate("2023-04-15T00:00:00.000Z"),
  status: "published",
  authors: ["John Doe"],
  categories: ["Software Engineering"]
});

db.books_embedded.insertOne({
  _id: ObjectId("53c2ae8528d75d572c070102"),
  title: "Laravel Beyond Code",
  isbn: "9781617299027",
  pageCount: 280,
  publishedDate: ISODate("2022-09-10T00:00:00.000Z"),
  status: "published",
  authors: ["Jane Smith"],
  categories: ["Software Engineering"]
});
``

```


-->

---
level: 2
---

# MongoDB Exercises 1 - Inserts - Question 2

Using the books_embedded collection, write MongoDB commands to insert the following two books using `insertOne()` for
each:

| Title                       | Object ID to use         |
|-----------------------------|--------------------------|
| Battle Ready Laravel        | 53c2ae8528d75d572c070108 |
| Consuming APIs with Laravel | 53c2ae8528d75d572c070109 |

Ensure that:

- The _id uses the $oid format
- The publishedDate uses $date
- Authors are stored as an array

<!-- 
```js
db.books_embedded.insertOne({
  _id: ObjectId("53c2ae8528d75d572c070108"),
  title: "Battle Ready Laravel",
  isbn: "9781617299072",
  pageCount: 250,
  publishedDate: ISODate("2023-05-01T00:00:00.000Z"),
  status: "published",
  authors: ["Ash Allen"],
  categories: ["Software Engineering"]
});

db.books_embedded.insertOne({
  _id: ObjectId("53c2ae8528d75d572c070109"),
  title: "Consuming APIs with Laravel",
  isbn: "9781617299089",
  pageCount: 270,
  publishedDate: ISODate("2022-06-12T00:00:00.000Z"),
  status: "published",
  authors: ["Ash Allen"],
  categories: ["Software Engineering"]
});

```


-->

---
level: 2
---

# MongoDB Exercises 1 - Inserts - Question 3

Using a single `insertMany()` command, insert the following four books into the books_embedded collection:

| Title                                                 | Object ID to use         |
|-------------------------------------------------------|--------------------------|
| Mastering Laravel 13 for Web Development              | 53c2ae8528d75d572c070106 |
| Laravel 13 in Practice: Advanced PHP Web Development  | 53c2ae8528d75d572c070104 |
| Mastering Laravel 13: Simplify                        | 53c2ae8528d75d572c070105 |
| Full-Stack Laravel 13 and Livewire 4 + AI + Alpine.js | 53c2ae8528d75d572c070103 |

Ensure all documents:

- Follow the correct JSON structure
- Include valid _id values
- Use consistent category and status values

<!-- 
```js
db.books_embedded.insertMany([
  {
    _id: ObjectId("53c2ae8528d75d572c070106"),
    title: "Full-Stack Laravel 13 and Livewire 4 + AI + Alpine.js",
    isbn: "9781617299034",
    pageCount: 410,
    publishedDate: ISODate("2024-01-20T00:00:00.000Z"),
    status: "published",
    authors: ["Carlos Mendes"],
    categories: ["Software Engineering"]
  },
  {
    _id: ObjectId("53c2ae8528d75d572c070104"),
    title: "Laravel 13 in Practice: Advanced PHP Web Development",
    isbn: "9781617299041",
    pageCount: 365,
    publishedDate: ISODate("2023-07-05T00:00:00.000Z"),
    status: "published",
    authors: ["Emily Chen"],
    categories: ["Software Engineering"]
  },
  {
    _id: ObjectId("53c2ae8528d75d572c070105"),
    title: "Mastering Laravel 13: Simplify",
    isbn: "9781617299058",
    pageCount: 300,
    publishedDate: ISODate("2022-11-11T00:00:00.000Z"),
    status: "published",
    authors: ["David Turner"],
    categories: ["Software Engineering"]
  },
  {
    _id: ObjectId("53c2ae8528d75d572c070103"),
    title: "Mastering Laravel 13 for Web Development",
    isbn: "9781617299065",
    pageCount: 355,
    publishedDate: ISODate("2024-03-18T00:00:00.000Z"),
    status: "published",
    authors: ["Sophia Patel"],
    categories: ["Software Engineering"]
  }
]);
```
-->


---
level: 2
---

# MongoDB Exercises 1 - Inserts - Question 4

Using `insertMany()`, insert the following books into the books_embedded collection:

| Title                                              | Object ID to use         |
|----------------------------------------------------|--------------------------|
| Mastering Laravel Validation Rules                 | 53c2ae8528d75d572c070110 |
| Laravel: Up & Running, 3rd Edition                 | 53c2ae8528d75d572c070107 |
| Best Practices for Laravel Enterprise Applications | 53c2ae8528d75d572c070111 |

Additional requirements:

Include all fields from the example schema
Ensure multiple authors are correctly formatted as arrays
Dates must be in ISO format inside $date
<!-- 
```js
db.books_embedded.insertMany([
  {
    _id: ObjectId("53c2ae8528d75d572c070107"),
    title: "Laravel: Up & Running, 3rd Edition",
    isbn: "9781492041216",
    pageCount: 450,
    publishedDate: ISODate("2019-12-15T00:00:00.000Z"),
    status: "published",
    authors: ["Matt Stauffer"],
    categories: ["Software Engineering"]
  },
  {
    _id: ObjectId("53c2ae8528d75d572c070110"),
    title: "Mastering Laravel Validation Rules",
    isbn: "9781617299096",
    pageCount: 230,
    publishedDate: ISODate("2020-08-25T00:00:00.000Z"),
    status: "published",
    authors: ["Aaron Saray", "Joel Clermont"],
    categories: ["Software Engineering"]
  },
  {
    _id: ObjectId("53c2ae8528d75d572c070111"),
    title: "Best Practices for Laravel Enterprise Applications",
    isbn: "9781617299102",
    pageCount: 390,
    publishedDate: ISODate("2023-10-09T00:00:00.000Z"),
    status: "published",
    authors: ["Wendell Adriel"],
    categories: ["Software Engineering"]
  }
]);
```


-->




---
layout: section
---

# Further Learning

<br>

<Announcement type="brainstorm"  
class="text-3xl leading-8 py-4!">
To be used as part of your Structured Out of Class Activities.
</Announcement>

---
level: 2
---

# Further Learning

---
layout: section
---

# Acknowledgements and References

---
level: 2
---

# Acknowledgements and References

- Hows, D., Plugge, E., & Membrey, P. (2015). *MongoDB: The Definitive Guide* (2nd ed.). O’Reilly Media.

- MongoDB. (2026). *MongoDB Courses and Trainings | MongoDB Shell Cheatsheet | MongoDB University*.
  Mongodb.com. https://learn.mongodb.com/learn/course/mongodb-shell-cheatsheet/

<br>

> Some content may have been generated with the assistance of Microsoft
> CoPilot

---
layout: end
---

# Fin!

<Announcement type="idea" title="">
<p class="text-white! p-2! m-0! text-3xl"> Data finds its shape </p>  
<p class="text-white! p-2! m-0! text-3xl"> Not rows, but living stories </p>  
<p class="text-white! p-2! m-0! text-3xl"> Queries flow with ease </p>
</Announcement>
