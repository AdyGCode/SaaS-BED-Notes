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
  - Back-End
  - MongoDB
  - NoSQL
date created: 03 July 2024
date modified: 10 July 2024
created: 2024-09-12T09:59
updated: 2025-03-18T10:31
---

# NoSQL 1

## Software as a Service - Back-End Development

#### ICT50120 Diploma of Information Technology (Advanced Programming)  

#### ICT50120 Diploma of Information Technology (Back-End Development)

##### Session 09

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


# SQL, NoSQL and NewSQL  
  
## Wave 1  
 - Flat File based
 - Hierarchical
 - Network  
 
## Wave 2  
- SQL Based
- Relational  
  
## Wave 3  
- NoSQL
- Document
- Graph
- Column
- Key-Value  
  
## Wave 4  
- NewSQL
- Blending SQL and NoSQL

<div class="page-break" style="page-break-before: always;"></div>


# SQL 

- Relational Databases  
- Tables with relationships  
- Very Structural  
- Key concepts such as ACID  
- Consistency is the greatest good

### SQL Databases
- Firebird DB
- MariaDB
- MySQL
- SQL Server
- Oracle
- PostgreSQL

<div class="page-break" style="page-break-before: always;"></div>


# NoSQL

- Not Only SQL
- Large Volumes of Data
- Persistence
- Based on CAP theory  
	- Consistency  
	- Availability  
	- Partition Tolerance
- Four main types:
	- Graph DB
	- Document DB
	- Key-Value DB
	- Wide-Column DB

### NoSQL Databases
- ArangoDB
- Cassandra
- Couchbase
- CouchDB
- MongoDB
- RavenDB
- Redis
- TigerGraph


<div class="page-break" style="page-break-before: always;"></div>

# NewSQL

- Merging of NoSQL and SQL
- Two development avenues
- Extending current systems  
	- MariaDB, PostgreSQL  
- New developments  
	- Google Spanner, Amazon Aurora, Azure CosmosDB, CockroachDB 

### NewSQL Databases
- CockroachDB
- NuoDB
- SingleStore
- TiDB

<div class="page-break" style="page-break-before: always;"></div>

![](assets/S09-MongoDB-1-Introduction-20240912102155996.png)
https://geekandpoke.typepad.com/geekandpoke/2011/01/nosql.html  

<div class="page-break" style="page-break-before: always;"></div>


# MongoDB v MySQL/MariaDB Term Comparison 

| MongoDB                    | MariaDB/MySQL                   |
| -------------------------- | ------------------------------- |
| Database                   | Database / Schema               |
| Collection                 | Table                           |
| Field                      | Field / Column / Attribute      |
| Document                   | Record / Row                    |
| MQL (Mongo Query Language) | SQL (Structured Query Language) |

<div class="page-break" style="page-break-before: always;"></div>


# General Terms 

| Term     | Meaning                                                |
| -------- | ------------------------------------------------------ |
| DBMS     | Database Management System<br>                         |
| Database | An organised collection of items of interrelated data  |
| API      | A general term to represent the ‘type’ of the data     |
| ACID     | Atomicity, Consistency, Isolation, and Durability      |
| CAP      | Consistency, Availability, Partition-Tolerance         |
| BASE     | Basically-Available, Soft-State, Eventually-Consistent |
| RDBMS    | Relational Database Management System                  |
|          |                                                        |

<div class="page-break" style="page-break-before: always;"></div>


# RDBMS/SQL Terms 

| Term           | Meaning                                                                                                       |
| -------------- | ------------------------------------------------------------------------------------------------------------- |
| SQL            | Structured Query Language                                                                                     |
| SQL            | Structured Query Language<br>Two general components DDL & DML                                                 |
| DDL            | Data Definition Language<br>Definition of Databases and Tables                                                |
| DML            | Data Manipulation Language<br>Data operations: Create, Edit, Retrieve and Delete                              |
| Normalisation  | The formal process of designing a relational database<br>Reduces redundancy, errors and other inconsistencies |
| Schema         | Another name for database<br>Databases are made up of tables                                                  |
| Table          | A collection of columns and rows<br>Blueprint for items that contain similarly structured data                |
| Column / Field | A single property of an ‘object’                                                                              |
| Row / Record   | All row data relates directly to the same item<br>One datum per column in the table                           |
| Relationship   | When two or more tables are ‘joined’ using primary and foreign keys                                           |
| Candidate Key  | A field that could be used as a primary key<br>Each item of data in this field is unique                      |
| Primary Key    | An identifier that is unique for each record in the table                                                     |
| Foreign Key    | A field that is the primary key in another table<br>Used to create ‘relationships’ between tables             |
|                |                                                                                                               |

