---
banner: "![[Black-Red-Banner.svg]]"
created: 2025-03-24T09:08
updated: 2025-05-06T12:20
header: ICT50220 - Adv Prog - SaaS 2 - BED
footer: © Copyright 2024, Adrian Gould & NM TAFE
theme: default
paginate: true
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

# Session 11 Reflection Exercises

## Software as a Service - Back-End Development

Session 11 In-class, Out-of-Class, and Assessment Activities 

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

# Session 11 Reflection Questions & Exercises

## General Questions (Non-Code)

MongoDB is a NoSQL database system. 

### What is NoSQL?

NoSQL stands for "Not Only SQL." 

It refers to a set of database systems that do not follow the traditional relational database model. NoSQL databases are designed for unstructured, semi-structured, or large-scale data storage and can scale horizontally across many servers.

### What is the Cloud-based version of MongoDB called?

The cloud-based version of MongoDB is called MongoDB Atlas. It provides a fully managed service that takes care of database administration tasks, such as backups, monitoring, and scaling.

### What is the name of the CLI tool to interact with a MongoDB system?

The CLI tool for MongoDB is called `mongo` or `mongosh`. This command-line interface allows you to interact with your MongoDB databases, collections, and documents.

#### Which of the commands is used on Linux, MacOS, Windows?

> Answer: ?


### What is a connection string?

A connection string is a string that contains information used to connect to a database. It typically includes the database host, port, authentication credentials, and options to configure the connection.

### What are the parts of a MongoDB connection string?

The parts of a MongoDB connection string include:
- `mongodb://` or` mongodb+srv://` (protocol)
- Host(s) or Cluster Name (e.g., localhost:27017 or cluster0.mongodb.net)
- Username and password (if required)
- Database name (optional, can be included to specify the default database)
- Options (e.g., retryWrites=true, ssl=true)

### What are the two ways to start a MongoDB connection string?

- `mongodb://` is used for connecting to a standalone or replica set deployment of MongoDB.
- `mongodb+srv://` is used for connecting to a MongoDB Atlas cluster which manages DNS-based service discovery and has a simplified connection process.

### Give an example of a complete MongoDB connection string including authentication.

Example connection string: `mongodb+srv://username:password@cluster0.mongodb.net/myDatabase?retryWrites=true&w=majority`


## Exercises with Code Examples

Use these exercises as a way to revise your understanding of MongoDB.

These exercises are worked examples, so the solutions are shown.

In Session 12, there are practice exercises without the solutions!
- [S12-MongoDB-5](Session-12/S12-MongoDB-5.md)
- [S12-MongoDB-6](Session-12/S12-MongoDB-6.md)


### 1. Connect to MongoDB

Local connection (e.g. running MongoDB from Laragon):

```bash
# Local MongoDB
mongosh
```

Connection to remote MongoDB server (e.g. Atlas):

```shell
# MongoDB Atlas
mongo "mongodb+srv://<your-cluster>.mongodb.net/myFirstDatabase" --username <username>
```

### 2. Create a New Database

```js
use jokesApp;
```

### 3. Create a New Collection (users)

```js
db.createCollection("users")
```

### 4. Insert Robyn Banks (created_at: 01/01/2025)

```js
db.users.insertOne({
    given_name: "Robyn",
    family_name: "Banks",
    email: "robyn@example.com",
    password: "1Secret",
    created_at: ISODate("2025-01-01T00:00:00Z"),
    updated_at: ISODate("2025-01-01T00:00:00Z")
})
```

### 5. Insert 3 More Users

```js
db.users.insertMany([
    { given_name: "Chris", family_name: "Bacon", email: "chris@example.com", password: "APassword", created_at: new Date(), updated_at: new Date() },
    { given_name: "Chrystal-Chantal", family_name: "Lear", email: "chrystal-chantal@example.com", password: "Simple1", created_at: new Date(), updated_at: new Date() },
    { given_name: "Rusty", family_name: "Pipe", email: "rusty@example.com", password: "1Secret", created_at: new Date(), updated_at: new Date() }
])
```

### 6. Insert 3 "Dummy" Users (before 2025)

