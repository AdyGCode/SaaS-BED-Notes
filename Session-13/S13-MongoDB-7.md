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
created: 2024-10-18T14:59
updated: 2024-11-25T09:18
---

# NoSQL 7

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

# Session 13 - Neeeeeigh, Trigger!

This set of notes covers the creation of triggers via the MongoDB Shell.

Note that as you are using the shell, there are fundamental issues with this method:
- the while loop is blocking
- multiple shells would need to be employed for multiple monitoring

It is possible to accomplish the capability using MongoDB Atlas' GUI.

Within `mongosh` (MongoDB shell) we will use **Change Streams** to create audit logs when orders are inserted or products are added to orders. 

However, MongoDB shell does not provide full-fledged event listeners like a programming environment, but you can still use Change Streams to manually poll for changes and log them.

### Key Considerations for `mongosh`:

- **Manual Execution**: 
	- The MongoDB shell does not support background tasks or services like Node.js, so these scripts run in an interactive loop. 
	- You'll need to keep the shell open for them to continue working.
- **Blocking Loop**: 
	- The `while (changeStream.hasNext())` loop will continuously poll for changes. 
	- If you'd like to run other commands in `mongosh`, you would need to stop this loop first.
- **Error Handling**: 
	- For production systems, it is better to use more robust error handling and logging mechanisms in an application environment, such as with Node.js or Python.

Given these factors, here's how you can achieve the logging of changes to a collection using `mongosh`:

> **Note:** You may use MongoDB Compass and execute the commands and code in the GUI's `mongosh` area at the bottom of the GUI:

![Animated GIF showing the opening of the MongoDB Shell in Compass](assets/MongoDBCompass_FrvTsSpvDS.gif)

### Step 1: Ensure a Replica Set is Running

Before you proceed, ensure that your MongoDB instance is running as a replica set. If it's not set up yet, follow the steps from my previous response to initialize the replica set.

If you are using the MongoDB Atlas free services then this is true!


>**Note:** The database in the examples below will be `mydb`. 
>
>Change `mydb` to the relevant database name. 
>
>Likewise change the collection name from `orders` to the one you wish to watch.

### Step 2: Watch for Insert Events (Order Creation) in `mongosh`

You can use `db.orders.watch()` to monitor inserts into the `orders` collection and log the event into the `audit_log` collection when a new order is created.

#### Script for Watching Order Creation:

1. Open the MongoDB shell by typing:

   ```bash
   mongosh
   ```

2. In the MongoDB shell, you can run a script like this to monitor for new orders and log them into the `audit_log` collection:

```javascript
// Connect to the database
use mydb;

// Start watching the orders collection for insert events
const changeStream = db.orders.watch([{ $match: { operationType: "insert" } }]);

print("Watching for new orders...");

// Poll the change stream for new order events
while (changeStream.hasNext()) {
  const change = changeStream.next();

  // Get the order information
  const newOrder = change.fullDocument;

  // Insert an audit log entry into audit_log collection
  db.audit_log.insertOne({
    eventType: "Order Created",
    orderId: newOrder._id,
    customer: newOrder.customer,
    timestamp: new Date(),
  });

  print(`Logged new order from ${newOrder.customer}`);
}
```

This will continuously watch the `orders` collection for new documents (inserts) and log them into the `audit_log` collection.

### Step 3: Watch for Product Additions in `mongosh`

You can also watch for updates to the `products` field in the `orders` collection and log those changes in the `audit_log` collection.

#### Script for Watching Product Additions:

```javascript
// Connect to the database
use mydb;

// Start watching the orders collection for updates to the products array
const changeStream = db.orders.watch([{ $match: { operationType: "update" } }]);

print("Watching for product additions...");

// Poll the change stream for update events
while (changeStream.hasNext()) {
  const change = changeStream.next();
  const updateDescription = change.updateDescription;

  // Check if the products field was updated
  if (updateDescription.updatedFields && updateDescription.updatedFields["products"]) {
    const orderId = change.documentKey._id;

    // Fetch the order's customer name
    const order = db.orders.findOne({ _id: orderId });
    const customer = order.customer;
    const productsAdded = updateDescription.updatedFields["products"];

    // Insert an audit log entry into the audit_log collection
    db.audit_log.insertOne({
      eventType: "Product Added",
      orderId: orderId,
      customer: customer,
      products: productsAdded,
      timestamp: new Date(),
    });

    print(`Logged product addition for order by ${customer}`);
  }
}
```

This script will monitor for changes (specifically `update` operations) in the `products` array in the `orders` collection and log any updates into the `audit_log` collection.

### Step 4: Running the Scripts

Both scripts will run indefinitely and monitor the `orders` collection in real-time.

When an insert or update occurs, they will create an audit log in the `audit_log` collection.



### Wrapping Up:

Although the MongoDB shell (`mongosh`) can be used for watching changes and logging events, it’s more limited compared to using MongoDB drivers in a full programming environment. 

The shell can continuously monitor change streams, but running scripts this way is more suited for testing or short-term monitoring rather than production use. 

For long-running triggers, it's recommended to use a more sophisticated setup (e.g., in a Node.js application) or within the MongoDB Atlas GUI.

# END

Next up - [LINK TEXT](#)