<div class="page-break" style="page-break-before: always;"></div>


# NoSQL Terms 

| Term           | Meaning                                                                                                                             |
| -------------- | ----------------------------------------------------------------------------------------------------------------------------------- |
| NoSQL          | Not Only SQL                                                                                                                        |
| Graph DB       | Designed to store and navigate relationships between data                                                                           |
| Document DB    | Manage semi-structured data<br>No fixed structure to data                                                                           |
| Key-Value DB   | Stores data in a simple key and value method<br>In programming known as an "associative array", "dictionary" or  "hash"             |
| Wide-Column DB | Use a concept of "keyspace"<br>Keyspace is similar to a relational database’s schema<br>Organise data storage into flexible columns |
|                |                                                                                                                                     |

<div class="page-break" style="page-break-before: always;"></div>


# Other Terms 

| Category  | Term           | Meaning                                                                                                                                     |
| --------- | -------------- |---------------------------------------------------------------------------------------------------------------------------------------------|
| Other     | Server Side    | Running on a web server, cloud server or serverless system<br>                                                                              |
|           | Client Side    | Running on the local hardware a user is using<br>May be Browser, Mobile or Desktop based                                                    |
|           | GraphQL        | This is NOT a type of DB<br>Developed from work by Facebook<br>GraphQL may be viewed as an alternative to a REST API                        |
|           | JavaScript     | Language originally developed for web page interactivity<br>Now used Server and Client side<br>JavaScript is NOT Java<br>Type-less language |
|           | JSON           | JavaScript Object Notation<br>A way of describing ‘objects’<br>Extensively used in JavaScript                                               |

<div class="page-break" style="page-break-before: always;"></div>


# What you'll need
- MongoDB Atlas Account
- MongoDB (Community) Server
- MongoDB Tools
- MongoDB Shell
- MongoDB Compass (or equivalent UI)

  
### See MongoDB installation presentations for details

<div class="page-break" style="page-break-before: always;"></div>


# MongoDB Key Details

- **Commands:**
	- <span style="background:rgba(240, 107, 5, 0.2)">CASE SENSITIVE</span>

- **Will <span style="background:rgba(240, 107, 5, 0.2)">NOT</span> pick up typos in the names of:
	- Databases
	- Collections
	- Documents or
	- Fields

**Names of databases, collections, attributes, etc:**  
- Case Sensitive  
- May use any UTF-8 characters  
- Must not be blank or null

**Recommendation:**  
- Use standard A-Z, a-z, 0-9, underscore (_)  
- Other UTF-8 characters may be hard to enter  
- (examples:  Über, ålpha, Français, … and so on)

# MongoDB: Data Types & Documents

## Documents

- Key-Value Pairs
- Stored as:  
	- Binary JSON  
	- Aka BSON  
	- Pronounced BiSON

![](assets/S09-MongoDB-1-Introduction-20240912105316113.png)
https://www.deviantart.com/arseniic/art/What-did-the-buffalo-say-to-his-son-when-he-left-287766727style.visibilitystyle.visibility  


## Data Types for Values
- Text (Strings)
- Numbers  
	- Integer  
	- Double  
	- Boolean
- Null
- Timestamp
- ObjectId
- Arrays
- Documents
- Binary data format
- Regular expression

## Documents: Example  

```json
{
	"title": "Apple Pie",
	"directions": [
		"Roll the pie crust",
		"Make the filling",
		"Bake"
	],
	"ingredients": [
		{
			"name": "pie crusts",
			"amount": {
				"quantity": 2,
				"unit": null
			}
		}, 
		{
			"amount": {
				"quantity": 1,
				"unit": "tbsp"
			},
			"name": "cinnamon"
		}
	]
}
```

| Key         | Content Type                          |
| ----------- | ------------------------------------- |
| title       | String                                |
| directions  | Array<br>ordered from first to last   |
| ingredients | Array of Objects / Array of documents |
| quantity    | Number (integer)                      |
| amount      | document: containing key-value pairs  |

# MongoDB Structure Waterfall

 > MongoDB                               
 > > has **Databases**                   
 > > > which have **Collections**            
 > > > > which have **Documents**              
 > > > > > made up of **Key-Value pairs**        
 > > > > > > with **values** having data **types** 
  

# Exercises

Refer to the notes in  [MongoDB-Learning-Path](Session-10/S09-MongoDB-Learning-Path.md) for details on signing upo for MongoDB University and the Course(s) that are to be undertaken for free.


# END

Next up - [LINK TEXT](#)
