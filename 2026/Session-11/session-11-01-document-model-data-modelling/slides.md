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

**"If joins are expensive, what replaces them?"**

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

"If joins are expensive, what replaces them?"
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

"Joins are the normal way to model relationships."

In document databases, that assumption must be unlearned.
The warm‑up is designed to:

Surface relational reflexes
Introduce trade‑off thinking
Prepare students for embedded vs referenced modelling
Make later Compass demos "click" faster

By the end of the warm‑up, students should:
✅ Feel that joins are not free
✅ Accept that duplication can be intentional
✅ Understand modelling decisions affect performance
✅ Be primed to evaluate trade‑offs, not rules
They are not yet expected to:

Choose the "right" model
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

# MongoDB & BSON

---
level: 2
layout: two-cols
---

# MongoDB & BSON

::left::

### BSON (Binary JSON)

- Used by MongoDB to store documents
- Extends JSON with additional data types
- designed for efficient storage and retrieval

<br>

### MongoDB Documents

- BSON used
- Document = collection of key-value pairs
- Values have data type: 
  - String, Number, Boolean,
  - Date, Array, Embedded document,
  - ObjectId (a unique identifier), and more

::right::

### Example BSON Document

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

<!-- Presenter Notes:

BSON (Binary JSON) is the data format used by MongoDB to store documents. It
extends JSON with additional data types and is designed for efficient storage
and retrieval.


MongoDB uses BSON to represent documents, which are the basic units of data in
MongoDB. Each document is a collection of key-value pairs, where the keys are
strings and the values can be various data types.
-->

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
    - → few: Embed
    - → many: Reference
- Many-to-Many
    - → Reference (or duplicate for reads)

<Announcement type="idea" title="Relationships" class="mt-6">
<p class="text-white! p-2! m-0! text-xl">
Patterns — Not rules
</p>
</Announcement>


---
level: 2
layout: two-cols
---


# Data Consistency: Embedding vs Referencing
## Embedding & Referencing: **Pros**

::left::

### Embedding 

<ul>
<li class="leading-6! mb-2">  
<strong>Document‑level atomicity</strong>
<br><small class="text-zinc-300">All updates to an embedded document are atomic  within a single document.</small>
</li>
<li class="leading-6! mb-2">  
<strong>Data updated together</strong>
<br><small class="text-zinc-300">Ensures related data stays consistent automatically. </small>
</li>
<li class="leading-6! mb-2">  
<strong>No multi‑document transactions required</strong>
<br><small class="text-zinc-300">Simplifies logic and reduces failure points.  </small>
</li>
<li class="leading-6! mb-2">  
<strong>Strong read consistency</strong>
<br><small class="text-zinc-300">Reads always return a fully consistent view of the data.  </small>
</li>
</ul>


::right::

### Referencing 

<ul>
<li class="leading-6! mb-2">  
<strong>Single source of truth</strong>
<br><small class="text-zinc-300">Data stored once, reducing duplication.</small>
</li>
<li class="leading-6! mb-2">  
<strong>Independent updates</strong>
<br><small class="text-zinc-300">Related entities can change independently. </small>
</li>
<li class="leading-6! mb-2">  
<strong>Better for frequently changing/shared data</strong>
<br><small class="text-zinc-300"></small>
</li>
<li class="leading-6! mb-2">  
<strong>More flexible data evolution</strong>
<br><small class="text-zinc-300"></small>
</li>
</ul>

<!-- Presenter Notes:

Frame this slide around *consistency*, not performance.

Key teaching points to emphasise verbally:

• MongoDB guarantees atomicity ONLY at the document level.
  This is the single most important consistency rule students must remember.

• Embedding is the safest choice when data must always be consistent together.
  If two pieces of data must never disagree, they probably belong in one document.

• Referencing introduces flexibility but shifts responsibility to the developer.
  Transactions are available, but they increase complexity and cost.

• Stress that transactions are not "bad" – but they are a signal that the model
  may be fighting the document model rather than using it naturally.

