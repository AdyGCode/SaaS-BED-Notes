---
banner: "![[Black-Red-Banner.svg]]"
created: 2024-10-10T09:33
updated: 2024-10-18T15:57
---
---
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
header: ICT50220 - Adv Prog - SaaS 2 - BED
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
  date created: 03 July 2024
  date modified: 08 July 2024
  created: 2024-07-31T07:52
  updated: 2024-10-10T09:34

---

# NoSQL 10: MongoDB Replica Sets

## Software as a Service - Back-End Development

### Diploma of Information Technology (Advanced Programming)

### Diploma of Information Technology (Back-End Development)

### Session 13

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

# Session 13 - Locally Hosted Replica Set Using Windows and the Bash Command Line

This set of notes covers the creation of a locally hosted (hostname: localhost) MongoDB Replica Set.

A Replica Set is a group of servers that duplicate the data across themselves, with a primary server acting as the 'boss' and secondary servers containing the replicas.

These notes are for Windows systems, running MongoDB 7.

Here's a simple step-by-step guide to set up a MongoDB replica set on your local Windows PC using MongoDB version 7 or later.

## Prerequisites:

- MongoDB 7 or later installed.
- Windows Terminal is installed
- You are using the Bash Command Line that is supplied with Git SCM for Windows

## Replica Set Overview

The Replica set consists of at least 3 servers.
- Server 0: The Primary Server
- Server 1 & Server 2: The Secondary Servers

In this example configuration we are not allowing for fall-over elections of new primaries. This is when a primary server fails, then the remaining secondaries vote on who will take over as primary, and automatically 'reconfigure' to suit the new structure.

## Step 1: Set Up Directories

> **Note:** 
> 
> If you are working at college then replace `/C/ProgramData/MongoDB` with `/C/ProgramData/Laragon/data/MongoCluster/`


The folder structure we will be using for this replica set is:

```text
/C/ --- ProgramData/ --- MongoDB/ -+-- mongodb0/ -+-- data
                                   |              +-- logs
                                   |              +-- config
                                   |              
                                   +-- mongodb1/ -+-- data
                                   |              +-- logs
                                   |              +-- config
                                   |              
                                   +-- mongodb2/ -+-- data
                                                  +-- logs
                                                  +-- config

```

Use the following commands to create the structure:

```shell
mkdir -p /c/ProgramData/MongoDB/mongodb{0,1,2}/{data,logs,config}
```

## Step 2: Create Configuration Files for Each Node

1. Create three configuration files for the MongoDB instances.

- For `mongodb0` (primary):

   Save the following as `mongodb0.cfg` inside `/c/ProgramData/MongoDB/mongodb0/config`:
   
   ```yaml
   systemLog:
     destination: file
     path: /c/ProgramData/MongoDB/mongodb0/logs/mongodb.log
     logAppend: true
   storage:
     dbPath: /c/ProgramData/MongoDB/mongodb0/data
   net:
     bindIp: localhost
     port: 27017
   replication:
     replSetName: rs0
   ```

- For `mongodb1` (secondary):

   Save the following as `mongodb1.cfg` inside `/c/ProgramData/MongoDB/mongodb1/config`:
   
   ```yaml
   systemLog:
     destination: file
     path: /c/ProgramData/MongoDB/mongodb1/logs/mongodb.log
     logAppend: true
   storage:
     dbPath: /c/ProgramData/MongoDB/mongodb1/data
   net:
     bindIp: localhost
     port: 27018
   replication:
     replSetName: rs0
   ```

- For `mongodb2` (secondary):

   Save the following as `mongodb2.cfg` inside `/c/ProgramData/MongoDB/mongodb2/config`:
   
   ```yaml
   systemLog:
     destination: file
     path: /c/ProgramData/MongoDB/mongodb2/logs/mongodb.log
     logAppend: true
   storage:
     dbPath: /c/ProgramData/MongoDB/mongodb2/data
   net:
     bindIp: localhost
     port: 27019
   replication:
     replSetName: rs0
   ```

## Step 3: Start MongoDB Instances

Open three separate command prompt windows and start each MongoDB instance using the configuration files created.

- For `mongodb0` (primary):
- 
  ```bash
  mongod --config "/c/ProgramData/MongoDB/mongodb0/config/mongodb0.cfg"
  ```

- For `mongodb1` (secondary):
- 
  ```bash
  mongod --config "/c/ProgramData/MongoDB/mongodb1/config/mongodb1.cfg"
  ```

- For `mongodb2` (secondary):
- 
  ```bash
  mongod --config "/c/ProgramData/MongoDB/mongodb2/config/mongodb2.cfg"
  ```

## Step 4: Initialize the Replica Set

Once the MongoDB instances are running, open a new Command Prompt window and connect to the primary MongoDB instance:

```bash
mongosh --port 27017
```

Once connected to the MongoDB shell, initialize the replica set:

```javascript
rs.initiate(
  {
    _id: "rs0",
    members: [
      { _id: 0, host: "localhost:27017" },
      { _id: 1, host: "localhost:27018" },
      { _id: 2, host: "localhost:27019" }
    ]
  }
)
```

## Step 5: Check Replica Set Status

After the replica set is initialized, you can check its status with:

```javascript
rs.status()
```

This will give you details about the replica set configuration and the state of each member. 

The member with `_id: 0` will be the primary, while the others will be secondary nodes.

## Step 6: Test the Replica Set

You can verify that the replica set is working by connecting to each instance in a separate Command Prompt window:

- Connect to the primary:

  ```bash
  mongo --port 27017
  ```

- Connect to the secondary (read-only):

  ```bash
  mongo --port 27018
  ```

Repeat for the third instance if needed.

From here you should be able to issue commands in any of the shells.

## Shutting Down the Replica Set

To stop the replica set, shut down each MongoDB instance cleanly by connecting to each instance and running:

```bash
mongo --port <port-number>
```

Then execute:

```javascript
db.adminCommand({ shutdown: 1 })
```

Do this for all three instances to stop the MongoDB servers.

## Shutting ALL the servers down in a Replica Set

If using `mongosh` from the CLI (**Not from within Compass**), then you can shut down all the servers in the Replica Set using:


```javascript

```

# END

Next up - [LINK TEXT](#)
