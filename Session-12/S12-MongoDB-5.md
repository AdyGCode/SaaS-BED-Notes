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
date created: 03 July 2024
date modified: 08 July 2024
created: 2024-07-31T07:52
updated: 2024-11-25T09:20
---

# NoSQL 5

## Software as a Service - Back-End Development

### Diploma of Information Technology (Advanced Programming)  

### Diploma of Information Technology (Back-End Development)

### Session 12

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


# Session 12

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


## MongoDB Practice Exercises

Use either `mongodbsh`, MongoDB Atlas, or MongoDB Compass (or equivalent) to practice using MongoDB.

All exercises **MUST** be completed using the MongoDB Shell CLI **ONLY**.

### Setting Up

Create a Markdown document, with the following starter content:

```text
# Session 12 MongoDB Exercises

Answers by YOUR_NAME_HERE

---

```

Each time you answer a question, create a heading and title as shown here:

```text
## Question X - Title

Optionally summarise the question, or copy it to here.

### Solution

	```js
		db.collection_name.find();
	```
```

These are the same as the question titles in this document, but at a level 2 (##) not level 3 (###) markdown heading. 

The answer is contained in a code block, as shown above. Important is that code blocks actually start at the beginning of the line.

## Starter MongoDB Exercises

### Exercise 1 - Create Practice Films Database

Connect to a running mongo instance.

Create and use a database named `practice_films`.

### Exercise 2 - Insert One Movie

> In the Insert Exercises, we are separating each 'movie' with **TWO** blank lines.
> 
> Also, the presented data is **NOT** correct JSON, but is a starter point.

Create a collection called `movies` and insert the following SINGLE document:

```json
title : Fight Club
writer : Chuck Palahniuk
year : 1999
actors : [
  Brad Pitt
  Edward Norton
]
```

### Exercise 3 - Insert Many Movies

Using the movies collection, insert the following documents in ONE command:

```json
title : Fight Club
writer : Chuck Palahniuk
year : 1999
actors : [
  Brad Pitt
  Edward Norton
]


title : Pulp Fiction
writer : Quentin Tarantino
year : 1994
actors : [
  John Travolta
  Uma Thurman
]


title : Inglorious Basterds
writer : Quentin Tarantino
year : 2009
actors : [
  Brad Pitt
  Diane Kruger
  Eli Roth
]
```

### Exercise 4 - Insert Further Movies

Add these documents using either method the `movies` collection.

```json
title : Inglorious Basterds
writer : Quentin Tarantino
year : 2009
actors : [
  Brad Pitt
  Diane Kruger
  Eli Roth
]


title : The Hobbit: An Unexpected Journey
writer : J.R.R. Tolkein
year : 2012
franchise : The Hobbit


title : The Hobbit: The Desolation of Smaug
writer : J.R.R. Tolkein
year : 2013
franchise : The Hobbit


title : The Hobbit: The Battle of the Five Armies
writer : J.R.R. Tolkein
year : 2012
franchise : The Hobbit
synopsis : Bilbo and Company are forced to engage in a war against an array of combatants and keep the Lonely Mountain from falling into the hands of a rising darkness.


title : Pee Wee Herman's Big Adventure


title : Avatar
```

### Exercise 4 - Query / Find I

Use the movies collection and write the MongoDB query to:

- Get all documents

### Exercise 5 - Query / Find II

Use the movies collection and write the MongoDB query to:

- Get all documents with `writer` set to "Quentin Tarantino"

### Exercise 6 - Query / Find II

Use the movies collection and write the MongoDB query to:

- Get all documents where `actors` include "Brad Pitt"

### Exercise 7 - Query / Find III

Use the movies collection and write the MongoDB query to:

- Get all documents with `franchise` set to "The Hobbit"

### Exercise 8 - Query / Find IV

Use the movies collection and write the MongoDB query to:

- Get all movies released in the 90s

### Exercise 9 - Query / Find V

Use the movies collection and write the MongoDB query to:

- Get all movies released before the year 2000 or after 2010

### Exercise 10 - Update I

Use the movies collection and write the MongoDB query to:

- Add a synopsis to "The Hobbit: An Unexpected Journey"
	- "A reluctant hobbit, Bilbo Baggins, sets out to the Lonely Mountain with a spirited group of dwarves to reclaim their mountain home - and the gold within it - from the dragon Smaug."

### Exercise 11 - Update II

Use the movies collection and write the MongoDB query to:

- Add a synopsis to "The Hobbit: The Desolation of Smaug" 
	- "The dwarves, along with Bilbo Baggins and Gandalf the Grey, continue their quest to reclaim Erebor, their homeland, from Smaug. Bilbo Baggins is in possession of a mysterious and magical ring."

### Exercise 12 - Update III

Use the movies collection and write the MongoDB query to:

- add an actor named "Samuel L. Jackson" to the movie "Pulp Fiction"

### Exercise 13 - Text Search I

Use the movies collection and write the MongoDB query to:

- Get all movies with "**F**" in the title.

### Exercise 14 - Text Search II

Use the movies collection and write the MongoDB query to:

- Find all movies that have a synopsis that contains the word "**Bilbo**"

### Exercise 15 - Text Search III

Use the movies collection and write the MongoDB query to:

- Find all movies that have a synopsis that contains the word "**Gandalf**"

### Exercise 16 - Text Search IV

Use the movies collection and write the MongoDB query to:

- Find all movies that have a synopsis that contains the word "**Bilbo**" and not the word "**Gandalf**"

### Exercise 17 - Text Search V

Use the movies collection and write the MongoDB query to:

- Find all movies that have a synopsis that contains the word "**dwarves**" or "**hobbit**"

### Exercise 18 - Text Search VI

Use the movies collection and write the MongoDB query to:

- Find all movies that have a synopsis that contains the word "gold" and "dragon"

### Exercise 19 - Delete Documents I

Use the movies collection and write the MongoDB query to:

-  Delete the movie "Pee Wee Herman's Big Adventure"
### Exercise 20 - Delete Documents II

Use the movies collection and write the MongoDB query to:

-  Delete the movie "Avatar"


## Exercises: Relationships 


### Exercise 21 - Related Collections I

Create a collection called `users` and insert the following documents:

```json
username : Jeddi
given_name "Jedd"
middle_name : "I"
family_name : "Night"

username : MaxiM
given_name "Max"
middle_name : "E"
family_name : "Mize"

username : JoKerr
full_name : "Joe Kerr"
given_name "Joe"
family_name : "Kerr"

```

### Exercise 22 - Related Collections II

Create a collection called `posts` and insert the following documents:

```json
username : Jeddi
title : Passes out at party
body : Wakes up early and cleans house


username : Jeddi
title : Steals your identity
body : Raises your credit score


username : MaxiM
title : Reports a bug in your code
body : Sends you a Pull Request


username : JoKerr
title : Borrows something
body : Sells it


username : MaxiM
title : Borrows everything
body : The end


username : JoKerr
title : Forks your repo on github
body : Sets to private

		
username : JoKerr
title : Reverts the last commit
body : Sets to private

		
username : Jeddi
title : Invests in new technology
body : Makes $10,000,000 within 6 months
```


### Exercise 23 - Related Collections III

Create a collection called `comments` and insert the following documents:

#### Comment 1

```
username : Jeddi
comment : Hope you got a good deal!
post : [post_obj_id]
```

Where `[post_obj_id]` is the `ObjectId` of the `posts` document: "Borrows something".

#### Comment 2

```
username : Jeddi
comment : What's mine is yours!
post : [post_obj_id]
```

Where `[post_obj_id]` is the `ObjectId`  of the `posts` document: "Borrows everything"

#### Comment 3

```
username : Jeddi
comment : Don't violate the licensing agreement!
post : [post_obj_id]
```

Where `[post_obj_id]` is the `ObjectId`  of the `posts` document: "Forks your repo on github".

#### Comment 4

```
username : JoKerr
comment : It still isn't clean
post : [post_obj_id]
```

Where `[post_obj_id]` is the `ObjectId`  of the `posts` document: "Passes out at party".

#### Comment 5

```
username : JoKerr
comment : Denied your PR cause I found a hack
post : [post_obj_id]
```

Where `[post_obj_id]` is the `ObjectId`  of the `posts` document: "Reports a bug in your code".

### Exercise 24 - Query Related Collections I

Create a MongoDB query that:

-. find all users

### Exercise 25 - Query Related Collections II

Create a MongoDB query that:

- Finds all posts

### Exercise 26 - Query Related Collections III

Create a MongoDB query that:

- Finds all posts that was authored by "Jeddi"

### Exercise 27 - Query Related Collections IV

Create a MongoDB query that:

- Finds all posts that was authored by "JoKerr"

### Exercise 28 - Query Related Collections V

Create a MongoDB query that:

- Finds all comments

### Exercise 29 - Query Related Collections VI

Create a MongoDB query that:

- Finds all comments that was authored by "Jeddi"

### Exercise 30 - Query Related Collections VII

Create a MongoDB query that:

- Finds all comments that was authored by "JoKerr"

### Exercise 31 - Query Related Collections VIII

Create a MongoDB query that:

- Finds all comments belonging to the post "Reports a bug in your code"

### Exercise 32 - Other Related Collection Queries I

Create a MongoDB query that:

- Tells you how many movies are in the collection.


### Exercise 33 - Other Related Collection Queries II

Create a MongoDB query that:

- Tells you how many comments have been make by `JoKerr`.


### Exercise 34 - Other Related Collection Queries III

Create a MongoDB query that:

- Tells you how many posts have no comments.



# END

Next up - [S12 MongoDB 6 Practice Exercises](Session-12/S12-MongoDB-6.md)