Diagnostic questions to ask students:
- "Does this data ever make sense being out of sync?"
- "What happens if an update fails halfway through?"
- "Is eventual consistency acceptable in this context?"

Tie directly to assessment:
- Students should justify embedding by pointing to atomicity and consistency.
- Students should justify referencing by discussing shared data and lifecycle differences.

Close with:
‘MongoDB gives you choices — but consistency is never free. You decide where the cost lives.’

-->

---
level: 2
layout: two-cols
---


# Data Consistency: Embedding vs Referencing

## Embedding & Referencing: **Cons**

::left::
### Embedding 

<ul>
<li class="leading-6! mb-2">  
<strong>Data duplication risk</strong>
<br><small class="text-zinc-300">Updates may need to be repeated across documents.</small>
</li>
<li class="leading-6! mb-2">  
<strong>Harder to update shared data</strong>
<br><small class="text-zinc-300">Multiple documents may need changes.</small>
</li>
<li class="leading-6! mb-2">  
<strong>Unbounded growth concerns</strong>
<br><small class="text-zinc-300">Risk of large documents and update overhead.</small>
</li>

</ul>


::right::
### Referencing 

<ul>
<li class="leading-6! mb-2">
<strong>No automatic cross‑document atomicity</strong>
<br><small class="text-zinc-300">Updates across documents are not atomic by default. </small>
</li>
<li class="leading-6! mb-2">
<strong>May require transactions</strong>
<br><small class="text-zinc-300">Multi‑document updates need explicit transaction handling. </small>
</li>
<li class="leading-6! mb-2">
<strong>More complex consistency logic</strong>
<br><small class="text-zinc-300">Application code must handle partial updates and failures. </small>
</li>
<li class="leading-6! mb-2">
<strong>Potential for temporary inconsistency</strong>
<br><small class="text-zinc-300">Especially in distributed or failure scenarios. </small>
</li>
</ul>


<!-- Presenter Notes:

Frame this slide around *consistency*, not performance.

Key teaching points to emphasise verbally:

• MongoDB guarantees atomicity ONLY at the document level.
  This is the single most important consistency rule students must remember.

• Embedding is the safest choice when data must always be consistent together.
  If two pieces of data must never disagree, they probably belong in one document.

• Referencing introduces flexibility but shifts responsibility to the developer.
  Transactions are available, but they increase complexity and cost.

• Stress that transactions are not "bad" – but they are a signal that the model
  may be fighting the document model rather than using it naturally.

Diagnostic questions to ask students:
- "Does this data ever make sense being out of sync?"
- "What happens if an update fails halfway through?"
- "Is eventual consistency acceptable in this context?"

Tie directly to assessment:
- Students should justify embedding by pointing to atomicity and consistency.
- Students should justify referencing by discussing shared data and lifecycle differences.

Close with:
‘MongoDB gives you choices — but consistency is never free. You decide where the cost lives.’

-->

---
level: 2
layout: two-cols
---
# Schema-on-Read vs Write

::left::

### Quick Comparison

- Read: 
  - Flexible, 
  - App-enforced
- Write: 
  - Rigid, 
  - DB-enforced
- Use validators for balance

::right::

<Announcement type="important" title="Embedded & Referencing" class="mt-6">
<p>
The application's code will need to do more work to ensure data consistency. 
</p>
<p>
MongoDB schema validation can be used to re‑introduce structure where consistency is critical.
</p>
<p>
This includes inserts, updates and deletes.
</p>
<p>
This also includes data security in validation, referencing checks and more.
</p>
</Announcement> 

---
level: 2
layout: two-cols
---

## Guided Demo — Relational → Document

::left::

### Relational:

```
users(id,name)
orders(id,user_id,order_at)
order_items(order_id,sku,qty)
```

<Announcement type="idea" title="Relational Model" class="mt-4">
<p>The example does not consider issue of ensuring an order number such as 
"order_id", instead for simplicity opting for only showing "order_at" 
(Y-M-D).</p>
<p>In a real‑world scenario, you would expect a more robust system for the 
order number.</p>
</Announcement>


