---
theme: nmt
background: https://cover.sli.dev
title: Session 10/4 - Learning MongoDB (MongoDB Uni & Geeks for Geeks)
class: text-left
drawings:
  persist: false
transition: fade
mdc: true
duration: 35min
---

# Learning MongoDB

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


<!--
The last comment block of each slide will be treated as slide notes. It will be visible and editable in Presenter Mode along with the slide. [Read more in the docs](https://sli.dev/guide/syntax.html#notes)
-->


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
class: text-left
---

# Objectives

During the completion of the MongoDB Learning, which is conducted over approximately 7 sessions, you will learn:

::left::

- What are MongoDB & NoSQL
- Document model
- Connecting to databases
- CRUD operations:
    - Insert / Find
    - Update / Replace
    - Delete

::right::

- Querying (MongoDB Query Language)
- Aggregation framework
- Indexing and search
- Data modelling basics
- Transactions
- Security (encryption + networking)

---
level: 2
layout: section
---

# Contents

<Toc minDepth="1" maxDepth="1" columns="2" />


---
layout: section
---

# MongoDB: Cheat Sheets

---
level: 2
layout: grid
---

# MongoDB: Cheat Sheets

::tl::

#### MongoDB Shell Cheat Sheet

[Original Download](https://learn.mongodb.com/learn/course/mongodb-shell-cheatsheet/main/mongodb-shell-cheatsheet)

[Repo Copy: MongoDB Shell (2026-04-17)](public/MongoDBShellCheatSheet-FY26.pdf)

<div class="max-w-1/2">

![Screenshot of MongoDB Shell cheat sheet](./images/mongodb-shell-cheatsheet-screenshot.png)

</div>


::tr::

#### SQL to MongoDB Cheat Sheet

[Original download](https://learn.mongodb.com/learn/course/mongodb-sql-cheat-sheet/main/mongodb-sql-cheat-sheet)

[Repo Copy: SQL to MongoDB (2024-09-05)](./public/SQLtoMongoDBCheatSheet1.pdf)

<div class="max-w-1/2">

![Screenshot of SQL to MongoDB cheat sheet](./images/sql-to-mongodb-cheatsheet-screenshot.png)

</div>

::bl::

#### RedHat Developer MongoDB Cheat Sheet

[Repo Copy: Red Hat Developer (2026-05-14)](public/MongoDB-cheat-sheet-Red-Hat-Developer.pdf)

::br::

#### WebDev Simplified MongoDB Cheat Sheet

[Repo Copy: Web Dev Simplified (2026-05-14)](public/WebDevSimplified-MongoDB-CheatSheet-Light.pdf)

---
layout: section
---

# Learning MongoDB: Why, How, and Where

## Going to University (MongoDB Style)

🥇 Sign Up for Free MongoDB Atlas Account

🥈 Complete the:

- <strong class="text-yellow-500!">Introduction to MongoDB course</strong> 📝📽️ and <strong class="text-yellow-500!">
  Additional Required Content</strong> 📝📽️
  <br><i>and/or</i><br>
- <strong class="text-yellow-500!">Geeks-for-Geeks content</strong> 📝

<Announcement type=info title="Key" class="mt-4">
📝 = Written Content
📽️ = Video Content
</Announcement>

---
layout: section
---

# Learning MongoDB: Signing Up

---
level: 2
layout: two-cols
---

# Learning MongoDB: Signing Up

::left::

1) Head
   to [Introduction to MongoDB Course | MongoDB University](https://learn.mongodb.com/learning-paths/introduction-to-mongodb)
2) Create a FREE Atlas Account
   via: [MongoDB Atlas | MongoDB](https://www.mongodb.com/cloud/atlas/register)

::right::

![](./images//MongoDB-Learning-Path-20240905145654430.png)


---
level: 2
layout: two-cols
---

# Learning MongoDB: Signing Up

::left::

3) Once you have created the free account, use teh create deployment option.

![](./images//MongoDB-Learning-Path-20240905145800687.png)

:: right::

4) You will use the FREE level.

![](./images//MongoDB-Learning-Path-20240905145810634.png)


---
level: 2
layout: two-cols
---

# Learning MongoDB: Signing Up

::left::

5) Name your cluster - keep it TAFE appropriate

![](./images//MongoDB-Learning-Path-20240905145817076.png)

6) Use the region with Australia as the cloud location

![](./images//MongoDB-Learning-Path-20240905145823108.png)

::right::

7) You will need to add an IP Address, this is usually done automatically, plus you will need a
   username and password to use the MongoDB Atlas instance.

<div style="width: 70%; margin: auto;">

![](./images//MongoDB-Learning-Path-20240905145836669.png)

</div>


---
layout: section
---

# Learning MongoDB: Intro Course

---
level: 2
layout: two-cols
---

# Learning MongoDB: Intro Course

::left::

## Intro to MongoDB Course

Open MongoDB's home page in new browser window.

Click on resources

<div style="width: 70%; margin: auto;">

![](./images//MongoDB-Learning-Path-20240905152341334.png)

</div>

::right::

Click on Courses and Certification

<div style="width: 70%; margin: auto;">

![](./images//MongoDB-Learning-Path-20240905152357471.png)

</div>

You may also search for Introduction to MongoDB if you find that faster and easier.


---
level: 2
layout: two-cols
---

# Learning MongoDB: Intro Course

::left::

Click
on [Get Started](https://learn.mongodb.com/learning-paths/introduction-to-mongodb)

<div style="width: 70%; margin: auto;">

![](./images//MongoDB-Learning-Path-20240905152403207.png)

</div>

::right::

Once you have clicked the get started, you will be able to ...

Click on Register now

This will use the Atlas account to log you into the MongoDB University and thus allow your
progress to be tracked.


---
level: 1
layout: section
---

# Learning MongoDB: Schedule

---
level: 2
layout: default
---

# Learning MongoDB: Schedule

## Learning Timeline

The table on the following slide outlines the timeline for completion of the MongoDB
Learning & Practice.

Remember that we will expect the Mongo University content for each session to be at least 2/3
completed as part of your out-of-class activities.

You may find topics being covered in class that do not match this timeline.

You will also be expected to complete some learning during our non-contact week.

### Sections

There are 10 parts, or sections, to the learning:

- Parts 1 to 5 are the essential learning for the Unit <strong class="bg-red-600 p-1 pt-0 rounded ">(REQUIRED
  LEARNING)</strong>
- Parts 6 to 7 links MongoDB and Laravel <strong class="bg-amber-700 p-1 pt-0 rounded ">(SUPPLEMENTARY
  LEARNING)</strong>
- Parts 8 to 10 cover Real-World Applications & Projects <strong class="bg-cyan-800 p-1 pt-0 rounded ">(EXTENSION
  LEARNING, NOT COMPULSORY)</strong>

---
level: 2
layout: section
---

# Learning MongoDB: Introduction

## Section Contents <strong class="bg-red-600 p-1 pt-0 rounded ">(REQUIRED LEARNING)</strong>

- About MongoDB
- CRUD
- Indexes
- Search
- Aggregation
- Modelling
- Security

---
level: 2
layout: default
---

# Learning MongoDB: Schedule Part 1

<div style="font-size: 0.7rem; line-height: 0.8rem;">

The [Introduction to MongoDB Course](https://learn.mongodb.com/learning-paths/introduction-to-mongodb)
(https://learn.mongodb.com/learning-paths/introduction-to-mongodb) has 11 units.
These are indicated by 🌶️.

| Session | Chapter                                                                                                                    | Geeks for Geeks                                                                                                                                                                                                                                                                                                                     |
|---------|----------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| 09      | MongoDB Overview <br> https://learn.mongodb.com/courses/mongodb-overview (60 mins)                                         | What is a Database? <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#what-is-a-database <br><br> What is MongoDB? <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#what-is-mongodb <br><br> Why Choose MongoDB? <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#why-choose-mongodb |
| 09      | 🌶️ Intro to MongoDB <br> https://learn.mongodb.com/courses/start-here-introduction-to-mongodb (15 mins)                   | Day 1: Introduction to NoSQL and MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-1-introduction-to-nosql-and-mongodb                                                                                                                                                                                   |
| 09-10   | 🌶️ Getting Started with MongoDB Atlas <br> https://learn.mongodb.com/courses/getting-started-with-mongodb-atlas (60 mins) | Day 10: MongoDB Atlas <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-10-mongodb-atlas                                                                                                                                                                                                                         |

<p style="margin-top:0; background: rgba(128,255,128,0.25); padding:0.125rem 2rem; margin-top:0.5rem;border-radius: 0.25rem;">
Sessions 10-12 on next page
</p>

</div>

---
level: 2
layout: default
---

# Learning MongoDB: Schedule Part 2

<div style="font-size: 0.7rem; line-height: 0.8rem;">


The [Introduction to MongoDB Course](https://learn.mongodb.com/learning-paths/introduction-to-mongodb)
(https://learn.mongodb.com/learning-paths/introduction-to-mongodb) has 11 units.
These are <strong class="bg-blue-600 px-2 pb-1 pt-0 rounded">highlighted</strong> in the lists that follow.

| Session | Chapter                                                                                                                                                          | Geeks for Geeks                                                                                                                                                                                                                      |
|---------|------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| 10-11   | 🌶️ MongoDB and the Document Model <br> https://learn.mongodb.com/courses/overview-of-mongodb-and-the-document-model (75 mins)                                   | Day 2: MongoDB Basics <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-2-mongodb-basics <br><br> Day 3: MongoDB Data Types <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-3-mongodb-basics |
| 10-11   | 🌶️ Connecting to a MongoDB Database <br> https://learn.mongodb.com/courses/connecting-to-a-mongodb-database (60 mins)                                           | Day 2: MongoDB Basics <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-2-mongodb-basics                                                                                                                          |
| 11-12   | 🌶️ MongoDB CRUD Operations: Insert and Find Documents <br> https://learn.mongodb.com/courses/mongodb-crud-operations-insert-and-find-documents (105 mins)       | Day 4: MongoDB Query Language (MQL) <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-4-mongodb-query-language-mql                                                                                                |
| 11-12   | 🌶️ MongoDB CRUD Operations: Replace and Delete Documents <br> https://learn.mongodb.com/courses/mongodb-crud-operations-replace-and-delete-documents (105 mins) | Day 4: MongoDB Query Language (MQL) <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-4-mongodb-query-language-mql                                                                                                |

<p style="margin-top:0; background: rgba(128,255,128,0.25); padding:0.125rem 2rem; margin-top:0.5rem;border-radius: 0.25rem;">
Sessions 12-14 on next page
</p>

</div>


---
level: 2
layout: default
---

# Learning MongoDB: Schedule Part 3

<div style="font-size: 0.7rem; line-height: 0.8rem;">

The [Introduction to MongoDB Course](https://learn.mongodb.com/learning-paths/introduction-to-mongodb)
(https://learn.mongodb.com/learning-paths/introduction-to-mongodb) has 11 units.
These are <strong class="bg-blue-600 px-2 pb-1 pt-0 rounded">highlighted</strong> in the lists that follow.

| Session | Chapter                                                                                                                                               | Geeks for Geeks                                                                                                                       |
|---------|-------------------------------------------------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------|
| 12-13   | 🌶️ MongoDB CRUD Operations: Modifying Query Results <br> https://learn.mongodb.com/courses/mongodb-crud-operations-modifying-query-results (85 mins) | Day 4: MongoDB Query Language (MQL) <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-4-mongodb-query-language-mql |
| 12-13   | 🌶️ MongoDB Aggregation <br> https://learn.mongodb.com/courses/mongodb-aggregation (105 mins)                                                         | Day 6: Aggregation Framework <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-6-aggregation-framework             |
| 12-14   | 🌶️ MongoDB Indexes <br> https://learn.mongodb.com/courses/mongodb-indexes (105 mins)                                                                 | Day 5: Indexing in MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-5-indexing-in-mongodb                 |
| 12-14   | MongoDB Data Modelling Intro <br> https://learn.mongodb.com/courses/introduction-to-mongodb-data-modeling (45 mins)                                   | Day 8: Data Modeling in MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-8-data-modeling-in-mongodb       |
| 12-14   | 🌶️ MongoDB Atlas Search <br> https://learn.mongodb.com/courses/mongodb-atlas-search (90 mins)                                                        | Day 7: Advanced Aggregation <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-7-advanced-aggregation               |

<p style="margin-top:0; background: rgba(128,255,128,0.25); padding:0.125rem 2rem; margin-top:0.5rem;border-radius: 0.25rem;">
Sessions 13 - 15 on next page
</p>

</div>

---
level: 2
layout: default
---

# Learning MongoDB: Schedule Part 4

<div style="font-size: 0.7rem; line-height: 0.8rem;">

The [Introduction to MongoDB Course](https://learn.mongodb.com/learning-paths/introduction-to-mongodb)
(https://learn.mongodb.com/learning-paths/introduction-to-mongodb) has 11 units.
These are <strong class="bg-blue-600 px-2 pb-1 pt-0 rounded">highlighted</strong> in the lists that follow.

| Session | MongoDB Chapter/Link/Duration                                                                                        | Geeks for Geeks                                                                                                                                                                                                                                                | 
|---------|----------------------------------------------------------------------------------------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| 12-14   | 🌶️ MongoDB Transactions <br> https://learn.mongodb.com/courses/mongodb-transactions (60 mins)                       | Day 11: MongoDB Transactions <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-16-mongodb-transactions                                                                                                                                      |
| 14      | MongoDB and Data Encryption (Encryption at Rest) <br> https://learn.mongodb.com/courses/encryption-at-rest (45 mins) | Day 14: Security in MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-19-security-in-mongodb                                                                                                                                        |
| 14      | MongoDB and Network Security (Atlas) <br> https://learn.mongodb.com/courses/networking-security-atlas (45 mins)      | Day 14: Security in MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-19-security-in-mongodb                                                                                                                                        |
| 14      | MongoDB Data Resilience (Self-managed) <br> https://learn.mongodb.com/courses/data-resilience-self-managed (45 mins) | Day 12: Sharding in MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-17-sharding-in-mongodb <br><br> Day 13: Replication in MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-18-replication-in-mongodb |

<p style=" background: rgba(128,255,128,0.25); padding:0.125rem 2rem; margin-top: 0.5rem;border-radius: 0.25rem;">
Session 15 & Bonus content on next slides.
</p>

</div>


---
level: 2
layout: section
---

# Learning MongoDB: MongoDB & Laravel

## Section Contents <strong class="bg-amber-700 p-1 pt-0 rounded ">(SUPPLEMENTARY LEARNING)</strong>

- PHP MongoDB Extension
- Laravel MongoDB ODM
- Laravel & MongoDB Getting Started
- Laravel and MongoDB Transactions

---
level: 2
layout: default
---

# Learning MongoDB: Schedule Part 5

### Laravel & MongoDB

<div style="font-size: 0.7rem; line-height: 0.8rem;">

The [Introduction to MongoDB Course](https://learn.mongodb.com/learning-paths/introduction-to-mongodb)
(https://learn.mongodb.com/learning-paths/introduction-to-mongodb) has 11 units.
These are <strong class="bg-blue-600 px-2 pb-1 pt-0 rounded">highlighted</strong> in the lists that follow.

| Session                                                 | Chapter                                                                                                                            | Geeks for Geeks                                                                                                                                                               |
|---------------------------------------------------------|------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| <span class="bg-cyan-700 p-0.5 rounded">Optional</span> | PHP MongoDB Extension <br> https://www.php.net/manual/en/set.mongodb.php                                                           | Day 16: Integrating MongoDB with Programming Languages <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-16-integrating-mongodb-with-programming-languages |
| <span class="bg-cyan-700 p-0.5 rounded">Optional</span> | Laravel MongoDB ODM <br> https://github.com/mongodb/laravel-mongodb                                                                | Day 18: Application Development with MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-18-application-development-with-mongodb                     |
| <span class="bg-cyan-700 p-0.5 rounded">Optional</span> | Getting Started with Laravel and MongoDB <br> https://learn.mongodb.com/courses/getting-started-with-laravel-and-mongodb (20 mins) | Day 17: MongoDB Integration Basics <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-17-mongodb-integration-basics                                         |
| <span class="bg-cyan-700 p-0.5 rounded">Optional</span> | Laravel and MongoDB Transactions <br> https://learn.mongodb.com/courses/laravel-transactions (20 mins)                             | Day 19: Advanced MongoDB Applications <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-19-advanced-mongodb-applications                                   |

<p style="margin-top:0; background: rgba(128,255,128,0.25); padding:0.125rem 2rem; margin-top:0.5rem;border-radius: 0.25rem;">
Bonus / Extension & Real‑World Alignment is continued on next two slides.
</p>

</div>


---
level: 2
layout: section
---

# Learning MongoDB: Extended Learning, Real‑World Alignment & Projetcs

## Section Contents

- Data Resilience
- MongoDB Security
- Performance
- Data Modeling Patterns

<strong class="bg-cyan-800 p-1 pt-0 rounded ">(EXTENSION LEARNING, NOT COMPULSORY)</strong>

---
level: 2
layout: default
---

# Learning MongoDB: Schedule Part 6

### Bonus: Extension & Real‑World Alignment (Pt 1)

<div style="font-size: 0.7rem; line-height: 0.8rem;">

The [Introduction to MongoDB Course](https://learn.mongodb.com/learning-paths/introduction-to-mongodb)
(https://learn.mongodb.com/learning-paths/introduction-to-mongodb) has 11 units.
These are <strong class="bg-blue-600 px-2 pb-1 pt-0 rounded">highlighted</strong> in the lists that follow.

| Session                                                 | Chapter                                                                                                                       | Geeks for Geeks                                                                                                                                                                                                                                                |
|---------------------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| <span class="bg-cyan-700 p-0.5 rounded">Optional</span> | MongoDB Data Resilience (Self-managed) <br> https://learn.mongodb.com/courses/data-resilience-self-managed (45 mins)          | Day 12: Sharding in MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-17-sharding-in-mongodb <br><br> Day 13: Replication in MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-18-replication-in-mongodb |
| <span class="bg-cyan-700 p-0.5 rounded">Optional</span> | MongoDB and Network Security (Self-Managed) <br> https://learn.mongodb.com/courses/networking-security-self-managed (60 mins) | Day 14: Security in MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-19-security-in-mongodb                                                                                                                      |

<p style="margin-top:0; background: rgba(128,255,128,0.25); padding:0.125rem 2rem; margin-top:0.5rem;border-radius: 0.25rem;">
Bonus / Extension & Real‑World Alignment is continued on next two slides.
</p>

</div>


---
level: 2
layout: default
---

# Learning MongoDB: Schedule Part 7

### Bonus: Extension & Real‑World Alignment (Pt 2)

<div style="font-size: 0.7rem; line-height: 0.8rem;">

The [Introduction to MongoDB Course](https://learn.mongodb.com/learning-paths/introduction-to-mongodb)
(https://learn.mongodb.com/learning-paths/introduction-to-mongodb) has 11 units.
These are <strong class="bg-blue-600 px-2 pb-1 pt-0 rounded">highlighted</strong> in the lists that follow.

| Session                                                 | Chapter                                                                                                                       | Geeks for Geeks                                                                                                                                                                                                                              |
|---------------------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| <span class="bg-cyan-700 p-0.5 rounded">Optional</span> | MongoDB Performance Best Practices <br> https://learn.mongodb.com/courses/mongodb-performance (90 mins)                       | Day 15: Performance Tuning <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-20-performance-tuning                                                                                                                        |
| <span class="bg-cyan-700 p-0.5 rounded">Optional</span> | Data Modeling Patterns <br> https://learn.mongodb.com/courses/data-modeling-patterns (75 mins)                                | Use Cases of MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#use-cases-of-mongodb <br><br> Advantages of Using MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#advantages-of-using-mongodb |

<p style="margin-top:0; background: rgba(128,255,128,0.25); padding:0.125rem 2rem; margin-top:0.5rem;border-radius: 0.25rem;">
Real‑World Application Alignment on next slide.
</p>

</div>


---
level: 2
layout: section
---

# Learning MongoDB: Real‑World Application Alignment

## Section Contents

- Schema Design
- Scaling Applications
- MongoDB & Content Platforms
- Time Series Data & IoT Data
- Analytics and Aggregation
- MongoDB and Application Development Projects

<strong class="bg-cyan-900 p-1 pt-0 rounded ">(EXTENSION LEARNING, NOT COMPULSORY)</strong>

---
level: 2
layout: default
---

# Learning MongoDB: Schedule Part 8

### Real‑World Application Alignment - Part 1

<div style="font-size: 0.7rem; line-height: 0.8rem;">

The [Introduction to MongoDB Course](https://learn.mongodb.com/learning-paths/introduction-to-mongodb)
(https://learn.mongodb.com/learning-paths/introduction-to-mongodb) has 11 units.
These are <strong class="bg-blue-600 px-2 pb-1 pt-0 rounded">highlighted</strong> in the lists that follow.

| Session                                                 | Chapter                                                                                                        | Geeks for Geeks                                                                                                                       |
|---------------------------------------------------------|----------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------|
| <span class="bg-cyan-700 p-0.5 rounded">Optional</span> | Schema Design for Real‑World Apps <br> https://learn.mongodb.com/courses/schema-design-patterns (60 mins)      | Day 21: E‑commerce Applications <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-21-ecommerce-applications        |
| <span class="bg-cyan-700 p-0.5 rounded">Optional</span> | Scaling MongoDB Applications <br> https://learn.mongodb.com/courses/scaling-mongodb (60 mins)                  | Day 22: Social Media Applications <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-22-social-media-applications   |
| <span class="bg-cyan-700 p-0.5 rounded">Optional</span> | MongoDB for Content Platforms <br> https://learn.mongodb.com/courses/content-management-with-mongodb (45 mins) | Day 23: Content Management Systems <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-23-content-management-systems |

<p style="margin-top:0; background: rgba(128,255,128,0.25); padding:0.125rem 2rem; margin-top:0.5rem;border-radius: 0.25rem;">
Real‑World Application Alignment is continued on next slide.</p>

</div>


---
level: 2
layout: default
---

# Learning MongoDB: Schedule Part 9

### Real‑World Application Alignment - Part 2

<div style="font-size: 0.7rem; line-height: 0.8rem;">

The [Introduction to MongoDB Course](https://learn.mongodb.com/learning-paths/introduction-to-mongodb)
(https://learn.mongodb.com/learning-paths/introduction-to-mongodb) has 11 units.
These are <strong class="bg-blue-600 px-2 pb-1 pt-0 rounded">highlighted</strong> in the lists that follow.

| Session                                                 | Chapter                                                                                                 | Geeks for Geeks                                                                                                               |
|---------------------------------------------------------|---------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------|
| <span class="bg-cyan-700 p-0.5 rounded">Optional</span> | Time Series & IoT Data <br> https://learn.mongodb.com/courses/mongodb-time-series (45 mins)             | Day 24: IoT Applications <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-24-iot-applications             |
| <span class="bg-cyan-700 p-0.5 rounded">Optional</span> | Analytics & Aggregation Deep Dive <br> https://learn.mongodb.com/courses/advanced-aggregation (60 mins) | Day 25: Analytics Applications <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-25-analytics-applications |

<p style="margin-top:0; background: rgba(128,255,128,0.25); padding:0.125rem 2rem; margin-top:0.5rem;border-radius: 0.25rem;">
Geeks-for-Geeks Project / Review on following slide.
</p>

</div>

---
level: 2
layout: default
---

# Learning MongoDB: Schedule Part 10

### GfG Project / Review

<div style="font-size: 0.7rem; line-height: 0.8rem;">

| Session                                                 | Chapter                                                                                                                        | Geeks for Geeks                                                                                                                               |
|---------------------------------------------------------|--------------------------------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------|
| <span class="bg-cyan-700 p-0.5 rounded">Optional</span> | MongoDB Application Development Project <br> https://learn.mongodb.com/courses/application-development-with-mongodb (120 mins) | Day 26: Final Project Setup <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-26-final-project-setup                       |
| <span class="bg-cyan-700 p-0.5 rounded">Optional</span> | Full‑Stack MongoDB Project <br> https://learn.mongodb.com/courses/building-full-stack-apps (120 mins)                          | Days 27–28: Project Development <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#days-2728-project-development                |
| <span class="bg-cyan-700 p-0.5 rounded">Optional</span> | Testing & Debugging MongoDB Apps <br> https://learn.mongodb.com/courses/testing-mongodb-applications (60 mins)                 | Day 29: Testing and Debugging <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-29-testing-and-debugging                   |
| <span class="bg-cyan-700 p-0.5 rounded">Optional</span> | Deploying MongoDB Applications <br> https://learn.mongodb.com/courses/deploying-mongodb-atlas (60 mins)                        | Day 30: Project Review with Deployment <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-30-project-review-with-deployment |

</div>



---
layout: section
---

# Recap 🧢

---
level: 2
---

# Recap 🧢

Before leaving, ensure you:

- [ ] Have set up a free MongoDB account
- [ ] Logged into the Atlas account and are able to navigate
- [ ] Signed up for the Introduction to MongoDB course
- [ ] Have started the online course

---
level: 2
layout: two-cols
---

# Recap: Progress Monitoring 🧢

Use this as a checklist of what you have completed (🌶️ = Unit from Introduction to MongoDB Course):

::left::

- [ ] MongoDB Overview
- [ ] Intro to MongoDB 🌶️
- [ ] Getting Started with MongoDB Atlas 🌶️
- [ ] MongoDB and the Document Model 🌶️
- [ ] Connecting to a MongoDB Database 🌶️
- [ ] MongoDB CRUD Operations: <br> &nbsp; &nbsp; &nbsp; Insert and Find Documents 🌶️
- [ ] MongoDB CRUD Operations: <br> &nbsp; &nbsp; &nbsp; Replace and Delete Documents 🌶️

::right::

- [ ] MongoDB CRUD Operations: <br> &nbsp; &nbsp; &nbsp; Modifying Query Results ️🌶️
- [ ] MongoDB Aggregation ️🌶️
- [ ] MongoDB Indexes ️🌶️
- [ ] MongoDB Atlas Search ️🌶️
- [ ] MongoDB Data Modelling Intro
- [ ] MongoDB Transactions 🌶️
- [ ] MongoDB and Data Encryption <br> &nbsp; &nbsp; &nbsp; (Encryption at Rest)
- [ ] MongoDB and Network Security (Atlas)

---
layout: section
---

# Acknowledgements and References

---
level: 2
---

# Acknowledgements and References

MongoDB. (2026). MongoDB Courses and Trainings | MongoDB Shell Cheatsheet | MongoDB University.
Mongodb.com. https://learn.mongodb.com/learn/course/mongodb-shell-cheatsheet/

MongoDB. (2025). MongoDB Courses and Trainings | Relational to Document Model | MongoDB
University. Mongodb.com. https://learn.mongodb.com/courses/relational-to-document-model

MongoDB. (n.d.). MongoDB Courses and Trainings | Introduction to MongoDB | MongoDB University.
Learn.mongodb.com. https://learn.mongodb.com/learning-paths/introduction-to-mongodb


> Some content may have been generated with the assistance of Microsoft CoPilot
