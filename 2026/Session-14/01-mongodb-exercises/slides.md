---
theme: nmt
background: https://cover.sli.dev
title: MongoDB Exercises 1
class: text-left
drawings:
  persist: false
transition: fade
mdc: true
duration: 35min
---

# MongoDB Exercises 1

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

# MongoDB Exercises 1
## Data Modelling

---
level: 2
---


# MongoDB Exercises 1
## Data Modelling

Before you start you will require some sample data [bib-data.json](public/bib-data.json).

You may download this from GitHub:
- https://githug.com/AdyGCode/SaaS-BED-Notes/
- Open: 2026/Session-14/01-mongodb-exercises/public/ 
- Download: bib-data.json

Sample Data: Bibliography / Book Collection

````md magic-move

```json
[
  {
    "title": "MongoDB Basics",
    "isbn": "1111111111",
    "pageCount": 0,
    "publishedDate": { "$date": "2015-01-01T00:00:00.000Z" },
    "thumbnailUrl": "http://example.com/mongo.jpg",
    "shortDescription": "Intro to MongoDB",
    "status": "PUBLISH",
    "authors": ["John Doe", ""],
    "categories": ["Databases", ""]
  },
  {
    "title": "Advanced MongoDB",
    "isbn": "2222222222",
    "pageCount": 450,
    "publishedDate": { "$date": "2018-05-10T00:00:00.000Z" },
    "thumbnailUrl": "http://example.com/advanced.jpg",
    "longDescription": "Deep dive into MongoDB internals",
    "status": "MEAP",
    "authors": [],
    "categories": ["Databases"]
  },
  {
    "title": "Learning NoSQL",
    "isbn": "3333333333",
    "pageCount": 300,
    "publishedDate": { "$date": "2017-07-15T00:00:00.000Z" },
    "thumbnailUrl": "http://example.com/nosql.jpg",
    "shortDescription": "NoSQL overview",
    "longDescription": "Covers MongoDB, Cassandra, and more",
    "status": "PUBLISH",
    "authors": ["Jane Smith"],
    "categories": []
  },
  {
    "title": "MongoDB Basics",
    "isbn": "1111111111",
    "pageCount": 250,
    "publishedDate": { "$date": "2016-01-01T00:00:00.000Z" },
    "thumbnailUrl": "http://example.com/mongo2.jpg",
    "status": "PUBLISH",
    "authors": ["John Doe"],
    "categories": ["Databases"]
  }
]
```



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


- MongoDB, Inc.  
  *Data Modeling Principles*  
  https://www.mongodb.com/docs/manual/core/data-modeling/

- Kleppmann, M.  
  *Designing Data-Intensive Applications*  
  Chapters 2 & 3 (Data Models, Storage & Retrieval)

- Fowler, M.  
  *Patterns of Distributed Systems*  
  https://martinfowler.com/articles/patterns-of-distributed-systems/



---
layout: section
---

# Acknowledgements and References

---
level: 2
---

# Acknowledgements and References

- Hows, D., Plugge, E., & Membrey, P. (2015). *MongoDB: The Definitive  Guide* (2nd ed.). O’Reilly Media.

- Kleppmann, M. (2017). *Designing Data-Intensive Applications*. O’Reilly Media.

- MongoDB, Inc. (2024). *Data Modeling Introduction*. https://www.mongodb.com/docs/manual/core/data-modeling-introduction/

- MongoDB, Inc. (2024). *Model Data for Atomic Operations*. https://www.mongodb.com/docs/manual/core/data-model-operations/

- MongoDB. (2026). *MongoDB Courses and Trainings | MongoDB Shell   Cheatsheet |  MongoDB University*.  Mongodb.com. https://learn.mongodb.com/learn/course/mongodb-shell-cheatsheet/

- MongoDB University. (n.d.). *Introduction to MongoDB Data Modeling*.  https://learn.mongodb.com/courses/introduction-to-mongodb-data-modeling

- Sadalage, P. J., & Fowler, M. (2013). *NoSQL Distilled: A Brief Guide to the Emerging World of Polyglot Persistence*. Addison-Wesley.

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
