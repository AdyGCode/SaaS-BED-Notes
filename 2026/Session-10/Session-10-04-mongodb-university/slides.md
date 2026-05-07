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

::left::
By the end of this session, you will be able to:

-

::right::
You will demonstrate learning by:

-

---
level: 2
---

# Contents

<Toc minDepth="1" maxDepth="1" columns="2" />


---
layout: section
---

# Learning MongoDB

### The life and times of going to MongoDB University

#### The following sections indicate:

- What is needed to be covered in your learning
    - Links for the MongoDB content and Geeks-for-Geeks content
- How to sign up to MongoDB's University

---
level: 1
layout: section
---

# Learning MongoDB - Schedule

---
level: 2
layout: default
---

# Learning MongoDB - Schedule

## Learning Timeline

The table on the following slide outlines the timeline for completion of the MongoDB
Learning & Practice.

Remember that we will expect the Mongo University content for each session to be at least 2/3
completed as part of your out-of-class activities.

You may find topics being covered in class that do not match this timeline.

You will also be expected to complete some learning during our non-contact week.

There are 4 parts to the learning.

---
level: 2
layout: default
---

# Learning MongoDB - Schedule Part 1

<div style="font-size: 0.8rem; line-height: 1rem;">

| Session | Chapter                                                                                                                | Geeks for Geeks                                                                                                                                                                                                                                                                                                                     |
|---------|------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| 09      | MongoDB Overview <br> https://learn.mongodb.com/courses/mongodb-overview (60 mins)                                     | What is a Database? <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#what-is-a-database <br><br> What is MongoDB? <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#what-is-mongodb <br><br> Why Choose MongoDB? <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#why-choose-mongodb |
| 09      | Intro to MongoDB <br> https://learn.mongodb.com/courses/start-here-introduction-to-mongodb (15 mins)                   | Day 1: Introduction to NoSQL and MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-1-introduction-to-nosql-and-mongodb                                                                                                                                                                                   |
| 09-10   | Getting Started with MongoDB Atlas <br> https://learn.mongodb.com/courses/getting-started-with-mongodb-atlas (60 mins) | Day 10: MongoDB Atlas <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-10-mongodb-atlas                                                                                                                                                                                                                         |

<p style="margin-top:0; background: rgba(128,255,128,0.25); padding:0.125rem 2rem; margin-top:0.5rem;border-radius: 0.25rem;">
Sessions 10-12 on next page
</p>

</div>

---
level: 2
layout: default
---

# Learning MongoDB - Schedule Part 2

<div style="font-size: 0.8rem; line-height: 1rem;">

| Session | Chapter                                                                                                                                                      | Geeks for Geeks                                                                                                                                                                                                                      |
|---------|--------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| 10-11   | MongoDB and the Document Model <br> https://learn.mongodb.com/courses/overview-of-mongodb-and-the-document-model (75 mins)                                   | Day 2: MongoDB Basics <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-2-mongodb-basics <br><br> Day 3: MongoDB Data Types <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-3-mongodb-basics |
| 10-11   | Connecting to a MongoDB Database <br> https://learn.mongodb.com/courses/connecting-to-a-mongodb-database (60 mins)                                           | Day 2: MongoDB Basics <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-2-mongodb-basics                                                                                                                          |
| 11-12   | MongoDB CRUD Operations: Insert and Find Documents <br> https://learn.mongodb.com/courses/mongodb-crud-operations-insert-and-find-documents (105 mins)       | Day 4: MongoDB Query Language (MQL) <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-4-mongodb-query-language-mql                                                                                                |
| 11-12   | MongoDB CRUD Operations: Replace and Delete Documents <br> https://learn.mongodb.com/courses/mongodb-crud-operations-replace-and-delete-documents (105 mins) | Day 4: MongoDB Query Language (MQL) <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-4-mongodb-query-language-mql                                                                                                |

<p style="margin-top:0; background: rgba(128,255,128,0.25); padding:0.125rem 2rem; margin-top:0.5rem;border-radius: 0.25rem;">
Sessions 12-14 on next page
</p>

</div>


---
level: 2
layout: default
---

# Learning MongoDB - Schedule Part 3

<div style="font-size: 0.8rem; line-height: 1rem;">

| Session | Chapter                                                                                                                                           | Geeks for Geeks                                                                                                                       |
|---------|---------------------------------------------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------|
| 12-13   | MongoDB CRUD Operations: Modifying Query Results <br> https://learn.mongodb.com/courses/mongodb-crud-operations-modifying-query-results (85 mins) | Day 4: MongoDB Query Language (MQL) <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-4-mongodb-query-language-mql |
| 12-13   | MongoDB Aggregation <br> https://learn.mongodb.com/courses/mongodb-aggregation (105 mins)                                                         | Day 6: Aggregation Framework <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-6-aggregation-framework             |
| 12-14   | MongoDB Indexes <br> https://learn.mongodb.com/courses/mongodb-indexes (105 mins)                                                                 | Day 5: Indexing in MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-5-indexing-in-mongodb                 |
| 12-14   | MongoDB Atlas Search <br> https://learn.mongodb.com/courses/mongodb-atlas-search (90 mins)                                                        | Day 7: Advanced Aggregation <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-7-advanced-aggregation               |

