---
theme: nmt
background: https://cover.sli.dev
title: MongoDB Exercises 4 - CRUD - Updates
class: text-left
drawings:
  persist: false
transition: fade
mdc: true
duration: 35min
---

# MongoDB Exercises 4 - CRUD - Updates

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

The table is split over multiple slides.

| Title                                                                                      | ISBN          | Pages | Pub Date   | Status | Authors                     | Categories |
|--------------------------------------------------------------------------------------------|---------------|-------|------------|--------|-----------------------------|------------|
| Software SEC for Developers                                                                | 9781119876543 | 360   | 2023-06-20 | P      | Laura Brown                 | SEC        |
| SQL for Data Analytics: Analyze Data Effectively, Uncover Insights and Master Advanced SQL | 9781789808829 | 420   | 2022-07-15 | P      | Upom Malik, Matt Goldwasser | DA         |
| The Manga Guide to DB                                                                      | 9781593271901 | 250   | 2009-04-01 | P      | Mana Takahashi              | DB         |

---
level: 2
---

# Data for Exercises

The following table contains the data that you will use for the exercises.

We have replaced Published with P, Draft with D, Software Engineering with SE

The table is split over multiple slides.

| Title                                                                                      | ISBN          | Pages | Pub Date   | Status | Authors                     | Categories |
|--------------------------------------------------------------------------------------------|---------------|-------|------------|--------|-----------------------------|------------|
| Learning MySQL and MariaDB: Heading in the Right Direction with MySQL and MariaDB          | 9781617299201 | 350   | 2020-05-10 | P      | Russell J.T. Dyer           | DB         |
| Software SEC in Practice: Vulnerabilities, Attacks and Defenses                            | 9781509301234 | 410   | 2021-09-01 | P      | Mark Thompson               | SEC        |
| MariaDB: The Complete Guide to Open-Source Relational Database Management                  | 9781484272093 | 500   | 2023-03-10 | P      | John Smith                  | DB         |

---
level: 2
---

# Data for Exercises

The following table contains the data that you will use for the exercises.

We have replaced Published with P, Draft with D, Software Engineering with SE

The table is split over multiple slides.

| Title                                                                                      | ISBN          | Pages | Pub Date   | Status | Authors                     | Categories |
|--------------------------------------------------------------------------------------------|---------------|-------|------------|--------|-----------------------------|------------|
| Software SEC: Building SEC In                                                              | 9780321356704 | 720   | 2006-03-01 | P      | Gary McGraw                 | SEC        |
| Practical SQL, 2nd Edition: A Beginner's Guide to Storytelling with Data                   | 9781593278276 | 480   | 2019-10-01 | P      | Anthony DeBarros            | DA         |
| SQL Beginners Guide: Master SQL Programming from Zero with Practical Examples              | 9781800567890 | 300   | 2022-01-12 | P      | James Miller                | DB         |

---
layout: section
---

# The Exercises

---
level: 2
---

# MongoDB Exercises 4 - Upserts - Question 1

Using the books_embedded collection, write a MongoDB updateOne() command with the upsert option set to true to ensure the following book exists in the collection:

- Learning MySQL and MariaDB: Heading in the Right Direction with MySQL and MariaDB

If the document already exists (match using the _id), it should be updated.

If it does not exist, it should be inserted.

You must:

- Match the document using _id: ObjectId("53c2ae8528d75d572c071001")
- Set all fields (title, isbn, pageCount, publishedDate, status, authors, categories)
- Use correct MongoDB types (ObjectId, ISODate)
- Ensure authors and categories are arrays

<!-- 
```js
db.books_embedded.updateOne(
  { _id: ObjectId("53c2ae8528d75d572c071001") },
  {
    $set: {
      title: "Learning MySQL and MariaDB: Heading in the Right Direction with MySQL and MariaDB",
      isbn: "9781617299201",
      pageCount: 350,
      publishedDate: ISODate("2020-05-10T00:00:00.000Z"),
      status: "published",
      authors: ["Russell J.T. Dyer"],
      categories: ["Databases"]
    }
  },
  { upsert: true }
);

```


-->

---
level: 2
---

# MongoDB Exercises 4 - Upserts - Question 2

Using the books_embedded collection, write a MongoDB updateOne() query with the upsert option set to true to ensure the following book exists:

- SQL for Data Analytics: Analyze Data Effectively, Uncover Insights and Master Advanced SQL

If a document with the same _id already exists, it should be updated. Otherwise, it should be inserted.

You must:

- Match using _id: ObjectId("53c2ae8528d75d572c071003")
- Set all fields correctly
- Store multiple authors and categories as arrays
- Use correct MongoDB data types (ObjectId, ISODate)

<!-- 
```js
db.books_embedded.updateOne(
  { _id: ObjectId("53c2ae8528d75d572c071003") },
  {
    $set: {
      title: "SQL for Data Analytics: Analyze Data Effectively, Uncover Insights and Master Advanced SQL",
      isbn: "9781789808829",
      pageCount: 420,
      publishedDate: ISODate("2022-07-15T00:00:00.000Z"),
      status: "published",
      authors: ["Upom Malik", "Matt Goldwasser"],
      categories: ["Data Analytics", "Databases"]
    }
  },
  { upsert: true }
);


```


-->

---
level: 2
---

# MongoDB Exercises 4 - Update - Question 3

A document exists in the books_embedded collection with an incorrect ISBN value ("9781617299201A").

Write a MongoDB updateOne() query to correct the ISBN to: `9781617299201` for the book:

- Learning MySQL and MariaDB: Heading in the Right Direction with MySQL and MariaDB

You must:

- Match the document using _id: ObjectId("53c2ae8528d75d572c071001")
- Only update the isbn field
- Use the correct MongoDB update operator

<!-- 
```js
db.books_embedded.updateOne(
  { _id: ObjectId("53c2ae8528d75d572c071001") },
  {
    $set: {
      isbn: "9781617299201"
    }
  }
);

```
-->


---
level: 2
---

# MongoDB Exercises 4 - Updates - Question 4

Two books in the books_embedded collection currently do not include the category "Databases".

Write a MongoDB updateMany() query to add the category "Databases" to the following books:

- Practical SQL, 2nd Edition: A Beginner's Guide to Storytelling with Data
- SQL for Data Analytics: Analyze Data Effectively, Uncover Insights and Master Advanced SQL

You must:

- Match the documents using their titles
- Add "Databases" to the categories array
- Ensure you do not create duplicate values if "Databases" already exists
- Use the correct MongoDB operator


<!-- 
```js
db.books_embedded.updateMany(
  {
    title: {
      $in: [
        "Practical SQL, 2nd Edition: A Beginner's Guide to Storytelling with Data",
        "SQL for Data Analytics: Analyze Data Effectively, Uncover Insights and Master Advanced SQL"
      ]
    }
  },
  {
    $addToSet: {
      categories: "Databases"
    }
  }
);

```


-->




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

- MongoDB, Inc. (2024). *Update documents*. MongoDB Documentation. https://www.mongodb.com/docs/manual/tutorial/update-documents/

- MongoDB, Inc. (2024). *$addToSet (update operator)*. MongoDB Documentation. https://www.mongodb.com/docs/manual/reference/operator/update/addToSet/

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
