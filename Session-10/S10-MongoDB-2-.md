---
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
header: "![NMTAFE](../images/Black-Red-Banner.svg)"
auto-scaling: true
size: 4k
color: "#ccc"
backgroundColor: "#060606"
tags:
  - SaaS
  - APIs
  - Back-End
date created: 03 July 2024
date modified: 10 July 2024
created: 2024-09-12T09:59
updated: 2024-09-12T16:33
---

# NoSQL 1

## Software as a Service - Back-End Development

### Diploma of Information Technology (Advanced Programming)  

### Diploma of Information Technology (Back-End Development)

### Session 09

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


# Terms

**URI:**
- Uniform Resource Indicator
- The generalised version of URL

**URL:**
- Uniform Resource Locator


# Connecting to MongoDB

Running the MongoDB shell command:

```shell
 mongosh
```

Connects to MongoDB on same system

Defaults:
- Port 27017 for communication (TCP/IP)
- Local installation defaults to no security (ie. no username & password)
- `test` database

## MongoSH CLI Options

**Command Line Help**
- `mongosh --help`

**Local server on default port (27017):**
-  `mongosh mongodb://127.0.0.1`
- The server will default to the test database

**Server address and database:**
- `mongosh mongodb://192.168.0.5/exercises`

**Server address, port and database specified:**
- `mongosh mongodb://192.168.0.5:9876/ships`

**Specify user:**
- `mongosh –u USERNAME`

**Specify user and password:**
- `mongosh –u USERNAME –P PASSWORD`

**Note:**
- We are using local MongoDB
- No username and/or password required
- When using username/password, then `-P` has a capital letter ‘p’

**Generalised MongoDB URI:**
- `mongodb://username:password@host:port1/defaultdb`
- `mongodb+srv://username:password@hostname:port1/defaultdb`

| URI Component  | Meaning                                                 | Notes    |
| -------------- | ------------------------------------------------------- | -------- |
| mongodb://     | Designates this URI as a MongoDB connection             |          |
| mongodb+srv:// | As above, plus requires a DNS SRV record for the server |          |
| username       | The MongoDB Username to access the database             | Optional |
| password       | The password associated with the MongoDB user           | Optional |
| host           | The host name or IP address                             |          |
| port           | The host port to use to communicate with the server     | Optional |
| defaultdb      | The default database to access                          | Optional |

## MongoDB shell

- Shell is JavaScript based
- Normal JS commands will work

### Example:

```js
let doc = {  
        'given': 'Fred',  
        'family': 'Bloggs'  
}
```


# MongoDB Databases & Collections

## Listing Databases

```js
show dbs
```

## Show Current Database

```js
db.getName()
```

## Creating (and opening) a Database
```js
use DATABASE_NAME
``` 

Example:

```js
use Dummy_22S1_AG
```

**NOTE:**
- If the database does not exist it will be created

## Dropping a database

- Dangerous
- No way back except from backup

Two steps:

```js
use DATABASE_NAME
db.dropDatabase()
```

## Collections

MongoDB equivalent to Tables

Created either when:
- Using `createCollection` command, or
- Inserting a document into a non-existent collection

## Listing Collections

```js
show collections
```

## Creating Collections

```js
db.createCollection('COLLECTION’)
db.COLLECTION.insertOne({‘title’: ‘Shrek 2’})
```

## Deleting Collections

```js
db.COLLECTION.drop()
```


# MongoDB Document Operations

Create a 'JSON document':

```js
doc = {  
        "title": "Tacos",  
        "desc": "Yummie Tacos",  
        "cook_time": 20  
      }  

```

Insert the document:

```js
db.tacos.insertOne(doc)
```

The insert:

```js
db.tacos.insertOne(doc)
```

or

```js
db.tacos.insert(doc)
```

 Gives a response similar to:
 
 ```json
{  
  acknowledged: true,  insertedId: ObjectId("61e263e2ba00694eca9d0206")  
} 
```

You may pretty print using:

```js
db.tacos.find().pretty()
```

which will give an output similar to:
```json
[
  {
    _id: ObjectId("61e263e2ba00694eca9d0206"),
    title: 'Tacos',
    desc: 'Yummie Tacos',
    cook_time: 20
  }
]

```
What are the parts of this response?

_id: ObjectId("61e263e2ba00694eca9d0206"),

- 

- _id:

- Automatically generated

- Unique

- Contains encoded insertion date-time

- Recommend using these over user generated IDs


- 'doc' variable:

- Optional step

- 

- May insert a document in one step:

- db.tacos.insertOne({  
    'title': 'Sweet Taco',  
    'desc': 'Mango and Lime taco',  
    'cook_time': 25  
 })


- Inserting Many Documents

- db.tacos.insertMany(…)

- 

- Example, inserting two documents:

- db.examples.insertMany([  
  { 'name': 'Donald Duck' },  
  { 'name': 'Hewie Duck' }  
])



# Collections and Queries

- Earlier we saw an insert similar to this:

- db.examples.insertMany([  
  { "name" : "Donald", "year": 1934, "animal": "duck"},  
  { "name" : "Huey",   "year": 1937, "animal": "duck"},  
  { "name" : "Mickey", "year": 1928, "animal": "mouse"},  
  { "name" : "Goofy",  "year": 1928, "animal": "dog"},  
  { "name" : "Dewie",  "year": 1937, "animal": "duck"},  
  { "name" : "Louie",  "year": 1937, "animal": "duck"},  
  { "name" : "Minie",  "year": 1928, "animal": "mouse"},  
  { "name" : "Mickey",  "year": 1980, "animal": "robot"}  
])


