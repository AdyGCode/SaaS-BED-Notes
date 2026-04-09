---
theme: nmt
background: https://cover.sli.dev
title: Session 10/1 - Introducing NoSQL
class: text-left
drawings:
  persist: false
transition: fade
mdc: true
duration: 35min
---

# Session 10/1 - Introducing NoSQL

## Software as a Service - Back-End Development

#### ICT50120 Diploma of Information Technology (Advanced Programming)

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
level: 1
class: text-left
---

# Objectives

::left::

-

::right::

-

---
level: 2
---

# Contents

<Toc minDepth="1" maxDepth="1" columns="2" />

---
class: text-left
layout: section
---

# Warm up!

## ...

---
level: 2
---

# ... warmup details

<Announcement type="brainstorm">
<ol>
<li>...</li>
</ol>
</Announcement>

<!--

-->

---
layout: section
---

# What is NoSQL

---
level: 2
layout: two-cols
---

# What is NoSQL

::left::

### Definition

<Announcement type="info" title="NoSQL" style="font-size: 2rem;padding: 0.5rem;line-height: 2.5rem">
<p>"Not Only SQL"</p> 
</Announcement>

::right::
### Designed for?
It's a type of database designed to handle large volumes of data that is:
- unstructured, 
- semi-structured, or 
- structured. 


---
level: 2
layout: two-cols
---

# What is NoSQL

## Key Features
::left::

### Designed for...
NoSQL databases are known for their:
- flexibility, 
- scalability, and 
- performance

They are a great fit for modern  applications that deal with:
- big data and 
- real-time processing.

::right::
### Designed for...

Designed to:
- handle diverse data types and large volumes of data efficiently. 
 
However, often trade off strict consistency for
- better performance and
- availability.


---
level: 2
layout: two-cols
---

# What is NoSQL

::left::

## Types of NoSQL Databases
Cover many different types of database structure, including:

- Key-Value Databases
- Wide Column Databases
- Document Databases
- Graph Databases
- Object Databases
 
::right::

## Hybridisation?

Hybrid DBMS:
- Systems that combine both SQL and NoSQL data storage.

---
layout: section
---

# Five Key Differences from SQL/RDBMS

<br>

<Announcement type="info" title="RDBMS">
Shorthand for Relational Database Management Systems
</Announcement>

---
level: 2
layout: two-cols
---

# Five Key Differences from SQL/RDBMS

<br>

## Schema Flexibility

::left::

### SQL/Relational DBs:
- Have a fixed schema. 
- You need to define tables, columns, and relationships before you can 
  store data.

::right::

### NoSQL:
- Typically schema-less or schema-flexible. 
- You may store data without defining a structure upfront.
- Each record may have a different structure.


---
level: 2
layout: two-cols
---

# Five Key Differences from SQL/RDBMS

<br>

## Scalability

::left::
### SQL/Relational DBs
-  Vertically scalable
- Scale up
- Add more resources to a single server:
   - CPU
   - RAM
   - Storage

::right::

### NoSQL
-  Horizontally scalable
- Scale out 
- Add more servers to a distributed network

Makes it easier to handle large amounts of data and high traffic

---
level: 2
layout: two-cols
---

# Five Key Differences from SQL/Relational DBs

<br>

## Data Model
::left::


### SQL/Relational DBs
- Tabular data model with rows and columns. 
- Organized into tables with predefined relationships.

::right::
### NoSQL
- Use various data models like:
   - key-value, 
   - document, 
   - column-family, and   
   - graph. 
- Models optimized for different:
   - types of data and 
   - use cases.


---
level: 2
layout: two-cols
---

# Five Key Differences from SQL/RDBMS

<br>

## Consistency vs. Availability
::left::


### SQL/Relational DBs
-  Prioritize consistency (ACID properties). 
- Transactions are:
   - atomic, 
   - consistent, 
   - isolated, and 
   - durable.

::right::
### NoSQL
- Often prioritize:
   - availability and partition tolerance 
   - over strict consistency (eventual consistency). 
- Based on the CAP theorem:
   - "in a distributed system, you can only have two out of three: Consistency, Availability, and Partition Tolerance."

---
level: 2
layout: two-cols
---

# Five Key Differences from SQL/RDBMS

<br>

## Query Language
::left::


### SQL/Relational DBs
- Use SQL for defining and manipulating data.
   - SQL = Structured Query Language 
- SQL is:
   - powerful and
   - standardized

::right::
### NoSQL
- Each DB type/model use specific :
   -  different query languages or 
   -  APIs specific
- For example:
   - MongoDB uses a query language similar to JavaScript, 
   - Cassandra uses CQL (Cassandra Query Language).

---
layout: section
---

# NoSQL Types

Brief look at types of NoSQL DBMS

---
level: 2
layout: two-cols
---

# NoSQL Types

::left::

### Key-Value Databases

Imagine a big dictionary where you have keys and values. 

In a Key-Value Database, each piece of data is stored as a key-value pair. 

The key is unique and helps you quickly find the value associated with it. Think of it like a massive lookup table.

::right::

### Key Features:
- **Simple and Fast:** Great for quick lookups.
- **Scalable:** Easy to distribute across multiple servers.
- **Flexible:** No fixed schema, so you can store any type of data.

<br>

