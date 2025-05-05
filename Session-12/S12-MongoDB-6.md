---
created: 2025-03-24T09:08
updated: 2025-04-28T16:00
header: ICT50220 - Adv Prog - SaaS 2 - BED
footer: © Copyright 2024, Adrian Gould & NM TAFE
theme: default
paginate: true
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
---

# NoSQL 6

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

Refer to the notes in [MongoDB-Learning-Path](../Session-09/S09-MongoDB-Learning-Path.md) for details on signing up for MongoDB University and the Course(s) that are to be undertaken for free.

## MongoDB Practice Exercises 2

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

These are the same as the question titles in this document, but at a level 2 (##) not level
3 (###) Markdown heading.

The answer is contained in a code block, as shown above. Important is that code blocks actually
start at the beginning of the line.

### Exercise 1: Create Database

Create a new database named `practice_college`.

### Exercise 2: Create Collection

Create a collection named `students`.

### Exercises 3: Add documents

Insert the following data into documents in the `students` collection with fields as given in
the table below.

| Given Name      | Family Name | Age | Subject                | Date of Birth |
|-----------------|-------------|-----|------------------------|---------------|
| Monk            | Keye        | 19  | Applied Maths 301      | 09/10/2005    |
| Ruth            | Leslie      | 23  | Geneology 101          | 18/04/2001    |
| Drew            | Lotts       | 27  | Geology 101            | 24/08/1997    |
| Faye            | Kinnitt     | 27  | Python Programming 101 | 02/08/1997    |
| Token           | Dummi       | 27  |                        | 23/07/1997    |
| Drew            | Pictures    | 30  | Applied Maths 301      | 13/09/1994    |
| Dee             | Lightful    | 22  | Python Programming 101 | 28/06/2002    |
| Crystal-Chantal | Leer        | 26  | Python Programming 201 | 30/01/1998    |
| Eileen          | Dover       | 27  | Applied Maths 101      | 01/04/1997    |
| Ube             | Tyacan      | 46  | Geneology 101          | 16/04/1978    |

### Exercise 4: Query Data

Write a query to retrieve all documents from the `students` collection.

### Exercise 5: Query Data

Write a query to retrieve only the names of students from the `students` collection.

### Exercise 6: Query Data

Write a query to retrieve only the names of students from the `students` collection, and sort
them by family name then given name.

### Exercise 7: Query Data

Write a query to retrieve all students who are 27 years old.

### Exercise 8: Update Data

Write the query to update the age of a specific student in the `students` collection.

| name         | new age |
|--------------|---------|
| Eileen Dover | 28      |

### Exercise 9: Update Data

Write the query to add a new field, `grade`, with the value "A" to all documents in the
`students` collection.

### Exercise 10: Update Data

Write the query to update the `grade`, for `Dee Lightful`, and `Ruth Leslie` to "B+".

### Exercise 11: Delete Data

Delete the student given below from the `students` collection.

| Given Name | Family Name |
|------------|-------------|
| Token      | Dummi       |

### Exercise 12: Delete Data

Create the query to remove the `grade` field from all documents in the `students` collection.

### Exercise 13: Aggregation

Write the query to calculate the average age of students in the `students` collection.

### Exercise 14: Aggregation

Write the query to group students by their subjects and count the number of students in each
subject.

### Exercise 15: Indexing

Create an index on the `subject` field in the `students` collection.

### Exercise 16: Indexing

Create a text index on the `family_name` and `given_name` fields in the `students` collection.

### Exercise 17: Indexing

Check the execution plan for a query that finds the students with a first name of Drew.

Check if the created index is being used.

### Exercise 18: Text Search

Create a text index on the `name` and `subject` fields in the `students` collection.

### Exercise 19: Text Search

Perform a text search for students with the keyword `Maths`.

### Exercise 21: Working with Dates

Find students born after 1st January 1995.

### Exercise 17: Geospatial Query

Create a collection named `locations`.

### Exercise 18: Geospatial Query

Add the following data to the collection:

| name        | state id | state code | state name         | country id | country code | country name   | latitude     | longitude    |     |
| ----------- | -------- | ---------- | ------------------ | ---------- | ------------ | -------------- | ------------ | ------------ | --- |
| Sinaballaj  | 633      | TR         | Tirana District    | 3          | AL           | Albania        | 41.06889000  | 19.69944000  |     |
| Perth       | 2335     | SCT        | Scotland           | 232        | GB           | United Kingdom | 56.39522000  | -3.43139000  |     |
| Reading     | 1426     | MI         | Michigan           | 233        | US           | United States  | 41.83949000  | -84.74801000 |     |
| Fayzabad    | 3901     | BDS        | Badakhshan         | 1          | AF           | Afghanistan    | 37.11664000  | 70.58002000  |     |
| Sidi Amrane | 1139     | 30         | Ouargla            | 4          | DZ           | Algeria        | 33.49885000  | 6.00803000   |     |
| Perth       | 3906     | WA         | Western Australia  | 14         | AU           | Australia      | -31.95224000 | 115.86140000 |     |
| Reading     | 4851     | OH         | Ohio               | 233        | US           | United States  | 39.22367000  | -84.44216000 |     |
| Gambos      | 225      | HUI        | Huíla Province     | 7          | AO           | Angola         | -15.80926000 | 14.07661000  |     |
| Esquel      | 3651     | U          | Chubut             | 11         | AR           | Argentina      | -42.91147000 | -71.31947000 |     |
| Reading     | 1433     | MA         | Massachusetts      | 233        | US           | United States  | 42.52565000  | -71.09533000 |     |
| Perth       | 3908     | TAS        | Tasmania           | 14         | AU           | Australia      | -41.57231000 | 147.17096000 |     |
| Reading     | 3745     | 08         | Saint James Parish | 108        | JM           | Jamaica        | 18.43723000  | -77.94730000 |     |
| Lampertheim | 3018     | HE         | Hessen             | 82         | DE           | Germany        | 49.59786000  | 8.47250000   |     |
| Perth Town  | 3755     | 07         | Trelawny Parish    | 108        | JM           | Jamaica        | 18.43106000  | -77.62583000 |     |
| Gastre      | 3651     | U          | Chubut             | 11         | AR           | Argentina      | -42.26186000 | -69.22112000 |     |
| Perth       | 866      | ON         | Ontario            | 39         | CA           | Canada         | 44.90011000  | -76.24939000 |     |
| Reading     | 2336     | ENG        | England            | 232        | GB           | United Kingdom | 51.45625000  | -0.97113000  |     |

### Exercise 19: Geospatial Query

Using a geospatial query, find locations within 1000km of the location below.

The location is: `41, -84`

### Exercise 20: Aggregation Pipeline

Create a collection named `orders` with documents representing orders.

The JSON for the orders is shown below:

```json
[
    {
        "customer": "Monk Keye",
        "products": [
            {"name": "Organic Quinoa Crackers", "quantity": 2, "price": 1.50},
            {"name": "Gourmet Dark Chocolate Bar", "quantity": 1, "price": 3.00}
        ]
    },
    {
        "customer": "Ruth Leslie",
        "products": [
            {"name": "Artisan Hummus Dip", "quantity": 3, "price": 5.00},
            {"name": "Premium Almond Butter", "quantity": 1, "price": 17.50}
        ]
    },
    {
        "customer": "Drew Lotts",
        "products": [
            {"name": "Vegan Protein Bars", "quantity": 2, "price": 3.00},
            {"name": "Spicy Sriracha Sauce", "quantity": 1, "price": 1.50}
        ]
    },
    {
        "customer": "Faye Kinnitt",
        "products": [
            {"name": "Gluten-Free Pasta", "quantity": 2, "price": 5.00},
            {"name": "Handcrafted Granola", "quantity": 1, "price": 17.50}
        ]
    },
    {
        "customer": "Monk Keye",
        "products": [
            {"name": "Coconut Water Beverage", "quantity": 3, "price": 3.00}
        ]
    },
    {
        "customer": "Ruth Leslie",
        "products": [
            {"name": "Smoked Salmon Spread", "quantity": 1, "price": 1.50},
            {"name": "Organic Quinoa Crackers", "quantity": 2, "price": 1.50}
        ]
    },
    {
        "customer": "Drew Lotts",
        "products": [
            {"name": "Gourmet Dark Chocolate Bar", "quantity": 2, "price": 3.00},
            {"name": "Artisan Hummus Dip", "quantity": 1, "price": 5.00}
        ]
    },
    {
        "customer": "Faye Kinnitt",
        "products": [
            {"name": "Premium Almond Butter", "quantity": 1, "price": 17.50},
            {"name": "Vegan Protein Bars", "quantity": 2, "price": 3.00}
        ]
    },
    {
        "customer": "Monk Keye",
        "products": [
            {"name": "Spicy Sriracha Sauce", "quantity": 3, "price": 1.50},
            {"name": "Gluten-Free Pasta", "quantity": 1, "price": 5.00}
        ]
    },
    {
        "customer": "Ruth Leslie",
        "products": [
            {"name": "Handcrafted Granola", "quantity": 1, "price": 17.50},
            {"name": "Coconut Water Beverage", "quantity": 2, "price": 3.00}
        ]
    }
]

```

### Exercise 21: Aggregation Pipeline

Create a query that uses a aggregation pipeline to calculate the total revenue.

### Exercise 22: Aggregation Pipeline

Create a query that uses a aggregation pipeline to calculate the total for each order.

### Exercise 23: Aggregation Pipeline

Create a query that uses a aggregation pipeline to calculate the total of the orders for each customer.

   
# END

Next up - [LINK TEXT](#)
