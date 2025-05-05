---
created: 2024-09-05T10:54
updated: 2025-04-28T16:26
---
# Introduction to NoSQL


Mistral discussion: https://chat.mistral.ai/chat/08b14a41-a4b0-4141-852c-99dcde004212


## What is NoSQL

NoSQL stands for "*Not Only SQL*." 

It's a type of database designed to handle large volumes of unstructured, semi-structured, or structured data. 

NoSQL databases are known for their flexibility, scalability, and performance, making them a great fit for modern applications that deal with big data and real-time processing.

 They are designed to handle diverse data types and large volumes of data efficiently. 
 
 However, they often trade off strict consistency for better performance and availability.

Cover many different types of database structure, including:

- Key-Value Databases
- Wide Column Databases
- Document Databases
- Graph Databases
- Object Databases
 
It is possible to have systems that combine both SQL and NoSQL data storage in hybrid systems (for example PostgreSQL).



## Five Key Differences from SQL/Relational DBs

1. **Schema Flexibility

   - **SQL/Relational DBs:** Have a fixed schema. You need to define tables, columns, and relationships before you can store data.
   - **NoSQL:** Typically schema-less or schema-flexible. You can store data without defining a structure upfront, and each record can have a different structure.

2. **Scalability**

   - **SQL/Relational DBs:** Vertically scalable. You scale up by adding more resources (CPU, RAM) to a single server.
   - **NoSQL:** Horizontally scalable. You scale out by adding more servers to a distributed network, making it easier to handle large amounts of data and high traffic.

3. **Data Model**

   - **SQL/Relational DBs:** Use a tabular data model with rows and columns. Data is organized into tables with predefined relationships.
   - **NoSQL:** Use various data models like key-value, document, column-family, and graph. Each model is optimized for different types of data and use cases.

4. **Consistency vs. Availability**

   - **SQL/Relational DBs:** Prioritize consistency (ACID properties). Transactions are atomic, consistent, isolated, and durable.
   - **NoSQL:** Often prioritize availability and partition tolerance over strict consistency (eventual consistency). This is based on the CAP theorem, which states that in a distributed system, you can only have two out of three: Consistency, Availability, and Partition Tolerance.

5. **Query Language**

   - **SQL/Relational DBs:** Use SQL (Structured Query Language) for defining and manipulating data. SQL is a powerful and standardized language.
   - **NoSQL:** Use different query languages or APIs specific to the database type. For example, MongoDB uses a query language similar to JavaScript, while Cassandra uses CQL (Cassandra Query Language).


## NoSQL Types

Let's look at some of the different types of NoSQL database and their key features.

### Key-Value Databases

Imagine a big dictionary where you have keys and values. 

In a Key-Value Database, each piece of data is stored as a key-value pair. 

The key is unique and helps you quickly find the value associated with it. Think of it like a massive lookup table.

**Key Features:**
- **Simple and Fast:** Great for quick lookups.
- **Scalable:** Easy to distribute across multiple servers.
- **Flexible:** No fixed schema, so you can store any type of data.

**Example:** Redis, DynamoDB, Amazon DynamoDB, Couchbase,  Memcached, ArangoDB.

### Wide Column 

These are like spreadsheets on steroids. You've got rows and columns, but the columns can be dynamic and vary from row to row.

It's perfect for handling large amounts of data that don't fit neatly into a traditional table.

**Key Features:**

- **Scalable:** Designed to handle massive amounts of data.
- **Flexible Schema:** Columns can be added on the fly.
- **Optimized for Writes:** Great for high-write workloads.

**Example:** Apache Cassandra, Google's Bigtable, Amazon DynamoDB, Azure Cosmos DB, HBase

### Document Databases

Think of these as a big filing cabinet where each document is a JSON or BSON object. 

Each document can have a different structure, making it super flexible for storing complex data.

**Key Features:**

- **Flexible Schema:** Each document can have its own structure.
- **Hierarchical Data:** Great for nested data structures.
- **Queryable:** You can query the data using powerful query languages.

**Example:** MongoDB, CouchDB, ArangoDB, RavenDB, Elasticsearch

### Graph Databases

Imagine a network of nodes and relationships. Graph Databases are designed to store and query data that is highly interconnected. 

Think social networks, recommendation systems, and fraud detection.

**Key Features:**

- **Relationship-Focused:** Optimized for querying relationships between data.
- **Flexible Schema:** No fixed schema, nodes and edges can have any attributes.
- **Complex Queries:** Can handle complex queries involving multiple hops between nodes.

**Example:** Neo4j, Amazon Neptune,Azure Cosmos DB, FlockDB.

### Object Databases

These are like a big warehouse where you store objects directly, just like you would in an object-oriented programming language. 

No need to translate objects into rows and columns.

**Key Features:**

- **Object-Oriented:** Stores objects directly, no need for ORM.
- **Flexible Schema:** Each object can have its own structure.
- **Complex Data Types:** Can handle complex data types and relationships.

**Example:** db4o, ObjectDB, Realm, Perst, JADE

So there you have it, mate! Each type of NoSQL database has its own strengths and is suited for different kinds of tasks. Hope that clears things up for ya!


### Multi-Model Systems

There are systems that offer Multiple models of data storage, and they include (but not limited to): 

- OrientDB, 
- ArangoDB, 
- Azure Cosmos DB, and 
- Couchbase.


# Resources

Further Reading:
- Wikipedia. (2009, August 13). class of databases for storage and retrieval of modeled data other than relational databases. Wikipedia.org; Wikimedia Foundation, Inc. https://en.wikipedia.org/wiki/NoSQL
- Keita, Z. (2022, June 24). _NoSQL Databases: What Every Data Scientist Needs to Know_. Datacamp.com; DataCamp. https://www.datacamp.com/blog/nosql-databases-what-every-data-scientist-needs-to-know

Selected System Homepages:
- ArangoDB. (2025, April 10). _Home_. ArangoDB. https://arangodb.com/
- _Apache Cassandra | Apache Cassandra Documentation_. (2016). Apache Cassandra. https://cassandra.apache.org/_/index.html
- _Apache HBase – Apache HBase® Home_. (2019). Apache.org. https://hbase.apache.org/
- _Couchbase: Best Free NoSQL Cloud Database Platform_. (2025, April 10). Couchbase. https://www.couchbase.com/
- _Dragonfly - The Fastest In-Memory Data Store_. (2024). Dragonfly. https://www.dragonflydb.io/
- _Elasticsearch: The Official Distributed Search & Analytics Engine | Elastic_. (2025). Elastic. https://www.elastic.co/elasticsearch
- _Life is an Adventure — Your Database Shouldn’t Be_. (2025, April 21). RavenDB NoSQL Database. https://ravendb.net/
- _MongoDB: The World’s Leading Modern Database_. (2024). MongoDB. https://www.mongodb.com/
- _Neo4j Graph Database & Analytics – The Leader in Graph Databases_. (2024, July 31). Graph Database & Analytics. https://neo4j.com/
- _Redis - The Real-time Data Platform_. (2025, April 25). Redis. https://redis.io/
- _memcached - a distributed memory object caching system_. (2025). Memcached.org. https://memcached.org/