- The insert many on the previous slide gave the following  sample 'response':

- {  
  acknowledged: true,  insertedIds: {  
    '0': ObjectId("61e50026a679679e18956e00"),  
    '1': ObjectId("61e50026a679679e18956e01"),  
    '2': ObjectId("61e50026a679679e18956e02"),  
    '3': ObjectId("61e50026a679679e18956e03"),  
    '4': ObjectId("61e50026a679679e18956e04"),  
    '5': ObjectId("61e50026a679679e18956e05"),  
    '6': ObjectId("61e50026a679679e18956e06"),  
    '7': ObjectId("61e50026a679679e18956e07")  
}

- We will use this data for some of our samples

- Listing All Documents

- db.COLLECTION.find()

- db.COLLECTION.find({})

- 

- 

- Example:

- db.tacos.find()

- Lists all the documents in the tacos collection

- 

- Finding One Document

- 

- db.tacos.find({  
    '_id': ObjectID('61e50026a679679e18956e04')  
})

- 

- The _id will always be unique


- Finding Documents…

- 

- db.COLLECTION.find({'key': 'text'})

- Matching 'key' to 'text'

- 
- Find all the tacos with title Tacos

- 

- In SQL:

- SELECT * FROM tacos  
  WHERE title='Tacos';

- 

- In MongoDB (NoSQL):

- db.tacos.find({'title': 'Tacos'})

- 

- Example:

db.examples.find(  
  {'name': 'Mickey’}  
)

Results:

[  
  {  
    _id: ObjectId("61e50026a679679e18956e02"),  
    name: 'Mickey',  
    year: 1928,  
    animal: 'mouse'  
  },  
  {  
    _id: ObjectId("61e50026a679679e18956e07"),  
    name: 'Mickey',  
    year: 1980,  
    animal: 'robot'  
  }  
]

- 

- Example 1:

- db.examples.find({'name': 'mickey'})

- Example 2:

- db.examples.find({'Name': 'Mickey'})

- 

- Both of the above returned nothing… Why?


- Finding Documents…

- 

- db.COLLECTION.find(  
    {'key': 'text'}  
).pretty()

- Show the results 'pretty printed'


- Showing selected Keys

- db.COLLECTION.find(  
    {'key': 'text’}, {'key': 1, …}  
)

- 

- Example:

- db.examples.find(  
    {}, {'year': 1, 'name': 1}  
)

- Hiding selected Keys

- db.COLLECTION.find(  
    {'key': 'text’}, {'key': 0, …}  
)

- 

- Example:

- db.examples.find(  
    {}, {'name': 0, 'year': 0}  
)

- Finding Documents…

- db.COLLECTION.find({'key': 'text', 'key': 'text' …})

- Adding more Key-Value pairs gives an AND

- 
Example:

db.examples.find({  
  'name': 'Mickey’,  
  'animal': 'robot’  
})

Results:

[  
  {  
    _id: ObjectId("61e50026a679679e18956e07"),  
    name: 'Mickey',  
    year: 1980,  
    animal: 'robot'  
  }  
]


- Find matches to one value or another:

- db.COLLECTION.find({  
    $or: [ {'key': 'value'},  
           {'key': 'value'} ]  
})

- Example:

- db.examples.find({  
  $or: [ {"animal": 'robot'},  
         {"animal": "duck"} ]  
})

- Greater than, Less than et al:

- db.COLLECTION.find({  
    'key': { $gt: 'value'}  
})

- Using RegEX

- db.COLLECTION.find({ ‘key’ : RegEx })

- 

- Examples:

- db.examples.find({ ‘name’: /y/ })

- db.examples.find({ ‘name’: /Mi/i })

- db.examples.find({ ‘name’: /[hdl]/I })

- db.examples.find({ ‘name’ : /e[y]/i })

- 

- 

| Option | Symbol | db.COLLECTION.find( … )           | Example                                                          |
| ------ | ------ | --------------------------------- | ---------------------------------------------------------------- |
| >      | $gt    | { 'key': { $gt : value } }        | db.examples.find({ 'year': { $gt : 1930 } })                     |
| >=     | $gte   | { 'key': { $gte: value } }        | db.examples.find({ 'year': { $gte : 1980 } })                    |
| <      | $lt    | { 'key': { $lt : value } }        | db.examples.find({ 'year': { $lt : 1930 } })                     |
| <=     | $lte   | { 'key': { $lte : value } }       | db.examples.find({ 'year': { $lte : 1940 } })                    |
| !=     | $ne    | { 'key': { $ne : value } }        | db.examples.find({ 'year': { $ne : 1937 } })                     |
| in     | $in    | { 'key': { $in : [ value, … ] } } | db.examples.find({ 'year': { $in : [1950, 1960, 1970, 1980] } }) |
| all    | $all   | { 'key': { $gt : value } }        | db.examples.find({ 'year': { $all : [ 1980, "Mickey"] } })       |






# Exercises

Refer to the notes in  [MongoDB-Learning-Path](../Session-09/MongoDB-Learning-Path.md) for details on signing upo for MongoDB University and the Course(s) that are to be undertaken for free.


# END

Next up - [LINK TEXT](#)
