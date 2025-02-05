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
  - APIs
  - Back-End
created: 2024-09-12T09:59
updated: 2024-10-25T13:56
---

# NoSQL 3

## Software as a Service - Back-End Development

### Diploma of Information Technology (Advanced Programming)  

### Diploma of Information Technology (Back-End Development)

### Session 10

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


# Session 10

This set of notes covers the creation of a local MongoDB Replication cluster with failover primary system capability.

# MongoDB Replica Sets

In the [previous notes](./S10-MongoDB-3.md) we discovered how to install MongoDB.

In this set of notes we look at creating a replica set with failover capabilities.

We presume you have a copy of MongoDB installed and configured.

## What is a Replica Set

A replica set is a method of keeping the database data duplicated across multiple systems to improve query response times.

Most replica sets in MongoDB will consist of at least THREE MongoDB Instances.

The instances are known as:
- Primary
	- The "lead node" in the replica set.
	- It is the only one that actually updates data from queries sent by clients.
	- It sends updates to the secondary nodes.
- Secondary
	- The secondary nodes are read only
	- They automatically direct any queries that are making changes to the primary
	- They receive updated data from the primary

In this configuration if the Primary fails, then there is no way to update data in any form.

So we add a fourth instance of MongoDB which acts as a arbiter when the primary fails and allocates the responsibility to one of the remaining nodes.


## WARNING

> These instructions no **NOT** secure the replica set. 
> 
> **DO NOT** use this configuration for a LIVE system!

Details on securing a replica set may be found at a variety of locations. As usual check:

- https://diigo.com/user/Ady_Gould

And search for MongoDB.


# Convert Current MongoDB

The first step is to modify the existing MongoDB configuration instance so it is part of a Replica Set.

This is done by editing its configuration and then restarting MongoDB.

To allow for replica sets across different MongoDB versions, we will name our replica set with a version number:

- `v7-rs00`
or
- `v8-rs00`

Locate the `mongod.conf` configuration file you wish to edit, and open it in a suitable editor.

Navigate to: 
- `C:\ProgramData\Laragon\bin\MongoDB\MongoDB-n.n.n`
or to
- `C:\Laragon\bin\MongoDB\MongoDB-n.n.n`
 
> **Remember** `n.n.n` is the version number.

Locate the `mongod.conf` file and open it in a suitable "plain text" editor (eg VSCode, Notepad, et al).

Next, Locate the `replication` line, and update it, plus add a new line to indicate the replica set name.

The example below is for MongoDB version 8.

```yaml
replication:
  replSetName: "v8-rs00"
```


## WARNING

> These instructions no NOT secure the replica set. 
> 
> DO NOT use this configuration for a LIVE system!


## Create Cluster Node

This step will be repeated for each cluster node that will be part of the replica set.

We will be doing the following:
- Creating a folder for the cluster node
- Adding log, data and config folder within the cluster folder
- Creating a config file
- Adding the node to the cluster
- Starting the node

### Create Folders for Cluster Node

> Note: X is the version number of MongoDB you are converting to a cluster.

This time we will use the Bash CLI to do most of our operations.

Open a Bash terminal in Windows Terminal.

Change into the Laragon Data folder:

At TAFE:
```shell
cd /c/ProgramFiles/Laragon/Data
```

BYOD:
```shell
cd /c/Laragon/Data
```


Create the folder structure:

```shell
mkdir -p mongodb-vX-nYY/{data,logs,config}
```

Replace `X` with the version number of MongoDB and `YY` with `00`, `01`, etc as needed.

Here is an example:
```text
├───mongodb-v7-00
│   ├───config
│   ├───data
│   └───logs
```

> **Aside:**
> If you wish to pre-create folders for more than one node then you could use the same command but list the numbers after the 'n'.
> For example:
>     `mkdir -p mongodb-vX-n{00,01,02,03}/{data,logs,config}`


### Copy base config into node data folder

Now we copy the `mongod.conf` file into our `mongodb-vX-nY/config` folder:

```shell
cp 
```

# END

Next up - [LINK TEXT](#)
