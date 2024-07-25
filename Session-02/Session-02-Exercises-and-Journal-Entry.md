---
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
header: "![NMTAFE](../images/Black-Red-Banner.svg)"
auto-scaling: true
size: 1920x1080
color: "#ccc"
backgroundColor: "#060606"
tags:
  - SaaS
  - APIs
  - Back-End
  - Journal
date created: 03 July 2024
date modified: 08 July 2024
---

# Session 01 Exercises & Journal Entry

## Software as a Service - Back-End Development

Session 01 Assessment Activity 

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

# Session 02 Exercises & Journals 

For this week's journal we would like you to do the following:

## Summarise the Session's Content

Be honest with yourself as to what you did and did not understand. If you spotted any issues in notes or other materials, then make sure you note that, and as a big help to your lecturer, submit a help desk request with the 

The following are exercises for you to use to add features to the API as practice.

## Exercise 1: Subregion

We have completed the Region, next we need to add the Subregion

### Subregion model details

When you complete the same as we have done for the Region, make sure that the Subregion model contains only the following:

- id
- name
- region_id

Make sure you write the tests to go with the index and show methods.

The region id should not be string, but an unsigned integer.

### Add Documentation

Add the required Php DocBlocks to the methods in the Controller to allow Scribe to autogenerate the documents.

These methods should be in the "Subregions" group.

## Exercise 2: Country

We have completed the Region and Subregion, next we need to add the Country.

### Country model details

When you complete the same as we have done for the Region, make sure that the Country model contains only the following:

- name
- iso3
- iso2
- numeric_code
- phone_code
- capital
- currency
- currency_name
- currency_symbol
- tld
- region
- region_id
- subregion
- subregion_id
- emoji

Make sure you write the tests to go with the index and show methods.

The region id, subregion id, and numeric code should not be string, but unsigned integers.

### Add Documentation

Add the required Php DocBlocks to the methods in the Controller to allow Scribe to autogenerate the documents.

These methods should be in the "Countries" group.

## Exercise 3: States

Let's keep this going and create the States API…

### State model details

When you complete the same as we have done for the Region, make sure that the States model contains only the following:

- id
- name
- country_id
- country_code
- country_name
- state_code
- type

Make sure you write the tests to go with the index and show methods.

Make sure that the country code and country id in this model matches the data types in the Country model. The state code is a string, max length of 6 characters.

### Add Documentation

Add the required Php DocBlocks to the methods in the Controller to allow Scribe to autogenerate the documents.

These methods should be in the "States" group.

## Exercise 4: Cities

On the last leg for this, and it's the biggest of them all. The Cities!

### City model details

Following the same steps as before, add only the following:

- id
- name
- state_id
- state_code
- state_name
- country_id
- country_code
- country_name

Make sure you write the tests to go with the index and show methods.

Make sure that the country code and country id in this model matches the data types in the Country model.

### Add Documentation

Add the required Php DocBlocks to the methods in the Controller to allow Scribe to autogenerate the documents.

These methods should be in the "Cities" group.



## Research

Identify (without using Adrian Gould's Diigo account) an example of each of the following:
	- Tutorial on creating (Update/Create) Request classes for data validation
	- Tutorial on creating APIs with Laravel
	- Tutorial on testing with PEST
	- Tutorial on using Postman when developing APIs

Read through each tutorial, and summarise key points from each

## Pest from Scratch

Last week you will have started the Pest from Scratch course. This week you should aim to finish it.

Complete the [Pest From Scratch](https://laracasts.com/series/pest-from-scratch)  (<https://laracasts.com/series/pest-from-scratch>) free course on Pest and Pest v2. Total video time is approximately 1hr 45min. 

Once completed summarise your learning in the journal as a separate post.




---

# END