<p style="margin-top:0; background: rgba(128,255,128,0.25); padding:0.125rem 2rem; margin-top:0.5rem;border-radius: 0.25rem;">
Sessions 13 - 15 on next page
</p>

</div>

---
level: 2
layout: default
---

# Learning MongoDB - Schedule Part 4

<div style="font-size: 0.8rem; line-height: 1rem;">

| Session | MongoDB Chapter/Link/Duration                                                                                        | Geeks for Geeks                                                                                                                 | 
|---------|----------------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------|
| 13-14   | MongoDB Data Modelling Intro <br> https://learn.mongodb.com/courses/introduction-to-mongodb-data-modeling (45 mins)  | Day 8: Data Modeling in MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-8-data-modeling-in-mongodb |
| 13-14   | MongoDB Transactions <br> https://learn.mongodb.com/courses/mongodb-transactions (60 mins)                           | Day 11: MongoDB Transactions <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-16-mongodb-transactions       |
| 14      | MongoDB and Data Encryption (Encryption at Rest) <br> https://learn.mongodb.com/courses/encryption-at-rest (45 mins) | Day 14: Security in MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-19-security-in-mongodb         |
| 14      | MongoDB and Network Security (Atlas) <br> https://learn.mongodb.com/courses/networking-security-atlas (45 mins)      | Day 14: Security in MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-19-security-in-mongodb         |

<p style="margin-top:0; background: rgba(128,255,128,0.25); padding:0.125rem 2rem; margin-top:0.5rem;border-radius: 0.25rem;">
Session 15 & Bonus content on next slides.
</p>

</div>


---
level: 2
layout: default
---

# Learning MongoDB - Part 5

<div style="font-size: 0.8rem; line-height: 1rem;">

| Session | Chapter                                                                                                                            | Geeks for Geeks                                                                                                                                                               |
|---------|------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| 15      | PHP MongoDB Extension <br> https://www.php.net/manual/en/set.mongodb.php                                                           | Day 16: Integrating MongoDB with Programming Languages <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-16-integrating-mongodb-with-programming-languages |
| 15      | Laravel MongoDB ODM <br> https://github.com/mongodb/laravel-mongodb                                                                | Day 18: Application Development with MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-18-application-development-with-mongodb                     |
| 15      | Getting Started with Laravel and MongoDB <br> https://learn.mongodb.com/courses/getting-started-with-laravel-and-mongodb (20 mins) | Day 17: MongoDB Integration Basics <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-17-mongodb-integration-basics                                         |
| 15      | Laravel and MongoDB Transactions <br> https://learn.mongodb.com/courses/laravel-transactions (20 mins)                             | Day 19: Advanced MongoDB Applications <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-19-advanced-mongodb-applications                                   |

<p style="margin-top:0; background: rgba(128,255,128,0.25); padding:0.125rem 2rem; margin-top:0.5rem;border-radius: 0.25rem;">
Bonus / Extension & Real‑World Alignment on next two slides.
</p>

</div>


---
level: 2
layout: default
---

# Learning MongoDB – Bonus / Extension & Real‑World Alignment (Pt 1)

<div style="font-size: 0.8rem; line-height: 1rem;">

| Session | Chapter                                                                                                                       | Geeks for Geeks                                                                                                                                                                                                                                                |
|---------|-------------------------------------------------------------------------------------------------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| n/a     | MongoDB Data Resilience (Self-managed)      <br> https://learn.mongodb.com/courses/data-resilience-self-managed     (45 mins) |                                                                                                                                                                                                                                                                |
| n/a     | MongoDB and Network Security (Self-Managed) <br> https://learn.mongodb.com/courses/networking-security-self-managed (60 mins) |                                                                                                                                                                                                                                                                |
| n/a     | MongoDB Data Resilience (Self-managed) <br> https://learn.mongodb.com/courses/data-resilience-self-managed (45 mins)          | Day 12: Sharding in MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-17-sharding-in-mongodb <br><br> Day 13: Replication in MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-18-replication-in-mongodb |

<p style="margin-top:0; background: rgba(128,255,128,0.25); padding:0.125rem 2rem; margin-top:0.5rem;border-radius: 0.25rem;">
Real‑World Application Alignment on next slide.
</p>

</div>


---
level: 2
layout: default
---

# Learning MongoDB – Bonus / Extension & Real‑World Alignment (Pt 2)

