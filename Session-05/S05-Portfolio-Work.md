For the portfolio you will be creating a REST API for a Job Advertising system.

Part of the work has been completed during the learning sessions, and includes the API for Regions, Subregions, Countries, States and Cities.

Also there is a basic API developed for User management.

## Features

You are required to develop the following feature sets:
### Companies

The companies feature will allow a client to add a company, using the country, state, city and company name as a combined unique key so that a company with multiple locations can advertise a position for a particular city.

The table below shows how this feature maps to permissions to complete the tasks.

| User type     | Browse (all) | Read (one) | Edit     | Add      | Delete   | Search | Notes                                                                                  |
| ------------- | ------------ | ---------- | -------- | -------- | -------- | ------ | -------------------------------------------------------------------------------------- |
| Unregistered  | No           | No         | No       | No       | No       | No     |                                                                                        |
| Applicant     | No           | No         | No       | No       | No       | No     |                                                                                        |
| Client        | All          | All        | Only Own | Only Own | Only Own | All    |                                                                                        |
| Staff         | All          | All        | All      | All      | All      | All    | Soft Delete: Undo all, Undo one, Destroy all, Destroy one                              |
| Administrator | All          | All        | All      | All      | All      | All    | Soft Delete: Undo all, Undo one, Destroy all, Destroy one<br><br>Super-user account(s) |


### Positions

The positions feature will allow a client to manage positions, whilst an applicant will be able to apply for a position.

There are key items of data for the position that include, but may not be limited to, the advertising start date, advertising end date, as well as the position, a description, minimum and maximum salary, and other details.

The table below shows how this feature maps to permissions to complete the tasks.

| User type     | Browse (all)          | Read (one) | Edit     | Add      | Delete   | Search | Notes                                                                                  |
| ------------- | --------------------- | ---------- | -------- | -------- | -------- | ------ | -------------------------------------------------------------------------------------- |
| Unregistered  | Limited to random six | No         | No       | No       | No       | No     | Must register to be able to view details                                               |
| Applicant     | Yes                   | Yes        | No       | No       | No       | Yes    |                                                                                        |
| Client        | All                   | All        | Only Own | Only Own | Only Own | All    | Soft Delete: May undo only                                                             |
| Staff         | All                   | All        | All      | All      | All      | All    | Soft Delete: Undo all, Undo one, Destroy all, Destroy one                              |
| Administrator | All                   | All        | All      | All      | All      | All    | Soft Delete: Undo all, Undo one, Destroy all, Destroy one<br><br>Super-user account(s) |


The positions feature requires 

- List positions
- Show a position
- Add a position
- Edit a position
- Delete a positions (using soft deletes)

### Users

The users should include a field that indicates if the user is a client, staff, or applicant.

During "online" registration the client would be asked if they will be a client (posting positions) or an applicant (looking for work).

A user cannot be both client and applicant.

### Roles and Permissions

You do not need to create an API for Roles and Permissions as these are tied into the security of the application and the API.