::right::

### Document

```json
{
  "_id": 1,
  "name": "Alice",
  "orders": [
    {
      "order_at": "2026-04-10",
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


<!-- Presenter Notes:

Aside: You may want to include the `user_id` in the orders collection for 
easier referencing in a real‑world scenario, but this simplified example 
focuses on the embedding aspect.

-->

---
layout: section
---

# MongoDB Compass — Demo

---
level: 2
---

# MongoDB Compass — Demo

## Overview

1. Create DB: `saas_demo`
2. Create Collection: `users`
3. Import JSON → `users.json`
4. Create Collection: `orders`
5. Import JSON → `orders.json`


---
level: 2
layout: two-cols
---

# MongoDB Compass — Demo

::left::

## Set Up Demo Database 

Create a new database on your MongoDB Atlas account.

- `saas_demo`

<br>
<br>

## Sample Data

Data found on GitHub:
https://github.com/AdyGCode/SaaS-BED-Notes/tree/main/2026/Session-11/session-11-01-document-model-data-modelling/public

::right::

## Collections & Data

Create new collections, and import data into them.

| Collection | Sample Data                         |
|------------|-------------------------------------|
| `users`    | [users.json](./public/users.json)   | 
| `orders`   | [orders.json](./public/orders.json) | 

- Importing one using compass’s UI.
- Import the other using the `mongoimport` CLI tool.

---
level: 2
layout: two-cols
---

# Compass Queries

::left::

## Find Admin Users

```json
{ "role": "admin" }
```

::right::

## Find Users Who Ordered Pro Subscription (SKU-1001)

```json
{ "orders.items.sku": "SKU-1001"}
```


---
level: 2
---

# Compass Aggregation

## Count Items per Order Date (Embedded)
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
level: 2
layout: two-cols-2-1
---

# Consistency in Practice: Concrete Examples

::left::

## User + Orders - Embedding <br><small>(Common Case)</small>
```json
{
  "_id": 1,
  "name": "Alice",
  "orders": [
    { "orderId": "A1001", "total": 148.00 }
  ]
}
```

::right::
#### Note

<span class="rounded bg-green-700 px-2 py-0.5 block my-1">Orders created 
  with user</span>
<span class="rounded bg-green-700 px-2 py-0.5 block my-1">Order + user 
  updated together</span>
<span class="rounded bg-green-700 px-2 py-0.5 block my-1">Atomic by 
  default</span>
<span class="rounded bg-green-700 px-2 py-0.5 block my-1">No transaction 
  needed</span>
<span class="rounded bg-rose-700 px-2 py-0.5 block my-1">Risk if orders 
  grow large</span>

<br>

#### Best when:

- Orders read with user
- Bounded order history


---
level: 2
layout: two-cols-2-1
---

# Consistency in Practice: Concrete Examples

::left::

## User + Roles - Referencing <br><small>(Common Case)</small>

User: 

```json
{
  "_id": 1,
  "name": "Alice",
  "roleIds": [101, 102]
}