```js
db.users.insertMany([
    { given_name: "Dummy", family_name: "One", email: "dummy1@example.com", password: "Simple1", created_at: ISODate("2024-01-01T00:00:00Z"), updated_at: new Date() },
    { given_name: "Dummy", family_name: "Two", email: "dummy2@example.com", password: "1Secret", created_at: ISODate("2023-11-01T00:00:00Z"), updated_at: new Date() },
    { given_name: "Dummy", family_name: "Three", email: "dummy3@example.com", password: "APassword", created_at: ISODate("2024-06-15T00:00:00Z"), updated_at: new Date() }
])
```

### Exercise: Add the following users:

| given name | family name | email               | password                   |
| ---------- | ----------- | ------------------- | -------------------------- |
| Hazel      | Nutt        | hazel@example.com   | Nothing                    |
| Jacques    | d'Carre     | jacques@example.com | ChangeMe                   |
| Duane      | Pipe        | duane@example.com   | DoubleClick                |
| Al         | Dente       | al@example.com      | MyOnlyPassword             |
| Tim        | Burr        | tim@example.com     | ForgetMe!                  |
| Liv        | Long        | liv@example.com     | IllBeBack                  |
| Trish      | Panda       | trish@example.com   | LifeIsLikeABoxOfChocolates |
| Anita      | Bath        | anita@example.com   | BeamMeUpScotty             |
| Bill       | Board       | bill@example.com    | NotAPassword               |
| Sue        | Flay        | sue@example.com     | SkyNet                     |
| Barb       | Dwyer       | barb@example.com    | DontEventryIt              |
| Skip       | Dover       | skip@example.com    | PeekABoo                   |


### 7. Show All Users

```js
db.users.find()
```

### 8. Show One User

This shows the first user:

```js
db.users.findOne()
```

### 9. Users Created After 2025-01-01

```js
db.users.find({ 
    created_at: { 
        $gt: ISODate("2025-01-01T00:00:00Z") 
    } 
})
```

### 10. Users Created Between 2023 and 2024

```js
db.users.find({
    created_at: {
        $gte: ISODate("2023-01-01T00:00:00Z"), 
        $lt: ISODate("2025-01-01T00:00:00Z")
    }
})
```

### 11. Update One User’s Name

```js
db.users.updateOne(
    { email: "dummy1@example.com" },
    { $set: { 
            family_name: "Yewzuh" 
        }
    }
)
```

### 12. Update All Dummy Users' Password

```js
db.users.updateMany(
    { given_name: "Dummy" },
    { $set: { 
            password: "Updated1" 
        } 
    }
)
```

### 13. Insert New Users

```js
db.users.insertMany([
    { given_name: "Cliff", family_name: "Hanger", email: "cliff@example.com", password: "1Secret", created_at: new Date(), updated_at: new Date() },
    { given_name: "Eileen", family_name: "Dover", email: "eileen@example.com", password: "Simple1", created_at: new Date(), updated_at: new Date() },
])
```


### 14. Count All Users

```js
db.users.countDocuments()
```

### 15. Count Users Created in 2025

```js
db.users.countDocuments({
    created_at: {
        $gte: ISODate("2025-01-01T00:00:00Z"),
        $lt: new Date()
    }
})
```


### 16. Delete the First of These Users

```js
db.users.deleteOne({ email: "dummy1@example.com" })
```



### 17. Delete All Users Created Before 2025

```js
db.users.deleteMany({ 
    created_at: { 
        $lt: ISODate("2025-01-01T00:00:00Z") 
    } 
})
```


### 18. Create jokes Collection

```js
db.createCollection("jokes")
```

### 19. Insert 5 Users Each with 0–3 Random Jokes

```js
// Example: One user and their jokes
const user = db.users.insertOne({
    given_name: "Dee",
    family_name: "End",
    email: "dee@example.com",
    password: "DeadEndTurnBack",
    created_at: ISODate("2025-01-03T00:00:00Z"),
    updated_at: ISODate("2025-01-03T00:00:00Z")
}).insertedId

db.jokes.insertMany([
    {
        joke: "Why did the computer go to the doctor? Because he had a virus.",
        categories: ["Dad", "Tech"],
        user_id: user,
        created_at: ISODate("2025-02-01T00:00:00Z"),
        updated_at: new Date()
    },
    {
    joke: "What do ducks get after they eat? A bill!",
        categories: ["Duck", "Animal"],
        user_id: user,
        created_at: ISODate("2025-03-15T00:00:00Z"),
        updated_at: new Date()
    }
])
```