#### Examples:
Redis, DynamoDB, Amazon DynamoDB, Couchbase,  Memcached, 
ArangoDB.


---
level: 2
layout: two-cols
---

# NoSQL Types

::left::

### Wide Column 

These are like spreadsheets on steroids. You've got rows and columns, but the columns can be dynamic and vary from row to row.

It's perfect for handling large amounts of data that don't fit neatly into a traditional table.

::right::

### Key Features:

- **Scalable:** Designed to handle massive amounts of data.
- **Flexible Schema:** Columns can be added on the fly.
- **Optimized for Writes:** Great for high-write workloads.

<br>

#### Examples:
Apache Cassandra, Google's Bigtable, Amazon DynamoDB, Azure Cosmos DB, HBase

---
level: 2
layout: two-cols
---

# NoSQL Types
::left::
### Document Databases

Think of these as a big filing cabinet where each document is a JSON or BSON object. 

Each document can have a different structure, making it super flexible for storing complex data.

::right::

### Key Features:

- **Flexible Schema:** Each document can have its own structure.
- **Hierarchical Data:** Great for nested data structures.
- **Queryable:** You can query the data using powerful query languages.


<br>

#### Examples:
MongoDB, CouchDB, ArangoDB, RavenDB, Elasticsearch

---
level: 2
layout: two-cols
---

# NoSQL Types
::left::
### Graph Databases

Imagine a network of nodes and relationships. Graph Databases are designed to store and query data that is highly interconnected. 

Think social networks, recommendation systems, and fraud detection.


::right::

### Key Features:

- **Relationship-Focused:** Optimized for querying relationships between data.
- **Flexible Schema:** No fixed schema, nodes and edges can have any attributes.
- **Complex Queries:** Can handle complex queries involving multiple hops between nodes.


<br>

#### Examples:
Neo4j, Amazon Neptune,Azure Cosmos DB, FlockDB.

---
level: 2
layout: two-cols
---

# NoSQL Types
::left::
### Object Databases

These are like a big warehouse where you store objects directly, just like you would in an object-oriented programming language. 

No need to translate objects into rows and columns.


::right::

### Key Features:

- **Object-Oriented:** Stores objects directly, no need for ORM.
- **Flexible Schema:** Each object can have its own structure.
- **Complex Data Types:** Can handle complex data types and relationships.


<br>

#### Examples:
db4o, ObjectDB, Realm, Perst, JADE



---
level: 2
layout: two-cols
---

# NoSQL Types
::left::
### Multi-Model (Hybrid) Systems

There are systems that offer Multiple models of data storage, and they include (but not limited to): 

- OrientDB, 
- ArangoDB, 
- Azure Cosmos DB, and 
- Couchbase.

---
layout: section
---

# Resources

---
level: 2
---
# Resources

## Further Reading:
- Wikipedia. (2009, August 13). class of databases for storage and retrieval of modeled data other than relational databases. Wikipedia.org; Wikimedia Foundation, Inc. https://en.wikipedia.org/wiki/NoSQL
- Keita, Z. (2022, June 24). _NoSQL Databases: What Every Data Scientist Needs to Know_. Datacamp.com; DataCamp. https://www.datacamp.com/blog/nosql-databases-what-every-data-scientist-needs-to-know


---
level: 2
---
# Resources

## Selected System Homepages:
- ArangoDB. (2025, April 10). _Home_. ArangoDB. https://arangodb.com/
- _Apache Cassandra | Apache Cassandra Documentation_. (2016). Apache Cassandra. https://cassandra.apache.org/_/index.html
- _Apache HBase – Apache HBase® Home_. (2019). Apache.org. https://hbase.apache.org/
- _Couchbase: Best Free NoSQL Cloud Database Platform_. (2025, April 10). Couchbase. https://www.couchbase.com/
- _Dragonfly - The Fastest In-Memory Data Store_. (2024). Dragonfly. https://www.dragonflydb.io/
- _Elasticsearch: The Official Distributed Search & Analytics Engine | Elastic_. (2025). Elastic. https://www.elastic.co/elasticsearch

---
level: 2
---
# Resources

## Selected System Homepages:
- _Life is an Adventure — Your Database Shouldn’t Be_. (2025, April 21). RavenDB NoSQL Database. https://ravendb.net/
- _MongoDB: The World’s Leading Modern Database_. (2024). MongoDB. https://www.mongodb.com/
- _Neo4j Graph Database & Analytics – The Leader in Graph Databases_. (2024, July 31). Graph Database & Analytics. https://neo4j.com/
- _Redis - The Real-time Data Platform_. (2025, April 25). Redis. https://redis.io/
- _memcached - a distributed memory object caching system_. (2025). Memcached.org. https://memcached.org/

---

# Recap Checklist

- [ ] 
- [ ] 
- [ ] 
- [ ] 
- [ ] 

---
level: 2
---

# Exit Ticket

> Pose a question about the content


---

# Acknowledgements

- Fu, A. (2020). Slidev. Sli.dev. https://sli.dev/
- Font Awesome. (2026). Font Awesome. Fontawesome.com; Font
  Awesome. https://fontawesome.com/
- Mermaid Chart. (2026). Mermaid.ai. https://mermaid.ai/

> Slide template by Adrian Gould

<br>

> - Mermaid syntax used for some diagrams
> - Some content was generated with the assistance of Microsoft CoPilot
