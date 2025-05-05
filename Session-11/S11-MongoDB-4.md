---
banner: "![[Black-Red-Banner.svg]]"
created: 2024-07-31T07:52
updated: 2025-04-28T16:00
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
header: ICT50220 - Adv Prog - SaaS 2 - BED
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

Also, we will be conducting demonstrations of the first portfolio item.

Refer to the notes in [Session 10, MongoDB-Learning-Path](../Session-09/S09-MongoDB-Learning-Path.md) for details on
signing up for MongoDB University and the Course(s) that are to be undertaken for free.

You should also complete the [S11 Reflection Exercises](S11-Reflection-Exercises-20250101.md).

## MongoDB Tutorial: A Quick Dive with Practical Examples

In this tutorial, we'll walk through a variety of MongoDB commands and concepts that will help you understand how to
manage and query MongoDB databases. We will use MongoDB's NoSQL features, including aggregation, queries, and how to
work with MongoDB Atlas.

### What is NoSQL?

We have already seen in a previous session that NoSQL stands for Not Only SQL, and it refers to a family of databases
that are designed to store large amounts of unstructured or semi-structured data. Unlike traditional relational
databases, NoSQL databases do not rely on a fixed schema or tables. They are flexible and scalable, making them a good
choice for big data, real-time applications, and handling complex data relationships.

### MongoDB

MongoDB is a document-oriented NoSQL database, which stores data in JSON-like documents that can have flexible schemas.

MongoDB Atlas is MongoDB’s cloud service, offering a fully-managed database platform. It simplifies the management of
your MongoDB instances, with automatic backups, scaling, monitoring, and easy integration with other cloud services.

### Connecting to MongoDB

To use a MongoDB server, you must connect to them using the CLI or a GUI tool.

In both cases, you will need a "Connection String".

You are familiar with these from PHP, and other languages that connect to MariaDB/MySQL/etc RDBMS.

#### MongoDB Connection Strings

A connection string is used to connect to a MongoDB instance and provides details like authentication, host, and
database name.

Parts of a MongoDB Connection String: `mongodb://<username>:<password>@<host>:<port>/<database>?<options>`

Example: `mongodb://username:password@localhost:27017/myDatabase`

In this example:

- username and password: Credentials for authentication.
- localhost: The server host where MongoDB is running.
- 27017: The default port for MongoDB.
- myDatabase: The name of the database you want to interact with.

### MongoDB Atlas: Cloud-Based MongoDB

MongoDB Atlas is a cloud service that handles the operational overhead of running MongoDB databases, including backups,
scaling, and high availability.

### Why Use MongoDB Atlas?

- Fully managed: No need to worry about infrastructure, updates, or backups.
- Scalable: Automatically scale your database depending on traffic needs.
- Secure: Includes built-in security features like encryption, IP whitelisting, and access control.

You can connect to MongoDB Atlas by using the following connection string:

`mongodb+srv://<username>:<password>@cluster0.mongodb.net/myDatabase?retryWrites=true&w=majority`

### The MongoDB Shell and Connection Strings

There are two primary ways to connect to a MongoDB instance:

#### 1. Connecting Locally (CLI)

If you have a local installation of MongoDB, you can connect to it using the mongo CLI command.

```shell
mongosh
```

or you may use a more precise command:

```shell
mongosh mongodb://localhost:2717
```

This will connect to the default instance running on localhost at port 27017. It also does not include the user and
password. This is common for local servers that are not secured.

#### 2. Connecting to MongoDB Atlas (Cloud)

MongoDB Atlas requires a MongoDB connection string to connect to your cloud-hosted database. The connection string will
look like this:

```shell
mongosh "mongodb+srv://<your-cluster>.mongodb.net/myFirstDatabase" --username <username>
```

Make sure to replace <your-cluster>, <username>, and other parameters with your actual Atlas cluster details.

### MongoDB Commands

#### Connecting to MongoDB Atlas

To connect to MongoDB Atlas, use the following command in the terminal, replacing with your credentials:

```shell
mongo "mongodb+srv://cluster0.mongodb.net" --username <your-username>
```

Once connected, you'll be able to perform operations on your Atlas cluster.

#### Select a Database

To work with a specific database in MongoDB, use the use command.

```js
use
myDatabase
```

#### Show All Records

To display all records from a collection, use the find command.

```js
db.users.find()
```

#### Show Users with Specific Family Name

Use the find method with a query filter to retrieve users with a specific family name:

```js
db.users.find({family_name: "Jones"})
```

#### Count Jokes

To count the total number of documents in a collection, use the countDocuments method:

```js
db.jokes.countDocuments()
```

#### Find Jokes by Category

You can query for jokes by their category (e.g., "Pun", "Dad", "Lightbulb"):

```js
db.jokes.find({categories: "Dad"})
```

#### Find Jokes in a Date Range

If you want to find jokes added between two dates, you can use the $gte (greater than or equal) and $lte (less than or
equal) operators.

```js
db.jokes.find({
    created_at: {
        $gte: ISODate("2023-03-01T00:00:00Z"),
        $lte: ISODate("2024-09-30T23:59:59Z")
    }
})
```

#### Find Jokes without Category

To find jokes that don't have a category, use the $exists operator.

```js
db.jokes.find({categories: {$exists: false}})
```

#### Find Jokes by User

To find all jokes by a specific user (e.g., Eileen Dover), you can first get the user_id by querying the users
collection, and then use it in the jokes collection:

```js

const userId = db.users.findOne({given_name: "Eileen", family_name: "Dover"})._id;
db.jokes.find({user_id: userId})
```

### Aggregation: Show All Users and Their Jokes

MongoDB’s aggregation framework is a powerful tool for combining, filtering, and transforming data from multiple
collections. Let's see how to use it to display all users along with the jokes they posted.

#### Aggregation Pipeline Example:

```js

db.users.aggregate([
    {
        $lookup: {
            from: "jokes",           // The collection to join
            localField: "_id",       // The field in the `users` collection
            foreignField: "user_id", // The field in the `jokes` collection
            as: "user_jokes"         // Name of the new field that will store the jokes
        }
    },
    {
        $project: {
            given_name: 1,
            family_name: 1,
            jokes: "$user_jokes.joke" // Include only the joke text
        }
    }
])
```

This query will return users and their associated jokes, where each document contains the user's first name, last name,
and a list of jokes they've posted.


# END

Next up - [LINK TEXT](#)