#### Add Barry Monday and their jokes

```js
db.users.insertOne({
  given_name: "Barry",
  family_name: "Monday",
  email: "barry@example.com",
  password: "GoneFishing",
  created_at: new ISODate("2025-01-03T00:00:00Z"),
  updated_at: new ISODate("2025-01-03T00:00:00Z")
});

db.jokes.insertMany([
  {
    joke: "How do rabbits travel? A: By hareplane.",
    categories: ["Rabbit", "Pun"],
    user_id: db.users.findOne({ given_name: "Chris", family_name: "Bacon" })._id,
    created_at: new ISODate("2025-01-03T01:00:00Z"),
    updated_at: new ISODate("2025-01-03T01:00:00Z")
  },
  {
    joke: "What time does a duck wake up? A: At the quack of dawn!",
    categories: ["Duck", "Animal"],
    user_id: db.users.findOne({ given_name: "Chris", family_name: "Bacon" })._id,
    created_at: new ISODate("2025-01-03T02:00:00Z"),
    updated_at: new ISODate("2025-01-03T02:00:00Z")
  },
  {
    joke: "What’s worse than raining cats and dogs? A: Hailing' taxi cabs!",
    categories: ["Cat", "Pun"],
    user_id: db.users.findOne({ given_name: "Chris", family_name: "Bacon" })._id,
    created_at: new ISODate("2025-01-03T03:00:00Z"),
    updated_at: new ISODate("2025-01-03T03:00:00Z")
  }
]);
```

#### Add Ella Vator & their joke

```js
db.users.insertOne({
  given_name: "Ella",
  family_name: "Vator",
  email: "ella@example.com",
  password: "Simple1",
  created_at: new ISODate("2025-01-04T00:00:00Z"),
  updated_at: new ISODate("2025-01-04T00:00:00Z")
});

// Insert 1 random joke for Ella Vator
db.jokes.insertOne({
  joke: "How much does a chimney cost? Nothing, it’s on the house.",
  categories: ["Dad", "House"],
  user_id: db.users.findOne({ given_name: "Ella", family_name: "Vator" })._id,
  created_at: new ISODate("2025-01-04T01:00:00Z"),
  updated_at: new ISODate("2025-01-04T01:00:00Z")
});
```


#### Add Paige Turner, who has no Jokes

```js
db.users.insertOne({
  given_name: "Paige",
  family_name: "Turner",
  email: "paige@example.com",
  password: "PleaseRTFM",
  created_at: new ISODate("2025-01-05T00:00:00Z"),
  updated_at: new ISODate("2025-01-05T00:00:00Z")
});
```

And finally... 

#### Add Cliff Hanger and their jokes

```js
db.users.insertOne({
  given_name: "Theresa",
  family_name: "Green",
  email: "theresa@example.com",
  password: "AutumnLeaves",
  created_at: new ISODate("2025-01-06T00:00:00Z"),
  updated_at: new ISODate("2025-01-06T00:00:00Z")
});

db.jokes.insertMany([
    {
        joke: "What do you call a crate full of ducks? A: A box of quackers!",
        categories: ["Duck", "Animal"],
        user_id: db.users.findOne({ given_name: "Cliff", family_name: "Hanger" })._id,
        created_at: new ISODate("2025-01-06T01:00:00Z"),
        updated_at: new ISODate("2025-01-06T01:00:00Z")
    },
    {
        joke: "What do you get if you cross a rabbit with an insect? A: Bugs bunny",
        categories: ["Rabbit", "Pun"],
        user_id: db.users.findOne({ given_name: "Cliff", family_name: "Hanger" })._id,
        created_at: new ISODate("2025-01-06T02:00:00Z"),
        updated_at: new ISODate("2025-01-06T02:00:00Z")
    }
]);
```


