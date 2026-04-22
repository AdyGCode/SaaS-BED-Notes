---
theme: nmt
background: https://cover.sli.dev
title: Session 11 - Data Modeling and the Document Model
class: text-left
drawings:
  persist: false
transition: fade
mdc: true
duration: 35min
---

# Data Modeling and the Document Model

## Software as a Service - Back-End Development

#### ICT50120 Diploma of Information Technology (Advanced Programming)<br>

#### ICT50120 Diploma of Information Technology (Back-End Development)

<div @click="$slidev.nav.next" class="mt-12 -mx-4 p-4" hover:bg="white op-10">
<p>Press <kbd>Space</kbd> or <kbd>RIGHT</kbd> for next slide/step <fa7-solid-arrow-right /></p>
</div>

<div class="abs-br m-6 text-xl">
  <a href="https://github.com/adygcode/SaaS-FED-Notes" target="_blank" class="slidev-icon-btn">
    <fa7-brands-github class="text-zinc-300 text-3xl -mr-2"/>
  </a>
</div>


<!-- Presenter Notes: 

Emphasise modelling decisions drive performance and maintainability. 

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

# Warm up

---
level: 2
layout: two-cols
---

# Warm up...

::left::

## Thought Exercise (1 minute)

**“If joins are expensive, what replaces them?”**

Think about it for a moment.

::right::

## Discussion (2–3 minutes)

Turn to the person next to you.

Share your thoughts.

<hr>

**Note:** There are no right or wrong answers.

- Say what might replace joins.
    - You don’t need the ‘right answer’.
    - Speculate based on your knowledge.
- Why do you think that?

<!-- Presenter Notes:

“If joins are expensive, what replaces them?”
Duration: ~10 minutes
Purpose: Conceptual reframing (SQL → document thinking)
Cognitive level: Threshold‑concept activation
Assessment role: Language + reasoning students will reuse in AT2

1. Why This Question Exists (Instructor Intent)
This question is deliberately provocative and incomplete.
It is not asking for:

a single correct answer
a MongoDB feature name
a technical workaround

It is asking students to confront a broken assumption:

“Joins are the normal way to model relationships.”

In document databases, that assumption must be unlearned.
The warm‑up is designed to:

Surface relational reflexes
Introduce trade‑off thinking
Prepare students for embedded vs referenced modelling
Make later Compass demos “click” faster

By the end of the warm‑up, students should:
✅ Feel that joins are not free
✅ Accept that duplication can be intentional
✅ Understand modelling decisions affect performance
✅ Be primed to evaluate trade‑offs, not rules
They are not yet expected to:

Choose the “right” model
Understand all cases
Know MongoDB syntax

-->

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

- Explain BSON
- Choose embedded vs referenced
- Model 1–1, 1–M, M–M
- Explain schema-on-read/write
- Convert relational → document

::right::

<Announcement type="idea" title="">
<div class="m-4 text-xl">

<p>Tables fall apart </p>
<p>Data learns to live together </p>
<p>Queries breathe again </p>

</div>

</Announcement>

---
layout: section
---

# BSON Structure

---
level: 2
layout: default
---

# BSON Structure

BSON (Binary JSON) is the data format used by MongoDB to store documents. It
extends JSON with additional data types and is designed for efficient storage
and retrieval.

MongoDB uses BSON to represent documents, which are the basic units of data in
MongoDB. Each document is a collection of key-value pairs, where the keys are
strings and the values can be various data types, including:

- String
- Number
- Boolean
- Date
- Array
- Embedded document
- ObjectId (a unique identifier)

and more

## Example BSON Document

```json
{
  "_id": {
    "$oid": "661fa9..."
  },
  "name": "Alice",
  "createdAt": {
    "$date": "2026-04-10T00:00:00Z"
  },
  "roles": [
    "admin"
  ],
  "profile": {
    "campus": "Midland"
  }
}
```

---
layout: section
---

# Embedded vs Referenced & Relationships
---
level: 2
layout: two-cols
---

# Embedded vs Referenced & Relationships

::left::

## Embedded vs Referenced

| _**Embed**_  | _**Reference**_ |
|--------------|-----------------|
| Fast reads   | Isolated writes |
| Denormalised | Normalised      |

::right::

## Relationships

- One-to-One
    - → Embed
- One-to-Many
    - → Embed (few) / Reference (many)
- Many-to-Many
    - → Reference (or duplicate for reads)

---
level: 2
---

## Schema-on-Read vs Write

- Read: Flexible, app-enforced
- Write: Rigid, DB-enforced
- Use validators for balance

---

## Guided Demo — Relational → Document

Relational:

```
users(id,name)
orders(id,user_id)
order_items(order_id,sku,qty)
```

Document:

```json
{
  "_id": 1,
  "name": "Alice",
  "orders": [
    {
      "items": [
        {
          "sku": "SKU-1001",
          "qty": 2
        }
      ]
    }
  ]
}
```

---

## MongoDB Compass — Demo

1. Create DB: `saas_demo`
2. Create Collection: `users`
3. ADD DATA → Import JSON → `users.json`

---

## Compass Queries

```js
{
    "role"
:
    "admin"
}
```

```js
{
    "orders.items.sku"
:
    "SKU-1001"
}
```

---

## Compass Aggregation

```js
[
    {"$unwind": "$orders"},
    {
        "$group": {
            "_id": "$orders.date",
            "totalItems": {"$sum": {"$size": "$orders.items"}}
        }
    }
]
```

---
layout: section
---

# Common Modelling Mistakes

---
level: 2
---

# Common Modelling Mistakes

