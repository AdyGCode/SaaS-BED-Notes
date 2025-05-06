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
updated: 2025-05-06T12:20
---

# NoSQL 3A - Running a Local Replica Set

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

In the [previous notes](../Session-10/S10-MongoDB-3.md) we discovered how to install MongoDB.

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

> **These instructions no NOT secure the replica set.** 
> 
> DO NOT use this configuration for a LIVE system!


## Create Cluster Node

This step will be repeated for each cluster node that will be part of the replica set.

We will be doing the following:
- Stopping the server
- Creating a folder for the cluster node
- Adding log, data and config folder within the cluster folder
- Creating a config file
- Adding the node to the cluster
- Starting the node

### Stopping the Server

You must stop your MongoDB instance within Laragon if you have it currently running.


### Create Folders for Cluster Node

> Note: `X` is the version number of MongoDB you are converting to a cluster.

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
mkdir -p mongodb-vX-rs-YY/{data,logs}
```

Replace `X` with the version number of MongoDB and `YY` with `00`, `01`, etc as needed.

Here is an example:
```text
├───mongodb-v7-rs-00
│   ├───data
│   └───logs
```

> **Aside:**
> If you wish to pre-create folders for more than one node then you could use the same command but list the numbers after the '`vX-`'.
> 
> For example:
> 
>     `mkdir -p mongodb-vX-rs-{00,01,02,03}/{data,logs}`

### Copy base config into node data folder

Now we duplicate the `mongod.conf` file that is in the binaries folder to create the same number of copies as the replication databases we will have.

Make sure you are in the `Laragon/bin/mongodb/mongodb-*-X.Y.Z/` folder... (Replace `X`, `Y` and `Z` with your version number as needed).

```shell
cd ../bin/mongodb/mongodb-*-X.Y.Z
```

Now duplicate the configuration file:
```shell
cp mongod.conf mongod-rs-00.conf
cp mongod.conf mongod-rs-01.conf
cp mongod.conf mongod-rs-02.conf
```

### Edit the Replica Set Configs

We need to do 2 things with the MongoDB Config files:

1. Give each replica server a different port
2. Tell each server to be part of the replica set

To do so we will:

1. Open each of the `mongod-rs-XX.conf` files.
2. Change the port for the 00, 01 and 02 configuration files to 27100, 27101 and 27102 respectively. Also, it makes it easier to match replica server configuration to port.
3. Make the configuration identify the replica set's name.

> **Important:**
> 
> We are configuring the replica set to start at port 27100 to make it possible to restart the non-replicated copy of MongoDB.
> 
> Alternatively you can make it part of the replica set, by applying the changes indicated at the end of this section.

#### Config 00

Open the file `mongod-rs-00.conf`.

> **Remember** that at home you will not need the `ProgramData\` section of the file path above.

Edit the `storage` section to point to the replica set data folder:

```ini
storage:
  dbPath: C:\ProgramData\Laragon\data\mongodb-v8-rs-00
```

Edit the `systemLog` section:

```ini
systemLog:
  destination: file
  path: C:\ProgramData\Laragon\data\mongodb-v8-rs-00\mongod.log
  logAppend: true

```

Locate the `net` section, and find the `port` line. Update the section to read:

```ini
net:
  bindIp: 127.0.0.1  # Only allow local connections
  port: 27100        # Replica Set Server 00 Port
```


At the end of the file add:

```ini
replication:
  replSet: "v8-rs0"
```

#### Config 01

Open the file `mongod-rs-01.conf: 

Edit the storage section to point to the replica set data folder:

```ini
storage:
  dbPath: C:\ProgramData\Laragon\data\mongodb-v8-rs-01
```

> **Remember** that at home you will not need the `ProgramData\` section of the file path above.

Edit the `systemLog` section:

```ini
systemLog:
  destination: file
  path: C:\ProgramData\Laragon\data\mongodb-v8-rs-01\mongod.log
  logAppend: true

```

Locate the `net` section, and find the `port` line. Update the section to read:

```ini
net:
  bindIp: 127.0.0.1  # Only allow local connections
  port: 27101        # Replica Set Server 01 Port
```

At the end of the file add:

```ini
replication:
  replSet: "v8-rs0"
```

#### Config 02

Open the file `mongod-rs-02.conf .

Edit the storage section to point to the replica set data folder:

```ini
storage:
  dbPath: C:\ProgramData\Laragon\data\mongodb-v8-rs-02
```

> **Remember** that at home you will not need the `ProgramData\` section of the file path above.

Locate the `net` section, and find the `port` line. Update the section to read:

```ini
net:
  bindIp: 127.0.0.1  # Only allow local connections
  port: 27102        # Replica Set Server 02 Port
```

Edit the `systemLog` section:

```ini
systemLog:
  destination: file
  path: C:\ProgramData\Laragon\data\mongodb-v8-rs-02\mongod.log
  logAppend: true

```

At the end of the file add:

```ini
replication:
  replSet: "v8-rs0"
