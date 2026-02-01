---
banner: "![[Black-Red-Banner.svg]]"
created: 2024-07-31T07:52
updated: 2025-05-06T12:21
theme: default
paginate: true
footer: © Copyright 2024, Adrian Gould & NM TAFE
header: ICT50220 - Adv Prog - SaaS 2 - BED
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

# Session 13 - Securing a MongoDB instance

By default, MongoDB does not require authentication when installed locally. This means that anyone with access to the
system can interact with the database. However, you can secure your MongoDB instance by enabling authentication and
setting up user access control.

## Create the First Administrator User

After enabling authentication, you need to create an administrator user who can manage other users.

To do so, we first connect to MongoDB Without Authentication (only possible on a fresh install, before any users are
created):

```shell
mongosh
```

### Switch to the admin Database:

```
use admin
```

### Create an Administrator User:

Create a user with `userAdminAnyDatabase` role, which allows the user to create and manage other users:

```js
db.createUser(
    {
        user: "admin",
        pwd: passwordPrompt(), // or cleartext password
        roles: [
            {role: "userAdminAnyDatabase", db: "admin"},
            {role: "readWriteAnyDatabase", db: "admin"}
        ]
    }
)
```

Now the `passwordPrompt()` will ask you to enter the password. For TAFE systems we use "`Password1`" as it is easy to
remember and if we need to do any admin work we can easily access the system.

Alternative you replace `passwordPrompt()` with the password you want, eg `Password1`.

You could mimic MySQL/MariaDB and add a "root" user, but we need a password:

```js
db.createUser(
    {
        user: "root",
        pwd: "Password1",
        roles: [
            {role: "userAdminAnyDatabase", db: "admin"},
            {role: "readWriteAnyDatabase", db: "admin"}
        ]
    }
)
```

Exit the MongoDB shell:

```
exit
```

## Enable Authentication

To secure your MongoDB instance, you need to enable authentication by configuring MongoDB to require a username and
password.

### Stop MongoDB Service (if it's running):

In Linux, you will need to use the superuser account (if your account is not in the superuser wheel) to stop MongoDB.

```
sudo systemctl stop mongod
```

For the local systems at TAFE, you will be able to stop the server by either:

Laragon:

- Using laragon and Right Mouse Clicking the interface, MongoDB -> Stop

CLI:
If you have started MongoDB using the CLI (eg for a replica set), you will need to use <kbd>CTRL</kbd+<kbd>C</kbd> to
stop each 'instance' of MongoDB.

### Edit the MongoDB Configuration File:

Open the MongoDB configuration file in a text editor (mongod.conf), which is typically located at /etc/mongod.conf on
Linux systems.

```
sudo nano /etc/mongod.conf
```

For Local PC instance at TAFE, use the File Explorer and locate `C:\ProgramData\Laragon\bin\mongodb\` folder and within
there the confiog file.

You should be able to open in NotePad or VS Code or similar and edit the file.

### Enable Authentication:

Find the line that starts with security and uncomment it (or add it if it doesn’t exist). Then set authorization to
enabled:

```yaml
security:
  authorization: enabled
```

### Restart MongoDB:

Linux:

```
sudo systemctl start mongod
```

Windows

Starting from the shell you will use:

```shell
mongod --auth --port 27017 --dbpath /c/laragon/data/mongodb-8 --config /c/laragon/bin/mongodb/mongodb-8.0.4/mongod.conf
```

In fact you may need to do something similar on a linux system if your configuration file is not in teh default
location.

Laragon - yes you can just start the server as normal!

## Re-Connect to MongoDB Using Authentication:

With authentication enabled, MongoDB now requires a valid username and password to access the database.

Now, reconnect to MongoDB using the newly created admin user:

```shell
mongosh -u admin -p yourSecurePassword --authenticationDatabase admin
```

This will log you in with the admin user and you’ll be able to perform administrative tasks.

## Create Additional Users

Once authentication is enabled, you can create other users with specific roles to limit their access to particular
databases and operations.

### Example: Create a Read-Only User

```js
use
yourDatabase

db.createUser({
    user: "readonlyUser",
    pwd: "readonlyPassword",
    roles: [{role: "read", db: "yourDatabase"}]
})
```

## Removing the Requirement for a Username and Password (Disabling Authentication)

If you prefer to remove authentication and allow access to MongoDB without requiring a username and password, you can
simply disable authentication by modifying the MongoDB configuration file.

### First, Stop the MongoDB Service.

We have given instructions above on this

### Edit the MongoDB Configuration File (mongod.conf):

Open the configuration file for MongoDB.

### Disable Authentication:

In the security section of the mongod.conf file, comment out the line where authorization is enabled:

```yaml
# security:
#   authorization: "enabled"
```

### Restart MongoDB:

Restart MongoDB to apply the changes.

After doing this, you will be able to access MongoDB without a username and password, but this is not recommended for
production or any environment where security is important.

## Important Considerations

- Disabling Authentication: Removing the requirement for authentication will make your MongoDB instance vulnerable to
  unauthorized access. Only disable authentication for local, personal, or testing environments. Always use
  authentication in production systems.

- Using Firewalls: If you’re running MongoDB on a server that can be accessed from the internet, ensure that you use
  firewalls to limit access to only trusted IPs.

- Backup and Data Integrity: Ensure regular backups, especially if you're running MongoDB without authentication or in
  development environments, to prevent accidental data loss.

- Access Control: After enabling authentication, always apply the principle of least privilege. Only grant users the
  minimum required access to perform their tasks.

# END

Next up - [LINK TEXT](#)
