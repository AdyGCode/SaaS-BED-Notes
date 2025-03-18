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
updated: 2025-03-17T09:58
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

# Installing MongoDB

We can install MongoDB in a number of ways, including

- Install as part of the Laragon Application
- Install as a standalone application
- Install as a standalone service

These notes will initially look at the first option, but over time may include other methods.

## Installing MongoDB as part of Laragon

- Download the latest version of MongoDB as a ZIP file
- Extract all files to a folder
- Mover folder to the Laragon/Bin (executables) folder
- Set Laragon to Autostart MongoDB
- Start the service


### Download MongoDB

https://www.mongodb.com/try/download/community

Version 8.0.3 direct link: https://fastdl.mongodb.org/windows/mongodb-windows-x86_64-8.0.3.zip

![](assets/S10-MongoDB-3-20241025112230667.png)


### Extract all files

Locate download in the Downloads folder:
- WIN+E to open file explorer
- Double Click on downloads to open the folder
- WIN <-- to move the file explorer to the left side of the screen
- Locate the downloaded file

![](assets/S10-MongoDB-3-20241025112610996.png)

- Double click to open the file (We use 7-Zip for our compression tool).

![](assets/S10-MongoDB-3-20241025112620017.png)

- Drag and drop the MongoDB folder from the compressed file into the downloads

![](assets/7zFM_dDraJmxry8.gif)


### Move folder to the Laragon/Bin 

Open a second File Explorer window:

WIN+E
WIN -->

You now have the downloads on the left and default location on the right.

In the right side, navigate to:
- `c:\Laragon\bin\`
or, at TAFE:
- `c:\ProgramData\Laragon\bin`

If there is NOT a MongoDB folder, in this area, create one
- Click in the file/folder list on the right side of the Right Explorer
- CTRL+SHIFT+N to create a New Folder
- Name it `MongoDB`

Open the (new) MongoDB folder:
- double click the folder

Drag the expanded files from the downloads folder to the MongoDB Folder

![](assets/explorer_SFjEiHmmEQ.gif)

Rename the folder:
- click once on the folder
- Press F2 to start the rename process
- Enter `mongodb-nn.nn.nn` 
  *(use the version number you have downloaded, `8.0.3` in this case, replacing the `nn` with each number as needed)*
  
![](assets/explorer_1ZCY8cGLF1.gif)
Close your file explorer Windows.

### Set Laragon to Auto-start MongoDB

Open the Laragon application
- remember that Laragon minimises to the system tray so check there first!

Click the cog (Settings) icon

In the dialog
- click Services and Settings
- Tick the MongoDB option
- Click the X to close the dialog

![](assets/laragon_6nQyamKois.gif)

### Start the service

Starting MongoDB is as easy as:
- Click Start All
or...
- Right Mouse click on Laragon
- Hover over MongoDB
- Hover over and click Start MongoDB

![](assets/laragon_EXh7UtOevo.gif)


## Changing Versions of MongoDB

To switch between two version of MongoDB use these steps...
- right click on the Laragon interface
- MongoDB -> Stop MongoDB
You will need to wait a few seconds for the server to stop...
- right click the Laragon inter4face
- MongoDB -> version (mongodb...)
- hover over and click the version you wish to use

Now you can restart the MongoDB service.

Once you have done this, we **strongly** recommend that you follow the steps in changing the MongoDB configuration so that you keep your data organised.

![](assets/laragon_Vzbm7sWqwy.gif)


## Changing MongoDB Configurations

One of the items that you may want to do is change the MongoDB configurations, so that you may have any number of versions of MongoDB running, or having multiple copies running (for a replica set).

For example, We will want to have MongoDB 7 and its data in one data folder, and the MongoDB 8 data in another.

Stop the MongoDB server using:
- Stop all
or
- Right Mouse -> MongoDB -> Stop MongoDB

Open a File Explorer window (WIN+E)

Navigate to:
- `C:\Laragon\data`
or at TAFE:
- `C:\ProgramData\Laragon\data`

You will see a folder named `mongodb`. This holds the database files for the system.

Rename the folder to `db`

Next create a new folder (CTRL+SHIFT+N) and name it `mongodb-vn`, where...
- The `vn` is the major version number.
- For example MongoDB 7.3.2 would have `mongodb-v7`.

Drag and drop the `db` folder into the `mongo-nv` folder.

Now navigate to: 
- `C:\ProgramData\Laragon\bin\MongoDB\MongoDB-n.n.n`
or to
- `C:\Laragon\bin\MongoDB\MongoDB-n.n.n`
 
> **Remember** `n.n.n` is the version number.

Locate the `mongod.conf` file and open it in a suitable "plain text" editor (eg VSCode, Notepad, et al).

Locate the line starting with `dbPath:`

Change the line to read either:
- `  dbPath: C:\Laragon\data\mongodb-7\db`
or
- `  dbPath: C:\ProgramData\Laragon\data\mongodb-7\db`

Locate the line with `systemLog` and then the `path:` item within it.

Change the System Log Path to:
- `    path: C:\ProgramData\Laragon\data\mongodb-n\log\mongod.log
or...
- `  path: C:\Laragon\data\mongodb-n\log\mongod.log`
as needed...

> **Remember** that n is the version number!

Save the changes to the file and close the editor.

Now Restart the MongoDB Server.

> **Recommendation:**
> It is recommended that you use these steps for any major version update to MongoDB so data from your original serve is still available whilst you test the new version.

Below we show the configurations for Mongo V7 and V8. *We have removed commented lines for brevity!*

### Example MongoDB v7 Config

```yaml
# mongod.conf

systemLog:
  destination: file
  logAppend: true
  path: C:\ProgramData\Laragon\bin\data\mongodb-7\log\mongod.log

storage:
  dbPath: C:\ProgramData\Laragon\data\mongodb-7

processManagement:
  pidFilePath: mongod.pid 
  
net:
  port: 27017
  bindIp: 127.0.0.1  
  # Listen to local interface only
  # Comment out to listen on all interfaces.
```

### Example MongoDB 8 Config

```yaml
# mongod.conf

systemLog:
  destination: file
  logAppend: true
  path: C:\ProgramData\Laragon\bin\data\mongodb-8\log\mongod.log

storage:
  dbPath: C:\ProgramData\Laragon\data\mongodb-8

processManagement:
  pidFilePath: mongod.pid 
  
net:
  port: 27017
  bindIp: 127.0.0.1  
  # Listen to local interface only
  # Comment out to listen on all interfaces.

```





# END

Next up - [LINK TEXT](#)