### 20. Insert 3 More Jokes for Existing Users

```js
db.jokes.insertMany([
    {
        joke: "Q: How many lawyers does it take to change a light bulb? A: How many can you afford?",
        categories: ["Lightbulb", "Pun"],
        user_id: db.users.findOne({ email: "robyn@example.com" })._id,
        created_at: ISODate("2025-04-10T00:00:00Z"),
        updated_at: new Date()
    }
])
```

## ASIDE: Using Javascript to do a random joke insertion for the users

### Steps:

1. Identify the Remaining Jokes: First, we need to identify the jokes that have not yet been assigned to any users.
2. Randomly Assign Jokes: For each remaining joke, we’ll randomly pick one of the existing users and insert the joke into the jokes collection, ensuring each user gets a random number of jokes (from 0 to 3).

### Remaining Jokes:

Here are the remaining jokes that have not been assigned to a user. These will be randomly added to the users.

```js
// Remaining jokes to be added randomly to users
const remainingJokes = [
  { joke: "Why couldn’t the tree get on his computer? Because he could not log on.", categories: ["Dad", "Computer"] },
  { joke: "What’s a dog’s favorite superhero? Labra-Thor.", categories: ["Dad", "Dog"] },
  { joke: "Why was the duck put into the basketball game? A: To make a fowl shot!", categories: ["Duck", "Sport", "Birds"] },
  { joke: "Why did the computer go to the doctor? Because he had a virus.", categories: ["Dad", "Computer"] },
  { joke: "How do you catch a unique rabbit? A: Unique up on it.", categories: ["Rabbit", "Pun", "Sneeky"] },
  { joke: "What do you call a rabbit who is angry over getting burnt? A: A hot cross bunny.", categories: ["Rabbit", "Animal"] },
  { joke: "Why are rabbits so lucky? A: They have four rabbit's feet?", categories: ["Rabbit", "Luck"] },
  { joke: "How much does a chimney cost? Nothing, it’s on the house.", categories: ["Dad", "House"] }
];

```

### Randomly Assign the Remaining Jokes

Now let’s write a script to randomly assign the remaining jokes to any of the existing users. 

Each user should end up with 3 or fewer jokes.

#### Random Joke Assignment Script:

```js
/**
 * Function to get a random user from the 'users' collection
 * Process:
 * - Get all the users
 * - Select a random user from the list of users
 * - Return the user to the caller
 */
function getRandomUser() {
  const users = db.users.find().toArray();
  const randomIndex = Math.floor(Math.random() * users.length); 
  return users[randomIndex];
}
```

Now to process the jokes and add them to random users.

```js
/**
 * Process the jokes one by one adding to a random user
 * Process:
 * - For each joke in list
 * -    Select random user
 * -    Insert joke into collection
 */
remainingJokes.forEach(joke => {
  const randomUser = getRandomUser();

  db.jokes.insertOne({
    joke: joke.joke,
    categories: joke.categories,
    user_id: randomUser._id,
    created_at: new ISODate(),
    updated_at: new ISODate()
  });
});

```

You can copy and paste each part of the script in and it will execute.

You will then have random data!


### 21. Add a Field to All Jokes

```js
db.jokes.updateMany({}, { $set: { is_approved: true } })
```

### 22. Show All Joke Texts in Reverse Order

```js
db.jokes.find({}, { joke: 1, _id: 0 }).sort({ created_at: -1 })
```

### 23. Show Clients and Their Jokes

#### Step 1: Understand the Schema

We have two collections: `users collection` has `_id`, `given_name`, `family_name`, and the `jokes` collection has `user_id`, `joke`

We want to join jokes to the user using: `users._id == jokes.user_id`

#### Step 2: Perform a Basic Lookup
This joins the jokes into a new array field called user_jokes for each user.

```js
db.users.aggregate([
    {
        $lookup: {
            from: "jokes",  
            localField: "_id", 
            foreignField: "user_id",
            as: "user_jokes"        
        }
    }
])
```

What key lines mean:

| prefix       | value      | purpose            |
| ------------ | ---------- | ------------------ |
| from         | jokes      | Collection to join |
| localField   | _id        | Field in users     |
| foreignField | user_id    | Field in jokes     |
| as           | user_jokes | Output array field |