- Unlimited arrays (16MB risk)
- Over-normalising
- Deep nesting
- Ignoring access patterns
- No validation


# 🚨 Common Modelling Mistakes

## ❌ Unlimited Array Growth
- Risks 16MB limit
- Slow updates

## ❌ Over-Normalising
- SQL mindset

## ❌ Deep Nesting
- Hard to query/index

## ✅ Checklist
- Bounded growth
- Query-first design
- Justified duplication

---
layout: section
---

# Practice Exercises

---
level: 2
---
# Practice Exercises

Here is some practice on:

- Import data
- Run provided queries
- Redesign to referenced model
- Justify decisions

---
level: 2
layout: two-cols
---
# Practice Exercises

::left::

## Concepts

1. What is BSON?
2. Embed vs reference?
3. Schema-on-read?

<br>

#### Set Up Demo Database 

Create a new database on your MongoDB Atlas account.
- `saas_demo`

::right::
#### Collections & Data

Create new collections, and import data into them.

| Collection | Sample Data |
|------------|----------------------------------------|
| `users`    | [users.json](./public/users.json) | 
| `orders`   | [orders.json](./public/orders.json) | 

Data also found on GitHub:


<!-- Presenter Notes:

Dataset Context Recap (for Marking)
You have two parallel models of the same domain:

- Embedded model → users collection (users contain orders)
- Referenced model → orders collection (orders reference users)

The data includes:

- 3 users: Alice (admin), Bob (user), Carla (user, suspended)
- 5 orders total
- Shared SKUs:
  - SKU-1001 (Pro Subscription)
  - SKU-3001 (Extra Storage Pack)


Q1. What is BSON?
Expected answer:

- BSON is a binary‑encoded format used by MongoDB to store documents.
- It extends JSON by supporting additional data types such as dates, 
ObjectIds, and integers, making it efficient for storage and querying.

Key points:
- Binary JSON
- Supports more types than JSON
- Used internally by MongoDB


Q2. When would embedding be preferred over referencing?

Expected answer:

- Embedding is preferred when data is frequently read together, has a 
bounded size, and shares the same lifecycle, because it reduces the need for joins or multiple queries and improves read performance.

Key Pints:
- “Read together”
- “Bounded growth”
- “Performance trade‑off”


Q3. What is schema‑on‑read?

Expected answer:
- Schema‑on‑read means the database does not enforce a rigid structure at 
write time, and data shape is validated or interpreted by the application or at query time instead.

Possible variations:
- Flexible schema
- Enforced in application
- Optional validators


Collection setup: 
- use saas_demo

Find admin users (Embedded model)
- Returns Alice Chen only

- db.users.find( { role: "admin" } )


Find users who ordered Pro Subscription (SKU-1001)
- Alice Chen
- Bob Williams
- Carla Ramirez

- db.users.find(  { "orders.items.sku": "SKU-1001" },  { name: 1, email: 1 } )


Find users who bought Extra Storage Pack (SKU-3001)

- Alice Chen
- Carla Ramirez

- db.users.find(  { "orders.items.sku": "SKU-3001" },  { name: 1 } )

Count total orders per user (Embedded)

| User  | Orders |
|-------|--------|
| Alice | 2      |
| Bob   | 1      |
| Carla | 2      |

```json
db.users.aggregate([
  {
    $project: {
      name: 1,
      orderCount: { $size: "$orders" }
    }
  }
])
```

-->

---
level: 2
---
# Practice Exercises: Queries

Try the following queries in Compass.

### Find all orders containing the Pro Subscription
```json
{ "items.sku": "SKU-1001" }
```

### Orders per suspended user
```json
{ "userId": ObjectId("661fa9000000000000000003") }
```

### Users who have purchased Extra Storage
```json
{ "orders.items.sku": "SKU-3001" }
```

---
level: 2
layout: two-cols
---
# Practice Exercises

::left::

## Decision
Would you embed login history? 

Why?

::right::

## Anti-patterns

Identify issues in unlimited arrays.

<!-- Presenter Notes:

## Modelling Decision Question (Expected Answer)

Scenario
- SaaS system stores users and their login history.
- Logins grow daily and are rarely viewed.

Expected Answer
- Login history should be referenced rather than embedded, because it grows unbounded over time, is infrequently accessed, and embedding it would risk large document sizes and degraded performance.

✅ Look for:

- Unbounded growth
- Rare access
- Write isolation


## Anti‑Pattern Identification

Given Document

```JSON
{
  "account": "acme",
  "transactions": [ /* millions */ ]
}
```

Correct Identifications
✅ Unlimited growth
❌ Over‑normalisation (not present)
❌ Deep nesting (not present)

Explanation (Expected)

Embedding an ever‑growing array risks exceeding MongoDB’s 16MB document limit and causes performance degradation.

-->


---
layout: section
---

# Recap 🧢

---
level: 2
---

# Recap 🧢

Before leaving, ensure you:

- [ ] 

---
layout: section
---

# Acknowledgements and References

---
level: 2
---

# Acknowledgements and References

- MongoDB. (2026). MongoDB Courses and Trainings | MongoDB Shell Cheatsheet |
  MongoDB University.
  Mongodb.com. https://learn.mongodb.com/learn/course/mongodb-shell-cheatsheet/

- MongoDB University. (n.d.). *Introduction to MongoDB Data Modeling*.
  https://learn.mongodb.com/courses/introduction-to-mongodb-data-modeling

- Hows, D., Plugge, E., & Membrey, P. (2015). *MongoDB: The Definitive
  Guide* (2nd ed.). O’Reilly Media.


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