```

Role:

```json
[
   { "_id": 101, "name": "admin" },
   { "_id": 102, "name": "editor" }
]
```

::right::

#### Note 

<span class="rounded bg-green-700 px-2 py-0.5 block my-1">Roles shared across users</span>
<span class="rounded bg-green-700 px-2 py-0.5 block my-1">Role changes affect all users</span>
<span class="rounded bg-green-700 px-2 py-0.5 block my-1">Single source of truth</span>
<span class="rounded bg-red-700 px-2 py-0.5 block my-1">Updates span 
documents &rarr; may need transaction</span>

<br>

#### Best when:

- Roles centrally managed
- Role definitions change

<!-- Presenter Notes:

Key contrast:
• Orders belong to a user → same lifecycle → embed
• Roles belong to the system → shared lifecycle → reference

Transactions are required **only when role updates and user updates must succeed or fail together**.

Ask:
"What breaks if this data is briefly inconsistent?"

Link to AT2:
Students should justify model choice using lifecycle + consistency.
-->

---
layout: section
---

# When Transactions Are a Smell


---
level: 2
layout: grid
---

# When Transactions Are a Smell

::tl::

### ⚠ Warning Signs
- Every write requires a transaction
- Transactions used for basic CRUD
- Transactions added to "fix" inconsistency
- High contention or frequent retries

::tr::

### ✅ What It Usually Means
- Data that should live together is split apart
- Schema is over‑normalised
- Access patterns weren’t considered early

::bl::

### ✅ Healthy Mindset
- Use transactions **to protect invariants**
- Avoid transactions for routine updates
- Let document‑level atomicity do the work


::br::

<Announcement type="info" title="Transactions">
<p>... are a tool — not a default solution.</p>

<p>If <b>every update</b> needs a transaction, <b>re‑examine the model,
not the code</b>.</p>
</Announcement> 

<!--
Important nuance:
Transactions are not bad.
Needing them ALL THE TIME is the smell.

Ask class:
"What invariant am I protecting?"
If the answer is unclear, the model is likely wrong.

Preview later sessions:
Transactions are powerful — but costly.
-->

---
layout: section
---

# Demo: Inconsistency vs Atomicity

## Scenario: Create a user and their first order.

---
level: 2
layout: two-cols
---

# Scenario: Create a user and their first order.

## Referenced Model (Without Transaction)

::left::

### Step 1 — Insert user

```js
db.users.insertOne({
  _id: 100,
  name: "Referenced User"
});
```

<br>

### Step 2 — Insert order

```js
db.orders.insertOne({
  userId: 100,
  orderNumber: "X999",
  total: 50
});
```

::right::

#### If Step 2 fails?

- User exists
- Order does not
- System is inconsistent


<!-- Presenter Notes:

Before step 2, simulate failure, for example:

```js
db.orders.insertOne({
  userId: 99,
  orderNumber: "X999",
  total: 50
});
```

-->

---
level: 2
layout: two-cols
---

# Scenario: Create a user and their first order.

## Embedded Model (Atomic)

::left::

```js
db.users.insertOne({
  _id: 101,
  name: "Atomic User",
  orders: [
    { orderNumber: "A001", total: 50 }
  ]
});
```

::right::

- Either everything succeeds
- Or nothing is written

<!-- Presenter Notes:

### Compass UI Guidance (Say This While Demoing)
- Show Documents tab
- Refresh after Step 1 to show partial state
- Contrast with embedded insert
- Ask students: "Which one can’t break?"

-->

---
level: 2
layout: two-cols-2-1
---


# Scenario: Create a user and their first order.

::left::

### Referencing WITH Transaction (Advanced)

```js
const session = db.getMongo().startSession()
session.startTransaction()
try {
  session.getDatabase("saas_demo").users.insertOne(
    { _id: 202, name: "Txn User" },
    { session }
  )

  session.getDatabase("saas_demo").orders.insertOne(
    { userId: 202, orderNumber: "TXN-01", total: 100 },
    { session }
  )

  session.commitTransaction()
} catch (e) {
  session.abortTransaction()
}
```


::right::

#### Note:

- Consistent

<br>

#### But...

- More complex
- More overhead


<!-- Presenter Notes:

Teaching emphasis:

• Transactions fix consistency, but at a cost
• Embedded model avoided the problem entirely
• Design choice determines complexity

Strong line to use: “The best transaction is the one you don’t need.”

-->


---
layout: section
---

# Common Modelling Mistakes

---
level: 2
layout: two-cols
---

# Common Modelling Mistakes

::left::

### Quick List

- Unlimited arrays (16MB risk)
- Over-normalising
- Deep nesting
- Ignoring access patterns
- No validation

<br>

### Unlimited Array Growth

- Risks 16MB limit
- Slow updates

::right::

### Over-Normalising

- SQL mindset

<br>

### Deep Nesting

- Hard to query/index

<br> 
<br> 

### <strong>Checklist</strong>

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


::right::
## What's next...

The next exercises are practical... 

<Announcement type="important" title="Preparation" class="text-2xl pt-4">
<p class="text-xl">
Make sure you have completed the imports from the previous exercises.
</p>

</Announcement>

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
- "Read together"
- "Bounded growth"
- "Performance trade‑off"


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
layout: two-cols
---
# Practice Exercises: Queries

::left::

### Use Compass for these queries:

<br>

#### Find all orders containing the Pro Subscription
```json
{ "items.sku": "SKU-1001" }
```

#### Orders per suspended user
```json
{
  "userId":
    ObjectId("661fa9000000000000000001")
}
```

#### Users who have purchased Extra Storage
```json
{ "orders.items.sku": "SKU-3001" }
```

::right::

### Use Mongo CLI for these queries:

These are queries that are not the same as the previous Compass based ones.

Query 1:- 

```js
db.users.find({ 
  "userId":
    ObjectId("661fa9000000000000000001") 
})
```

Query 2:- 

```js
db.users.find({
  "orders.items.sku": "SKU-3001" 
})
```



---
level: 2
layout: two-cols
---
# Practice Exercises

::left::

## Decision

When creating an application and developing its data support structure... 
consider the following:

- Would you embed login history? 
- Why did you make that decision?


::right::

## Anti-patterns

Identify issues in unlimited arrays.

Here is a sample as a prompt...

```json
{
  "account": "acme",
  "transactions": [ /* millions */ ]
}
```

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

# Recap Checklists

<div class="bg-indigo-700! flex-col! gap-4! pt-2! pb-4! px-6! rounded-xl w-[56ch]! ml-12">
<p class="text-2xl! text-white!">If you can explain your design choices 
clearly,
</p>
<p class="text-2xl! text-white!">you are modelling data — not just 
storing it.
</p>
</div>

---
level: 2
layout: two-cols
---

# Recap Checklists

::left::

### Document Model Fundamentals
- [ ] Explain what **BSON** is and why MongoDB uses it
- [ ] Identify common BSON data types (ObjectId, Date, Array, Embedded Documents)
- [ ] Read and understand a nested MongoDB document

::right::

### Data Modelling Decisions
- [ ] Explain the difference between **embedded** and **referenced** documents
- [ ] Choose an appropriate model for:
  - [ ] One‑to‑one relationships
  - [ ] One‑to‑many (few vs many)
  - [ ] Many‑to‑many
- [ ] Justify modelling choices using **access patterns**, not habit


---
level: 2
layout: two-cols
---

# Recap Checklists

::left::

### Data Consistency & Atomicity
- [ ] Explain **document‑level atomicity**
- [ ] Identify when embedding improves consistency
- [ ] Identify when referencing introduces consistency risks
- [ ] Explain when **transactions are required** — and when they are a warning sign

::right::

### Trade‑Off Awareness
- [ ] Describe **pros and cons** of embedding vs referencing
- [ ] Recognise common modelling mistakes:
  - [ ] Unlimited array growth
  - [ ] Over‑normalising (SQL mindset)
  - [ ] Deep nesting
- [ ] Apply the **healthy modelling checklist**:
  - [ ] Bounded growth
  - [ ] Query‑first design
  - [ ] Justified duplication


---
level: 2
layout: two-cols
---

# Recap Checklists

::left::

### Practical Skills (Compass & CLI)
- [ ] Import JSON data into MongoDB Atlas using **Compass**
- [ ] Write and run basic **find** queries with dot notation
- [ ] Query nested arrays (e.g. `orders.items.sku`)
- [ ] Recognise inconsistent vs atomic write scenarios
- [ ] Explain the difference between embedded atomic writes and referenced multi‑step writes

::right::

### Assessment Readiness
- [ ] Convert a simple relational schema into a document model
- [ ] Explain *why* an embed or reference choice was made
- [ ] Use correct terminology in justifications (atomicity, access patterns, trade‑offs)
- [ ] Describe potential risks and how they were mitigated


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