```


## Running the Replica Set (Without original server)

To run the replica set you will now need a terminal running. Remember we use the BASH CLI within the MS Terminal application.

Open a new terminal window.

**Remember**: replace the `mongodb-*-X.Y.Z` with the version of MongoDB you are running.

### Split the Terminal into 3 sections

Now split the terminal into three using <kbd>ALT</kbd>+<kbd>SHIFT</kbd>+<kbd>-</kbd>

In **EACH** section of the split terminal do the following:

#### TAFE PCs

```shell
cd /c/ProgramData/Laragon/bin/mongodb/mongodb-*-X.Y.Z
```

#### Home/Room 306 PCs


```shell
cd /c/Laragon/bin/mongodb/mongodb-*-X.Y.Z
```

### Run server instance 0

Click in the top terminal area and execute:

```shell
bin/mongod -f mongod-rs-00.conf
```

### Run server instance 1

Click in the top terminal area and execute:

```shell
bin/mongod -f mongod-rs-01.conf
```


### Run server instance 2

Click in the top terminal area and execute:

```shell
bin/mongod -f mongod-rs-02.conf
```


### Connecting the Replica Set Instances

We are almost there. The last step is to connect the three instances together.

To do this we need to connect to one of the instances and run a command to tell each one they belong to a replica set.

For this we will need one more terminal.

In this new terminal do the following:

```shell
cd /c/ProgramData/Laragon/bin/mongodb/mongodb-*-X.Y.Z
bin/mongosh --port 27100
```

You will be presented with a MongoDB Shell looking similar to this:

```text
Current Mongosh Log ID: 6n5f1b96kbgba35y9a2b5f878
Connecting to:          mongodb://127.0.0.1:27100/?directConnection=true&serverSelectionTimeoutMS=2000&appName=mongosh+2.5.0
Using MongoDB:          8.0.4
Using Mongosh:          2.5.0

For mongosh info see: https://www.mongodb.com/docs/mongodb-shell/

test> 
```

In the shell you now execute the following command:

```js
rs.initiate( {
	_id : "v8-rs0",
	members: [
		{ _id: 1, host: "localhost:27100" },
		{ _id: 2, host: "localhost:27101" },
		{ _id: 3, host: "localhost:27102" }
	]
})
```

If the command executes successfully then a result similar to this will be seen:

```json
{
  ok: 1,
  '$clusterTime': {
    clusterTime: Timestamp({ t: 1745821024, i: 1 }),
    signature: {
      hash: Binary.createFromBase64('AAAAAAAAAAAAAAAAAAAAAAAAAAA=', 0),
      keyId: Long('0')
    }
  },
  operationTime: Timestamp({ t: 1745821024, i: 1 })
}
```

You now have a replica set executing.

### Exiting the Mongo Shell

You can exit the shell by using the following at the prompt:

```shell
exit;
```

## Shutting Down your Replica Set

It is always better to gracefully quit any MongoDB server instance. But if needed you may 'force quit'.

Use one of the following to shut down your MongoDB Replica Instance Servers:

### Option 1: Force Quit

You will need to do these steps:
1. Click in the terminal section you wish to stop
2. Press <kbd>CTRL</kbd>+<kbd>C</kbd> on the keyboard

Repeat for the other instances.


### Option 2: CLI Graceful Quit

To gracefully quit the servers use:

```shell
bin/mongosh mongodb://localhost:27100 --eval "db.shutdownServer({timeoutSecs: 10})"
bin/mongosh mongodb://localhost:27101 --eval "db.shutdownServer({timeoutSecs: 10})"
bin/mongosh mongodb://localhost:27102 --eval "db.shutdownServer({timeoutSecs: 10})"
```




## Using the Original Server as Part of the Replica Set

It is possible to connect our server that will run on port 27017 to our replica set.

The basic steps will be:

1. Stop the existing replica set
2. Backup the original MongoDB server config
3. Edit the original MongoDB server configuration 
4. Start the original server
5. Start the remaining replicants
6. Update the replica set (in MongoDB)


> ### ⚠️ IMPORTANT! 
> 
> THIS IS NOT REQUIRED... ONLY DO THIS IF YOU WISH TO MAKE THE ORIGINAL MONGODB PART OF THE REPLICA SET.

Open the file `mongod.conf .

Do **NOT** edit the storage section.
Do **NOT** edit the net section.

At the end of the file add:

```ini
replication:
  replSet: "v8-rs0"
```

Start the Original server


Start the replicants

Open a MongoDB Shell and Issue configure command

In the shell you now execute the following command:

```js
rs.initiate( {
	_id : "v8-rs0",
	members: [
		{ _id: 0, host: "localhost:27017" },
		{ _id: 1, host: "localhost:27100" },
		{ _id: 2, host: "localhost:27101" },
		{ _id: 3, host: "localhost:27102" }
	]
})
```

If the command executes successfully then a result similar to this will be seen:
```json
{
  ok: 1,
  '$clusterTime': {
    clusterTime: Timestamp({ t: 1745826124, i: 1 }),
    signature: {
      hash: Binary.createFromBase64('AAAAAAAAAAAAAAAAAAAAAAAAAAA=', 0),
      keyId: Long('0')
    }
  },
  operationTime: Timestamp({ t: 1745826124, i: 1 })
}
```


## Starting up an Existing Locally Hosted Replica Set

To start up our replica set once it is configured we use the following steps...

Open a new terminal window.

**Remember**: replace the `mongodb-*-X.Y.Z` with the version of MongoDB you are running.

### Split the Terminal into 3 sections

Now split the terminal into three using <kbd>ALT</kbd>+<kbd>SHIFT</kbd>+<kbd>-</kbd>

In **EACH** section of the split terminal do the following:

#### TAFE PCs

```shell
cd /c/ProgramData/Laragon/bin/mongodb/mongodb-*-X.Y.Z
```

#### Home/Room 306 PCs


```shell
cd /c/Laragon/bin/mongodb/mongodb-*-X.Y.Z
```

### (Optional) Run server instance on 27017

Click in the top terminal area and execute:

```shell
bin/mongod -f mongod.conf
```


### Run server instance 0

Click in the top terminal area and execute:

```shell
bin/mongod -f mongod-rs-00.conf
```

### Run server instance 1

Click in the top terminal area and execute:

```shell
bin/mongod -f mongod-rs-01.conf
```


### Run server instance 2

Click in the top terminal area and execute:

```shell
bin/mongod -f mongod-rs-02.conf
```


Once all instances are running then you will be able to connect MongoDB-Compass and work as normal.


# END

