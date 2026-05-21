---
theme: nmt
background: https://cover.sli.dev
title: MongoDB Exercises 2 - Queries
class: text-left
drawings:
  persist: false
transition: fade
mdc: true
duration: 35min
---

# MongoDB Exercises 2 - Queries

## Software as a Service - Back-End Development

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

#  MongoDB Exercises 2 - Queries

---
level: 2
---

#  MongoDB Exercises 2 - Queries

Before you start you will require some sample data.

Two versions:
- Embedded Data
  - [embedded_cleaned.json](public/embedded_cleaned.json)
- Referenced Data 
  - [referenced_authors.json](public/referenced_authors.json)
  - [referenced_books.json](public/referenced_books.json)
  - [referenced_categories.json](public/referenced_categories.json)

You may download this from GitHub:
    - https://githug.com/AdyGCode/SaaS-BED-Notes/
    - Open: 2026/Session-14/02-mongodb-queries/public/


The data set is much larger than the previous version, so we will not show it within this presentation.

---
level: 2
---

#  MongoDB Exercises 2 - Queries

## Setup

Open MongoDB Compass
Create a DB called lab_exercises
Use the database
create a table books_embedded
import the embedded data into this table
create books, authors, categories tables for the referenced data
import the relevant files into each table


# Lab 1: Query Embedded Data

Find all books by 'Charlie Collins'

```js
db.books.find({ authors: "Charlie Collins" })
```

<!-- Answer: Simple array match works because authors are embedded directly -->

---

# Lab 2: Category Query

Find all Java books

```js
db.books.find({ categories: "Java" })
```

<!-- Answer: Embedded array allows direct filtering without joins -->

---

# Lab 3: Sorting

Sort books by newest publishedDate

```js
db.books.find().sort({ publishedDate: -1 })
```

<!-- Answer: Native BSON date enables efficient sorting -->

---

# Lab 4: Missing Data

Find books with missing pageCount

```js
db.books.find({ pageCount: null })
```

<!-- Answer: Using null instead of 0 enables meaningful filtering -->

---

# Lab 5: Referenced Lookup

Join books with authors

```js
db.books.aggregate([
  {
    $lookup: {
      from: "authors",
      localField: "authorIds",
      foreignField: "_id",
      as: "authors"
    }
  }
])
```

<!-- Answer: $lookup required because authors are stored separately -->

---

# Lab 6: Projection

Return title and author names only

```js
db.books.aggregate([
  { $lookup: { from: "authors", localField: "authorIds", foreignField: "_id", as: "authors" } },
  { $project: { title: 1, "authors.name": 1, _id: 0 } }
])
```

<!-- Answer: Projection limits output and demonstrates aggregation shaping -->

---

# Lab 7: Design Comparison

Embedded vs Referenced

- Which is faster for reads?
- Which reduces duplication?

<!-- Answer: Embedded = faster reads, Referenced = less duplication and more flexible -->

---

# Lab 8: Schema Validation

Add validation rule

```js
db.runCommand({
  collMod: "books",
  validator: {
    $jsonSchema: {
      bsonType: "object",
      required: ["authors", "categories"],
      properties: {
        authors: { minItems: 1 },
        categories: { minItems: 1 }
      }
    }
  }
})
```

<!-- Answer: Validation enforces structure in a flexible schema -->

---


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
