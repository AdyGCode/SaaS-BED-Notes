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
updated: 2024-11-25T09:27
---

# Session 11 Exercises & Journal Entry

## Software as a Service - Back-End Development

Session 11 In-class, Out-of-Class, and Assessment Activities 

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

# Session 11 Exercises & Journals 

---
## Journal Entry: Summarise the Session's Content

**For general details on Journal Content see Session 01.**

For this week's journal we would like you to do the following...

1. Summarise the learning and exercises from this session
2. Complete the exercises below and add to your Journal

Remember you MUST include references using MyBib APA6/APA7 format to any references used.

---
## Reflection Questions & Exercises

The following questions and exercises are to be used as revision... some may not be answered this session, but by the end of the following session the knowledge should be there to complete these.

Questions require code that would be run in the MongoDB CLI.

You are not given sample data, but you are provided with the following details to work from:

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

### General Questions

1. MongoDB is a NoSQL database system. What is NoSQL?
2. What is the Cloud based version of MongoDB called?
3. What is the name of the CLI tool to interact with a MongoDB system?
4. What is a connection string?
5. What are the parts of a MongoDB connection string?
6. There are two ways to start a MongoDB connection string, what are they and what is the difference?
7. Give an example of a complete MongoDB connection string including authentication.

### Questions Relating to MongoDB Commands

1. What is the CLI command to connect to an Atlas Cloud instance of MongoDB?
2. How to you select the database to interact with in the MongoDB CLI?
3. How do you show all the records in a collection called 'users'?
4. How do you show the users with the Family Name 'Jones'?
5. How do you show the ratings suitable for under 18's?
6. How do you list the jokes with a category of 'dad'?
7. How do you list all the jokes added between 1st March, 2023 and 30th September 2024?
8. How do you count the number of jokes?
9. How do you find all the jokes without a category?
10. How do you find all the jokes that are marked as deleted and owned by 'Eileen Dover'?
11. How do you find all the jokes with a category of 'pun', 'knock-knock', or 'librarian'?
12. How do you find the jokes with both 'Irish' and 'Scots'?

## Work on the Portfolio

N/A

## Tutorial

Complete the MongoDB University course content as outlined in [MongoDB-Learning-Path](../Session-09/S09-MongoDB-Learning-Path).


| Session          | Chapter                                               | Link                                                                                   | Duration (Mins) |
| ---------------- | ----------------------------------------------------- | -------------------------------------------------------------------------------------- | --------------- |
| Non Contact Week | MongoDB CRUD Operations: Modifying Query Results      | https://learn.mongodb.com/courses/mongodb-crud-operations-modifying-query-results      | 85              |
| Non Contact Week | MongoDB Aggregation                                   | https://learn.mongodb.com/courses/mongodb-aggregation                                  | 105             |
| 11               | MongoDB Indexes                                       | https://learn.mongodb.com/courses/mongodb-indexes                                      | 105             |
| 11               | MongoDB Atlas Search                                  | https://learn.mongodb.com/courses/mongodb-atlas-search                                 | 90              |
| 12               | MongoDB Data Modeling Intro                           | https://learn.mongodb.com/courses/introduction-to-mongodb-data-modeling                | 45              |
| 12               | MongoDB Transactions                                  | https://learn.mongodb.com/courses/mongodb-transactions                                 | 60              |





---
# Found a Problem?
 
If you spotted any problems (including missing details) in notes or other materials, then make sure you note that, and as a big help to your lecturer, you could fork the notes repository, create an issue, create a fix to the issue, and submit a pull request.



---

# END
