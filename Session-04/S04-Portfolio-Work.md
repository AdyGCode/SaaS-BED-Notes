---
created: 2024-07-31T08:45
updated: 2024-08-01T15:34
---

# Portfolio Work

For the portfolio you will be creating a REST API for a Job Advertising system.

Part of the work has been completed during the learning sessions, and includes the API for Regions, Subregions, Countries, States and Cities.

Also, there is a basic API developed for User Management.

At this time, no security has been added to the system.

Before securing the API we require the core API features to be developed and tested.

## Requirements for ALL Features

- All data MUST be validated
- Correct HTTP Responses will be given (200 OK, 201 Created, 404 Not Found, 403 Forbidden, etc)
- A standardised response structure will be used:
  ```json 
  {
    "success": true|false,
    "message": "Some form of message",
    "data": { 
      ...
    }
  }
  ```



## Features

You are required to develop the following feature sets:

### Companies

The companies feature will allow a client to administer companies.

This includes the ability to:

- browse
- read
- add
- edit
- "soft delete"
- "soft undo"

At this time, companies may be edited, added and deleted by any user.

The company model will have the following fields:

- (company) name
- city
- state
- country
- logo (image)

Use the country, state, city and company name as a combined unique key so that a company with multiple locations can advertise a position for a particular city.

Key relationships include, but may not be limited to:
- A company may have one or more positions related to it.

Remember that soft deletes will be required.

### Positions (Listings)

The positions feature will allow a client to manage positions. This includes:

- browse
- read
- add
- edit
- "soft delete"
- "soft undo"

At this time, positions may be edited, added and deleted by any user.

The positions model will include, but may not be limited to the following fields:

- advertising start date
- advertising end date
- position title
- position description
- position keywords
- minimum salary
- maximum salary
- salary currency (default AUD)
- company (including city, state and country)
- benefits
- requirements
- position type (permanent, contract, part-time, casual)

Key relationships include, but may not be limited to:

- A position belongs to a company.
- A position belongs to a user (client).

Remember that soft deletes will be required.


### Applications (FUTURE FEATURE)

The applications feature will allow an applicant will be able to apply for a position.

This feature is *not* to be implemented at this time.

### Users

The users feature allows for users of the system to be managed.

This includes:

- browse
- read
- add
- edit
- "soft delete"
- "soft undo"

The users model should include:
- user nickname
- given name
- family name
- email address
- company
- user type (client, staff, or applicant)
- status (active, unconfirmed, suspended, banned, unknown, suspended)

During "online" registration the client would be asked if they will be a client (posting positions) or an applicant (looking for work).

A user cannot be both client and applicant.

Key relationships include, but may not be limited to:

- A client may have zero of more positions advertised.
- A client belongs to one company
- An applicant belongs to no company
- An applicant may have zero or more applications (FUTURE FEATURE)

Remember that soft deletes will be required.



### Roles and Permissions

Roles and permissions are NOT to be implemented at this time.

You do not need to create an API for Roles and Permissions as these are tied into the security of the application and the API.



