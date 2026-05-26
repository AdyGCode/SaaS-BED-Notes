import { MongoClient } from "mongodb";
import fs from "fs";

const client = new MongoClient("mongodb://localhost:27017");

// ✅ Load data
const existingData = JSON.parse(fs.readFileSync("films_best_possible.json"));
const updateDataRaw = JSON.parse(fs.readFileSync("films_update_data.json"));

// ✅ Fix encoding issues (important!)
function cleanTitle(title) {
  return title
      .normalize("NFKD")      // fixes WALL·E issue
      .replace(/[^\w\s:]/g, "")
      .toLowerCase()
      .trim();
}

// ✅ Deduplicate update data (keep latest)
const updateMap = new Map();

for (const movie of updateDataRaw) {
  const key = movie.imdb_id || `${cleanTitle(movie.title)}-${movie.year}`;
  updateMap.set(key, movie);
}

const updateData = Array.from(updateMap.values());

async function run() {
  await client.connect();
  const db = client.db("movies_db");
  const collection = db.collection("films");

  const ops = [];

  for (const upd of updateData) {


    let filter;
    let matchFound = false;

    if (upd.imdb_id) {
      filter = { imdb_id: upd.imdb_id };

      // check if it exists (for debugging)
      const exists = await collection.findOne(filter);
      if (exists) matchFound = true;

    } else {
      filter = {
        title: upd.title,
        year: upd.year
      };

      const exists = await collection.findOne(filter);
      if (exists) matchFound = true;
    }

    // ✅ DEBUG HERE
    if (!matchFound) {
      console.log("❌ No match:", upd.title, upd.year);
      continue; // skip this record
    }


    ops.push({
      updateOne: {
        filter,
        update: {
          $set: {
            imdb_id: upd.imdb_id,
            imdb_rating: upd.imdb_rating,
            rotten_tomatoes: upd.rotten_tomatoes,
            updated_at: new Date()
          }
        },
        upsert: true // change to true if you want inserts
      }
    });
  }

  const result = await collection.bulkWrite(ops);

  console.log("✅ Matched:", result.matchedCount);
  console.log("✅ Modified:", result.modifiedCount);

  await client.close();
}

run();