#### Step 3: Project Only Required Fields

Now we filter the result to show only: 

- First name (`given_name`), 
- Last name (`family_name`)
- Joke text (`joke`)

List of joke texts (not entire joke objects).

The `jokes: "$user_jokes.joke"` line retrieves the `joke` field from the joined documents.

```js
db.users.aggregate([
    {
        $lookup: {
            from: "jokes",
            localField: "_id",
            foreignField: "user_id",
            as: "user_jokes"
        }
    },
    {
        $project: {
            given_name: 1,
            family_name: 1,
            jokes: "$user_jokes.joke"
        }
    }
])
```


### 24. Show All Lightbulb Jokes

```js
db.jokes.find({ 
	categories: "Lightbulb" 
})
```

### 25. Show All Dad Jokes

```js
db.jokes.find({ 
	categories: "Dad" 
})
```

### 26. Show jokes from multiple categories

```js
db.jokes.find({
	categories: { 
		$in: ['animal', 'bird', 'lightbulb']
	}
})
```
### 27. Show Jokes Sorted by Text

```js
db.jokes.find().sort({ 
	joke: 1 
})
```

### 28. Show Jokes by a Specific User in Reverse Order

```js
const userId = db.users.findOne({ email: "robyn@example.com" })._id

db.jokes.find({ user_id: userId }).sort({ created_at: -1 })
```


### 29. Use Aggregation to show maximum 5 jokes 

```js
db.users.aggregate([
	{ 
		$match: { email: "user@example.com" } 
	},
	{
	    $lookup: {
			from: "jokes",
		    localField: "_id",
		    foreignField: "userId",
		    as: "userJokes"
	    }
	},
	{
	    $project: {
		    email: 1,
		    userJokes: { 
			    $slice: [ { $reverseArray: "$userJokes" }, 5] 
			}
	    }
	}
]);

```


### 30. As per Previous Query, but Use Created At For Reverse Ordering

```js
db.users.aggregate([
  { $match: { email: "user@example.com" } },
  {
    $lookup: {
      from: "jokes",
      localField: "_id",
      foreignField: "userId",
      as: "userJokes"
    }
  },
  { $unwind: "$userJokes" }, 
  { $sort: { "userJokes.createdAt": -1 } },  
  {
    $group: {
      _id: "$_id",
      email: { $first: "$email" },
      jokes: { $push: "$userJokes" }  
    }
  }
]);
```

This is the most complex of the queries we have shown.

Basic process:

1. **`$match`**: Finds the user by email.
2. **`$lookup`**: Performs a join with the `jokes` collection, where `userId` from `jokes` matches the `_id` from `users`. It adds the jokes to the `userJokes` array.
3. **`$unwind`**: Flattens the `userJokes` array, creating a separate document for each joke.
4. **`$sort`**: Sorts the jokes by the `createdAt` field in **descending** order (most recent jokes first).
5. **`$group`**: Re-groups the jokes back into an array and keeps only the relevant fields (`_id`, `email`, and `jokes`).


### 31. Show all users created Between 1 month ago and 1 week ago

```js
db.users.aggregate([
  {
    $match: {
      createdAt: {
        $gte: new Date(new Date().setMonth(new Date().getMonth() - 1)),
        $lte: new Date(new Date().setDate(new Date().getDate() - 7))
      }
    }
  }
]);
```


### 32. Jokes created between 01/01 of the current year and before 1st of the current month

```js
db.jokes.aggregate([
  {
    $match: {
      createdAt: {
        $gte: new Date(new Date().getFullYear(), 0, 1),
        $lt: new Date(new Date().getFullYear(), new Date().getMonth(), 1) 
      }
    }
  }
]);
```


## Tutorial

Complete the MongoDB University course content as outlined in [Session 10's MongoDB-Learning-Path](../Session-09/S09-MongoDB-Learning-Path.md).




---
# Found a Problem?
 
If you spotted any problems (including missing details) in notes or other materials, then make sure you note that, and as a big help to your lecturer, you could fork the notes repository, create an issue, create a fix to the issue, and submit a pull request.



---

# END
