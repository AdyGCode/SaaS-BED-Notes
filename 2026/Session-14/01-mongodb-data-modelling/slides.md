---
theme: nmt
background: https://cover.sli.dev
title: MongoDB Exercises 1 - Data Modeling
class: text-left
drawings:
  persist: false
transition: fade
mdc: true
duration: 35min
---

# MongoDB Exercises 1 - Data Modeling

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

# MongoDB Exercises 1 - Data Modelling

---
level: 2
---

# MongoDB Exercises 1 - Data Modelling

Before you start you will require some sample data [bib-data.json](public/bib-data.json).

You may download this from GitHub:

- https://githug.com/AdyGCode/SaaS-BED-Notes/
- Open: 2026/Session-14/01-mongodb-data-modelling/public/
- Download: bib-data.json

We also show the data on the next slide.

---
level: 2
---

# MongoDB Exercises 1 - Data Modelling

### Sample Data: Bibliography / Book Collection

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
```

```json
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
```

```json
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
```

```json

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

````

---
level: 2
---

# MongoDB Exercises 1 - Data Modelling

## Section 1: Identifying Issues

1. Identify at least five data quality or modelling issues in the dataset.

2. Which fields show inconsistent structure across documents?

3. What problems do you see with the authors field?

4. What problems do you see with the categories field?

5. Why is pageCount = 0 potentially problematic?

<!-- Presenter Notes: 

1. Identify at least five data quality or modelling issues

    - Duplicate records (same isbn + title)
    - pageCount set to 0 (invalid placeholder)
    - Empty strings in arrays (authors, categories)
    - Missing fields (authors, categories, descriptions)
    - Inconsistent description fields (shortDescription vs longDescription)
    - Non-native MongoDB date structure ($date wrapper)
    - Empty arrays (authors: [])


2. Fields with inconsistent structure

    - authors (empty array vs populated vs contains empty string)
    - categories (empty vs populated vs contains empty string)
    - description fields (sometimes short, sometimes long, sometimes missing)
    - pageCount (0 vs valid numbers)


3. Problems with authors

    - Contains empty strings ("")
    - Empty array in one document
    - No validation for at least one author


4. Problems with categories

    - Contains empty strings
    - Sometimes completely empty
    - Lacks standardisation (could vary in casing or naming)


5. Why pageCount = 0 is problematic

    - Misleading (book cannot have 0 pages)
    - Breaks numeric queries (e.g., filtering books > 100 pages)
    - Should use null for unknown values



-->

---
level: 2
---

# MongoDB Exercises 1 - Data Modelling

### Section 2: Data Integrity & Consistency

6. Identify any duplicate records. What field(s) indicate duplication?

7. Why is the current use of isbn insufficient for ensuring uniqueness?

8. What issues arise from missing or empty arrays (e.g., authors, categories)?

9. Should shortDescription and longDescription always exist? Justify your answer.

<!-- Presenter Notes: 

6. Duplicate records

    - First and fourth documents:
        - Same title: MongoDB Basics
        - Same ISBN: 1111111111


7. Why isbn is insufficient

    - Not enforced as unique
    - Duplicate ISBN exists in dataset
    - Some datasets may have missing ISBNs


8. Issues with empty arrays

    - Makes querying unreliable
    - Violates expectation that a book must have authors/categories
    - Can cause errors in aggregation pipelines


9. Should descriptions always exist?

    - Yes (recommended) for consistency
    - OR define as optional but consistently handled
    - Better design: unified structure
    ```json
    description: {
      short: null,
      long: null
    }
    ```

-->

---
level: 2
---

# MongoDB Exercises 1 - Data Modelling

### Section 3: Data Types & Structure

10. What is wrong with the current publishedDate format from a MongoDB perspective?

11. How should publishedDate be stored instead?

12. Suggest improvements to the structure of the description fields.

13. Would you embed or reference authors in this dataset? Explain why.

<!-- Presenter Notes: 

10. Issue with publishedDate

    - Uses $date wrapper (import/export format)
    - Not ideal for querying or indexing


11. Correct format

    ```javascript
    publishedDate: ISODate("2015-01-01T00:00:00Z")
    ```

12. Improve description structure

    - Combine fields:
    ```JavaScript
    description: {  short: "Intro to MongoDB",  long: "Detailed explanation..."}
    ```

13. Embed or reference authors?

    - ✅ Embed for this dataset (simple, small, read-heavy)
    - ❗ Reference if:
        - Authors reused heavily
        - Need author metadata

-->


---
level: 2
layout: two-cols
---

# MongoDB Exercises 1 - Data Modelling

<br>

### Section 4: Data Cleaning & Transformation

::left::

### Fixing a Document

14. Rewrite one document to:

- Remove invalid values
- Use correct data types
- Improve consistency

::right::

### Handling problematic fields

15. How would you handle:

- Empty strings in arrays?
- Missing fields?
- Invalid numeric values?

