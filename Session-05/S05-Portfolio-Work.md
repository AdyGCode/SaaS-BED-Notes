---
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
header: "![NMTAFE](../assets//Black-Red-Banner.svg)"
auto-scaling: true
size: 4k
color: "#ccc"
backgroundColor: "#060606"
tags:
  - SaaS
  - APIs
  - Back-End
  - Overview
date created: 03 July 2024
date modified: 08 July 2024
created: 2024-07-31T07:52
updated: 2024-08-09T09:06
---


For the portfolio you will be creating a REST API for a Job Advertising system.

Part of the work has been completed during the learning sessions, and includes the API for Regions, Subregions, Countries, States and Cities.

Also there is a basic API developed for User management.

## Features

You are required to develop the following feature sets:

### Users

The first feature set is to implement Authentication using Sanctum requests to your API.

At no point should we see any HTML login page, or errors, or similar.

All responses are in JSON format, and correctly structured as per the previous stage of the portfolio.

The users should include a field that indicates if the user is a client, staff, or applicant.

During "online" registration the end user will submit the required user type:

- client (posting positions) or 
- applicant (looking for work).

A user cannot be both client and applicant.

Once Register, Login and Logout have been completed then continue with the next phase.

### Companies

Protect all routes for companies so an end user must be logged in via the API.

### Positions

Protect all route except the index (browse) route so that end users must be logged in via the client.

The index (browse) route should only return six (6) positions when the user is not logged in, and return all positions when logged in. The latter will be paginated (pages of 3, 6, or 9 for testing).

