---
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
header: ICT50220 - Adv Prog - SaaS 2 - BED
banner: "![[Black-Red-Banner.svg]]"
banner_x: 1
banner_y: "0"
auto-scaling: true
size: 1920x1080
color: "#ccc"
backgroundColor: "#060606"
tags:
  - SaaS
  - APIs
  - Back-End
  - Overview
  - MongoDB
  - NoSQL
created: 2024-07-31T07:52
updated: 2025-02-10T15:16
---

# NoSQL 4

## Software as a Service - Back-End Development

### Diploma of Information Technology (Advanced Programming)  

### Diploma of Information Technology (Back-End Development)

### Session 11

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


# Session 11

During this session you will continue with the MongoDB Learning Path.

Also we will be conducting demonstrations of the first portfolio item.

Refer to the notes in [MongoDB-Learning-Path](../Session-09/S09-MongoDB-Learning-Path) for details on signing up for MongoDB University and the Course(s) that are to be undertaken for free.

# MongoDB University Target Lessons

Your target lessons for this session (also listed are the 'non-contact week' lessons) are:

| Session          | Chapter                                          | Link                                                                              | Duration (Mins) |
| ---------------- | ------------------------------------------------ | --------------------------------------------------------------------------------- | --------------- |
| Non Contact Week | MongoDB CRUD Operations: Modifying Query Results | https://learn.mongodb.com/courses/mongodb-crud-operations-modifying-query-results | 85              |
| Non Contact Week | MongoDB Aggregation                              | https://learn.mongodb.com/courses/mongodb-aggregation                             | 105             |
| 11               | MongoDB Indexes                                  | https://learn.mongodb.com/courses/mongodb-indexes                                 | 105             |
| 11               | MongoDB Atlas Search                             | https://learn.mongodb.com/courses/mongodb-atlas-search                            | 90              |


## Review Questions

MongoDB is a NoSQL database system

What is the Cloud based version of MongoDB called?

What is the name of the CLI tool to interact with a MongoDB system?

What is a connection string?

What are the parts of a MongoDB connection string?

There are two ways to start a MongoDB connection string, what are they and what is the difference?

## MongoDB Commands

What is the CLI command to connect to an Atlas Cloud instance of MongoDB?

Give an example of a complete MongoDB connection string including authentication.

Presume you have opened a MongoDB CLI connection and want to interact with a database named 'example' that has three collections, 'users', 'jokes' and 'ratings'.

| **<span style="color:#4f81bd">Collection</span>** | **<span style="color:#4f81bd">Field</span>** | **<span style="color:#4f81bd">Collection</span>** | **<span style="color:#4f81bd">Field</span>** | **<span style="color:#4f81bd">Collection</span>** | **<span style="color:#4f81bd">Field</span>** |
| ------------------------------------------------- | -------------------------------------------- | ------------------------------------------------- | -------------------------------------------- | ------------------------------------------------- | -------------------------------------------- |
| _**users**_                                       | _id                                          | _**jokes**_                                       | _id                                          | _**ratings**_                                     | _id                                          |
| -                                                 | given_name                                   | -                                                 | joke                                         | -                                                 | name                                         |
| -                                                 | family_name                                  | -                                                 | rating_id                                    | -                                                 | short_code                                   |
| -                                                 | email                                        | -                                                 | categories ['category', ...]                 | -                                                 | age_range {min_age: 00, max_age:00}          |
| -                                                 | password                                     | -                                                 | user_id                                      | -                                                 | description                                  |
| -                                                 | created_at                                   | -                                                 | created_at                                   | -                                                 | icon                                         |
| -                                                 | updated_at                                   | -                                                 | updated_at                                   | -                                                 | created_at                                   |
| -                                                 | deleted_at                                   | -                                                 | deleted_at                                   | -                                                 | updated_at                                   |

How to you select the database to interact with in the MongoDB CLI?

How do you show all the records in a collection called 'users'?

How do you show the users with the Family Name 'Jones'?

How do you show the ratings suitable for under 18's?

How do you list the jokes with a category of 'dad'?

How do you list all the jokes added between 1st March, 2023 and 30th September 2024?

How do you count the number of jokes?

How do you find all the jokes without a category?

How do you find all the jokes that are marked as deleted and owned by 'Eileen Dover'?

How do you find all the jokes with a category of 'pun', 'knock-knock', or 'librarian'?

How do you find the jokes with both 'Irish' and 'Scots'?

# END

Next up - [LINK TEXT](#)
