---
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
header: "![NMTAFE](/assets//Black-Red-Banner.svg)"
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
created: 2024-07-31T07:52
updated: 2024-07-31T07:52
---

# Session 03 Exercises & Journal Entry

## Software as a Service - Back-End Development

Session 03 Assessment Activity 

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

# Session 03 Exercises & Journals 

## Complete the in class exercises

If you have not done so, please complete the in-class exercises that are contained in the notes.

These include any exercises from sessions 1 and 2 that have not been completed... 

**Remember to refactor as required!**

---

## Additional Practice Exercises

The following exercises combine the basics of an API Basic APIs with Relationships.
**Remember to use TDD when creating these API endpoints.**
### Regions

Create the Regions Browse and Read API

Make sure the following relationships are present:
- A Region may have one or more countries
- A region may have one or more subregions

Make sure that the following data is present in the model:
- name

---
### Subregions

Create the Subregions Browse and Read API

Make sure the following relationships are present:
- A subregion may have one or more countries
- A subregion belongs to a region

Make sure that the following data is present in the model:
- name
- region id

---
### Countries

Create the Countries Browse and Read API
	
Make sure that the following data is present in the model:
- name, 
- ISO2 code
- ISO3 code
- phone code
- tld

Make sure the following relationships are present:
- A country may have one or more states
- A country has one or more cities
- A Country belongs to one or more regions
- A Country belongs to one or more subregions

---
### States

Create the States Browse and Read API

Make sure the following relationships are present:
- A state belongs to a country
- A state may have one or more cities

Make sure that the following data is present in the model:
- name
- country id
- state code
- type (name this `state_type` to reduce possible issues at the SQL level)

---
### Cities

Create the Cities Browse and Read API

Make sure the following relationships are present:
- A city belongs to a country
- A city may belong to a state

Make sure that the following data is present in the model:
- name
- state id
- country id

---

### Companies

We created the Companies API, but we did not add any relationships.
Update the Companies API to use the Cities model in a relationship.


---
## Journal Entry: Summarise the Session's Content
**For general details on Journal Content see Session 01.**

For this week's journal we would like you to do the following...

1. Summarise the learning and exercises from this session
2. Investigate the options for securing APIs


Remember you MUST include references using MyBib APA6/APA7 format to any references used.

---
## Reflection Questions

Add these questions and your reflection on them to the journal

- **Question:** If you executed the command `php artisan make:model Fish -msf` what files would be created?
- **Question:** What is the purpose of XDebug?
- **Question:** What features does XDebug bring to you as a PHP Developer?

---
## Out Of Class Learning

1. Locate a tutorial on using Sanctum to secure an API.
2. Go through the tutorial and note important steps and other information.

Remember that [Pest From Scratch](https://laracasts.com/series/pest-from-scratch)  (<https://laracasts.com/series/pest-from-scratch>) has to be finished.

---
# Found a Problem?
 
If you spotted any problems (including missing details) in notes or other materials, then make sure you note that, and as a big help to your lecturer, you could fork the notes repository, create an issue, create a fix to the issue, and submit a pull request.



---

# END