<div style="font-size: 0.8rem; line-height: 1rem;">

| Session | Chapter                                                                                                                       | Geeks for Geeks                                                                                                                                                                                                                              |
|---------|-------------------------------------------------------------------------------------------------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| n/a     | MongoDB and Network Security (Self-Managed) <br> https://learn.mongodb.com/courses/networking-security-self-managed (60 mins) | Day 14: Security in MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-19-security-in-mongodb                                                                                                                      |
| n/a     | MongoDB Performance Best Practices <br> https://learn.mongodb.com/courses/mongodb-performance (90 mins)                       | Day 15: Performance Tuning <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-20-performance-tuning                                                                                                                        |
| n/a     | Data Modeling Patterns <br> https://learn.mongodb.com/courses/data-modeling-patterns (75 mins)                                | Use Cases of MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#use-cases-of-mongodb <br><br> Advantages of Using MongoDB <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#advantages-of-using-mongodb |

<p style="margin-top:0; background: rgba(128,255,128,0.25); padding:0.125rem 2rem; margin-top:0.5rem;border-radius: 0.25rem;">
Real‑World Application Alignment on next slide.
</p>

</div>


---
level: 2
layout: default
---

# Learning MongoDB – Real‑World Application Alignment

<div style="font-size: 0.8rem; line-height: 1rem;">

| Session | Chapter                                                                                                        | Geeks for Geeks                                                                                                                       |
|---------|----------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------|
| n/a     | Schema Design for Real‑World Apps <br> https://learn.mongodb.com/courses/schema-design-patterns (60 mins)      | Day 21: E‑commerce Applications <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-21-ecommerce-applications        |
| n/a     | Scaling MongoDB Applications <br> https://learn.mongodb.com/courses/scaling-mongodb (60 mins)                  | Day 22: Social Media Applications <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-22-social-media-applications   |
| n/a     | MongoDB for Content Platforms <br> https://learn.mongodb.com/courses/content-management-with-mongodb (45 mins) | Day 23: Content Management Systems <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-23-content-management-systems |
| n/a     | Time Series & IoT Data <br> https://learn.mongodb.com/courses/mongodb-time-series (45 mins)                    | Day 24: IoT Applications <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-24-iot-applications                     |
| n/a     | Analytics & Aggregation Deep Dive <br> https://learn.mongodb.com/courses/advanced-aggregation (60 mins)        | Day 25: Analytics Applications <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-25-analytics-applications         |

<p style="margin-top:0; background: rgba(128,255,128,0.25); padding:0.125rem 2rem; margin-top:0.5rem;border-radius: 0.25rem;">
Geeks-for-Geeks Project / Review on following slide.
</p>

</div>

---
level: 2
layout: default
---

# Learning MongoDB – GfG Project / Review

<div style="font-size: 0.8rem; line-height: 1rem;">

| Session | Chapter                                                                                                                        | Geeks for Geeks                                                                                                                               |
|---------|--------------------------------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------|
| n/a     | MongoDB Application Development Project <br> https://learn.mongodb.com/courses/application-development-with-mongodb (120 mins) | Day 26: Final Project Setup <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-26-final-project-setup                       |
| n/a     | Full‑Stack MongoDB Project <br> https://learn.mongodb.com/courses/building-full-stack-apps (120 mins)                          | Days 27–28: Project Development <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#days-2728-project-development                |
| n/a     | Testing & Debugging MongoDB Apps <br> https://learn.mongodb.com/courses/testing-mongodb-applications (60 mins)                 | Day 29: Testing and Debugging <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-29-testing-and-debugging                   |
| n/a     | Deploying MongoDB Applications <br> https://learn.mongodb.com/courses/deploying-mongodb-atlas (60 mins)                        | Day 30: Project Review with Deployment <br> https://www.geeksforgeeks.org/mongodb/30-days-of-mongo-db//#day-30-project-review-with-deployment |

</div>

---
layout: section
---

# Learning MongoDB - Signing Up

---
level: 2
layout: two-cols
---

# Learning MongoDB

## Going to University (MongoDB Style)

- Sign Up for Free MongoDB Atlas Account
- Complete the Introduction to MongoDB course

<br>

## Cheat Sheets

::left::

#### MongoDB Shell Cheat Sheet

[Original Download](https://learn.mongodb.com/learn/course/mongodb-shell-cheatsheet/main/mongodb-shell-cheatsheet)

[Copy in Repo 2026-04-17](public/MongoDBShellCheatSheet-FY26.pdf)

::right::

#### SQL to MongoDB Cheat Sheet

[Original download](https://learn.mongodb.com/learn/course/mongodb-sql-cheat-sheet/main/mongodb-sql-cheat-sheet)

[Copy in repo 2024-09-05](./public/SQLtoMongoDBCheatSheet1.pdf)


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
