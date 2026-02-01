---
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
header: ICT50220 - Adv Prog - SaaS 2 - BED
banner: "![[Black-Red-Banner.svg]]"
banner_x: 1
banner_y: "0"
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
updated: 2024-10-03T09:16
---


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

| User type     | Browse (all)                                        | Read (one) | Edit     | Add      | Delete   | Search | Notes                                                                                                                  |
| ------------- | --------------------------------------------------- | ---------- | -------- | -------- | -------- | ------ | ---------------------------------------------------------------------------------------------------------------------- |
| Unregistered  | Limited to six positions that are randomly selected | No         | No       | No       | No       | No     | Must register to be able to view details<br><br>User must be registered to access more than "six" positions in browse. |
| Applicant     | Yes                                                 | Yes        | No       | No       | No       | Yes    |                                                                                                                        |
| Client        | All                                                 | All        | Only Own | Only Own | Only Own | All    | Soft Delete: May undo own deletions                                                                                    |
| Staff         | All                                                 | All        | All      | All      | All      | All    | Soft Delete: Undo all, Undo one, Destroy all, Destroy one                                                              |
| Administrator | All                                                 | All        | All      | All      | All      | All    | Soft Delete: Undo all, Undo one, Destroy all, Destroy one<br><br>Super-user account(s)                                 |