<!-- Presenter Notes: 

14. Cleaned document example

```json
{
  _id: ObjectId(),
  title: "MongoDB Basics",
  isbn: "1111111111",
  pageCount: null,
  publishedDate: ISODate("2015-01-01T00:00:00Z"),

  authors: ["John Doe"],
  categories: ["Databases"],

  description: {
    short: "Intro to MongoDB",
    long: null
  },

  thumbnailUrl: "http://example.com/mongo.jpg",
  status: "published"
}
```

15. Handling issues

- Empty strings → remove
- Missing fields → set to null or omit consistently
- Invalid numbers → replace with null

-->


---
level: 2
---

# MongoDB Exercises 1 - Data Modelling

### Section 5: Schema Design

16. Propose a MongoDB schema validation rule for this collection.

17. Which fields should be required? Why?

18. Which fields should be optional? Why?

<!-- Presenter Notes: 

16. Schema validation example

```json
db.createCollection("books", {
  validator: {
    $jsonSchema: {
      bsonType: "object",
      required: ["title", "authors", "categories"],
      properties: {
        title: { bsonType: "string" },
        authors: {
          bsonType: "array",
          minItems: 1,
          items: { bsonType: "string" }
        },
        categories: {
          bsonType: "array",
          minItems: 1
        },
        pageCount: {
          bsonType: ["int", "null"]
        }
      }
    }
  }
})
```

17. Required fields

    - title
    - authors
    - categories
    - publishedDate
    
    Needed for meaningful queries

18. Optional fields

    - description
    - thumbnailUrl
    - pageCount
    - status

    Not always available
-->


---
level: 2
---

# MongoDB Exercises 1 - Data Modelling

### Section 6: Indexing & Performance

19. Which fields would you index for efficient querying?

20. Why would you create a text index, and on which fields?

<!-- Presenter Notes: 

19. Fields to index

    - isbn (unique)
    - title
    - authors
    - categories
    - publishedDate


20. Text index

    Used for search functionality:
    ```json
    db.books.createIndex({
      title: "text",
      "description.long": "text"
    })
    ```
-->


---
level: 2
layout: two-cols
---

# MongoDB Exercises 1 - Data Modelling

## Section 7: Design Decisions

::left::

### Design Decision

21. What to do with Status?

Would you:

- Keep status?
- Modify it?
- Remove it?

Justify your decision.

::right::

### Real-World Fields

22. Additional Useful Fields

What additional fields would improve this dataset for real-world use?

<!-- Presenter Notes: 

21. What to do with status?

    - Keep but standardise
    - e.g.

    ```javascript 
    status: "published" | "draft" | "preview"
    ```

    - Or remove if unused


22. Additional useful fields

    - publisher
    - language
    - edition
    - createdAt
    - updatedAt
    - tags

-->


---
level: 2
---

# MongoDB Exercises 1 - Data Modelling

## Section 8: Advanced Modelling

23. When would you switch from embedded authors to a separate authors collection?

24. What are the trade-offs between embedding and referencing in this case?

25. How would you model book editions or multiple formats (e.g., ebook, print)?

<!-- Presenter Notes: 

23. When to use separate authors collection

Many books share the same author
Need author details (bio, nationality)

24. Embedding vs Referencing

|Approach | Pros | Cons |
|---|---|---|
|Embedded | Fast reads, simple | Data duplication |
|Referenced | Normalised, reusable | Requires joins ($lookup) |

25. Modelling editions/formats

  - Option 1: Embedded
  ```json
  formats: [
    { type: "ebook", price: 10 },
    { type: "print", price: 25 }
  ]
  ```
  - Option 2: Referenced
  ```json
  bookFormats: {
    bookId,
    type,
    price
  }
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

- Hows, D., Plugge, E., & Membrey, P. (2015). *MongoDB: The Definitive Guide* (2nd ed.). O’Reilly Media.

- Kleppmann, M. (2017). *Designing Data-Intensive Applications*. O’Reilly Media.

- MongoDB, Inc. (2024). *Data Modeling
  Introduction*. https://www.mongodb.com/docs/manual/core/data-modeling-introduction/

- MongoDB, Inc. (2024). *Model Data for Atomic
  Operations*. https://www.mongodb.com/docs/manual/core/data-model-operations/

- MongoDB. (2026). *MongoDB Courses and Trainings | MongoDB Shell Cheatsheet | MongoDB University*.
  Mongodb.com. https://learn.mongodb.com/learn/course/mongodb-shell-cheatsheet/

- MongoDB University. (n.d.). *Introduction to MongoDB Data
  Modeling*.  https://learn.mongodb.com/courses/introduction-to-mongodb-data-modeling

- Sadalage, P. J., & Fowler, M. (2013). *NoSQL Distilled: A Brief Guide to the Emerging World of Polyglot Persistence*.
  Addison-Wesley.

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
